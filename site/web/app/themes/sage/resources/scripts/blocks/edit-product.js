import { SelectControl } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';

const Edit = ({ attributes, setAttributes }) => {
  const { productId } = attributes;
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Cambiar la ruta para utilizar tu endpoint personalizado
    apiFetch({ path: '/wc/v3/products/' }).then((response) => {
      if (response.error) {
        console.error('Error al obtener productos:', response.error);
        return;
      }

      console.log('Response:', response);
      // Asume que la respuesta es un arreglo de productos
      setProducts(
        response.map((product) => ({
          label: product.name, // Asegúrate de que estos campos coincidan con tu respuesta
          value: product.id,
        }))
      );
    });
  }, []);

  return (
    <SelectControl
      label={__('Select a Product', 'sage')}
      value={productId}
      options={[{ label: __('Select...', 'sage'), value: '' }, ...products]}
      onChange={(selectedId) => setAttributes({ productId: selectedId })}
    />
  );
};

export default Edit;
