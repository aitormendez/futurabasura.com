import { SelectControl, TextControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import Edit from './edit';

export default {
  name: `sage/product`,
  title: `Product`,
  category: `fb`,
  attributes: {
    productId: {
      type: 'number',
      default: 0,
    },
    layout: {
      type: 'string',
      default: 'layout1',
    },
  },
  edit: Edit,
  save: () => null,
};
