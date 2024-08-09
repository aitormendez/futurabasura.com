import { debounce } from 'lodash';
import {
  BlockControls,
  InspectorControls,
  PanelColorSettings,
} from '@wordpress/block-editor';
import { ToolbarGroup, ToolbarButton, PanelBody } from '@wordpress/components';

import {
  SelectControl,
  TextControl,
  RadioControl,
} from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import PropTypes from 'prop-types';

const Edit = ({ attributes, setAttributes }) => {
  const { productId, layout = 'layout1', backgroundColor } = attributes;
  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedProductName, setSelectedProductName] = useState('');
  const [isPreview, setIsPreview] = useState(false);
  const togglePreview = () => setIsPreview((prev) => !prev);

  useEffect(() => {
    const fetchInitialProducts = () => {
      apiFetch({ path: '/wc/v3/products?per_page=100' })
        .then((products) => {
          setProducts(products);
          setFilteredProducts(products);

          if (productId) {
            const selectedProduct = products.find(
              (product) => product.id === productId
            );
            if (selectedProduct) {
              setSelectedProductName(selectedProduct.name);
            }
          }
        })
        .catch((error) => {
          console.error('Error al cargar productos:', error);
        });
    };

    fetchInitialProducts();
  }, [productId]);

  const debouncedFetchProducts = debounce((searchTerm, setProducts) => {
    apiFetch({
      path: `/wc/v3/products?search=${encodeURIComponent(
        searchTerm
      )}&per_page=100`,
    }).then((products) => {
      setProducts(products);
    });
  }, 300);

  useEffect(() => {
    if (!searchTerm) {
      return;
    }

    debouncedFetchProducts(searchTerm, setProducts);
  }, [searchTerm]);

  useEffect(() => {
    const searchFilter = products.filter((product) =>
      product.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setFilteredProducts(searchFilter);
  }, [searchTerm, products]);

  const updateProduct = (selectedId) => {
    const product = products.find(
      (product) => product.id.toString() === selectedId
    );
    setAttributes({ productId: parseInt(selectedId) });
    setSelectedProductName(product ? product.name : '');
  };

  const updateLayout = (selectedLayout) => {
    console.log('Updating layout to:', selectedLayout);
    setAttributes({ layout: selectedLayout });
  };

  return (
    <div>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton
            icon={isPreview ? 'edit' : 'visibility'}
            label={isPreview ? 'Editar' : 'Vista previa'}
            onClick={togglePreview}
          />
        </ToolbarGroup>
      </BlockControls>

      <InspectorControls>
        <PanelBody title={__('Settings', 'sage')}>
          <PanelColorSettings
            title={__('Background Color', 'sage')}
            colorSettings={[
              {
                value: backgroundColor,
                onChange: (color) => setAttributes({ backgroundColor: color }),
                label: __('Background Color', 'sage'),
              },
            ]}
          />
        </PanelBody>
      </InspectorControls>

      {isPreview ? (
        <p>{__('Preview Mode', 'sage')}</p>
      ) : (
        <div>
          {selectedProductName && (
            <p>
              {__('Selected Product:', 'sage')}{' '}
              <strong>{selectedProductName}</strong>
            </p>
          )}
          {layout && (
            <p>
              {__('Selected Layout:', 'sage')}{' '}
              <strong>
                {layout === 'layout1'
                  ? __('Layout 1', 'sage')
                  : __('Layout 2', 'sage')}
              </strong>
            </p>
          )}
          <TextControl
            label={__('Search Products', 'sage')}
            value={searchTerm}
            onChange={(search) => setSearchTerm(search)}
          />
          <SelectControl
            label={__('Select a Product', 'sage')}
            value={productId.toString()}
            options={[
              { label: __('Select...', 'sage'), value: '' },
              ...filteredProducts.map((product) => ({
                label: product.name,
                value: product.id.toString(),
              })),
            ]}
            onChange={updateProduct}
          />
          <RadioControl
            label={__('Select Layout', 'sage')}
            selected={layout}
            options={[
              { label: __('Layout 1', 'sage'), value: 'layout1' },
              { label: __('Layout 2', 'sage'), value: 'layout2' },
            ]}
            onChange={updateLayout}
          />
        </div>
      )}
    </div>
  );
};

Edit.propTypes = {
  attributes: PropTypes.shape({
    productId: PropTypes.number,
    layout: PropTypes.string,
    backgroundColor: PropTypes.string,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
