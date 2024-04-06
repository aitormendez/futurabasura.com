import {
  SelectControl,
  TextControl,
  RadioControl,
} from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';

const Edit = ({ attributes, setAttributes }) => {
  const { productId, layout } = attributes;
  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedProductName, setSelectedProductName] = useState('');

  useEffect(() => {
    apiFetch({ path: '/wc/v3/products?per_page=100' }).then((products) => {
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
    });
  }, [productId]);

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
    setAttributes({ layout: selectedLayout });
  };

  return (
    <div>
      {selectedProductName && (
        <p>
          {__('Selected Product:', 'sage')}{' '}
          <strong>{selectedProductName}</strong>
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
  );
};

export default Edit;
