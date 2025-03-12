import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import { SVG } from '@wordpress/components';

const CustomIcon = (
  <SVG width="24" height="24" viewBox="0 0 24 24">
    <rect x="3" width="18" height="12" fill="black" />
    <rect x="3" y="14" width="15" height="2" fill="black" />
    <rect x="3" y="18" width="10" height="2" fill="black" />
    <rect x="3" y="22" width="13" height="2" fill="black" />
  </SVG>
);

// 🟢 Aquí registramos explícitamente el bloque
registerBlockType('sage/post', {
  title: 'Post Block',
  icon: CustomIcon,
  category: 'fb',
  attributes: {
    contentType: {
      type: 'string',
      default: 'product',
    },
    postId: {
      type: 'number',
      default: 0,
    },
    layout: {
      type: 'string',
      default: 'layout1',
    },
    backgroundColor: {
      type: 'string',
      default: '#ffff00',
    },
    backgroundInteriorColor: {
      type: 'string',
      default: '#ffffff',
    },
    textColor: {
      type: 'string',
      default: '#000000',
    },
    borderColor: {
      type: 'string',
      default: '#3e2b2f',
    },
  },
  supports: {
    align: ['wide', 'full'],
  },
  edit: Edit,
  save: () => null, // Porque usas `render_callback` en PHP
});
