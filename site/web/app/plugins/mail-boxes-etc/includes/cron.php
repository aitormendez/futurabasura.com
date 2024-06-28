<?php

global $wpdb;

$helper = new Mbe_Shipping_Helper_Data();
$logger = new Mbe_Shipping_Helper_Logger();

if ($helper->isEnabled() && $helper->isClosureAutomatically()) {

    $ws = new Mbe_Shipping_Model_Ws();
    if ($ws->mustCloseShipments()) {

        $logger->log('Cron Close shipments');

        $time = time();
        $to = date('Y-m-d H:i:s', $time);
        $lastTime = $time - 60 * 60 * 24 * 30; // 60*60*24*2
        $from = date('Y-m-d H:i:s', $lastTime);
	    $shippingMethods = MBE_ESHIP_ID.'|wf_mbe_shipping'; // search also for orders created with the old plugin

        $post_status = implode("','", array('wc-processing', 'wc-completed'));

		$order_ids = $helper->select_mbe_ids();
	    $orders_custom_mapping_ids = $helper->select_custom_mapping_ids();
	    $orders_pickup_batch_ids = $helper->select_pickup_orders_ids();
	    $order_filter = 'AND ((ID IN ('.$order_ids.') OR ID IN ('.$orders_custom_mapping_ids.')) AND ID NOT IN ('.$orders_pickup_batch_ids.'))';

	    $results = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'shop_order' $order_filter AND post_status IN ('{$post_status}')" );

        $post_ids = array();
        foreach ($results as $order) {
            $post_ids[] = ($order->ID);
        }
        $logger->logVar($post_ids,'Order with shipments to close id');
        $toClosedIds = array();
        $alreadyClosedIds = array();
        $withoutTracking = array();
	    $pickupIds = array();

	    foreach ($post_ids as $post_id) {
		    if (!$helper->hasTracking($post_id)) {
			    $withoutTracking[] = $post_id;
		    } elseif (!empty($helper->getOrderPickupCustomDataId($post_id))) {
			    $pickupIds[] = $post_id;
		    } elseif ($helper->isShippingOpen($post_id) && empty($helper->getOrderPickupCustomDataId($post_id))) { // additional check to be sure that pickup shipment won't be closed
			    $toClosedIds[] = $post_id;
		    } else {
			    $alreadyClosedIds[] = $post_id;
		    }
	    }

        $logger->logVar($toClosedIds,'Order with shipments to close id');

        $ws->closeShipping($toClosedIds);

        if (count($withoutTracking) > 0) {
            echo sprintf(__('%s - Total of %d order(s) without tracking number yet.', 'mail-boxes-etc'), date('Y-m-d H:i:s'), count($withoutTracking));
        }

	    if(count($pickupIds) > 0) {
		    echo sprintf(__('%s - Total of %d order(s) are pickup shipment.', 'mail-boxes-etc'), date('Y-m-d H:i:s'), count($pickupIds));
	    }

	    if (count($toClosedIds) > 0) {
            echo sprintf(__('%s - Total of %d order(s) have been closed.', 'mail-boxes-etc'), date('Y-m-d H:i:s'), count($toClosedIds));
        }

        if (count($alreadyClosedIds) > 0) {
            echo sprintf(__('%s - Total of %d order(s) was already closed', 'mail-boxes-etc'), date('Y-m-d H:i:s'), count($alreadyClosedIds));
        }

    }
}
die();