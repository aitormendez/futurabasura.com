import Edit from './edit';
import { SVG, Path } from '@wordpress/components';

const CustomIcon = (
  <SVG width="24" height="24" viewBox="0 0 24 24">
    <rect x="3" width="18" height="12" fill="black" />
    <rect x="3" y="14" width="15" height="2" fill="black" />
    <rect x="3" y="18" width="10" height="2" fill="black" />
    <rect x="3" y="22" width="13" height="2" fill="black" />
  </SVG>
);

export default {
  name: `sage/post`,
  title: `post`,
  icon: CustomIcon,
  category: `fb`,
  attributes: {
    contentType: {
      type: 'string',
      default: 'product', // Puede ser 'product', 'project', o 'story'
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
  save: () => null,
};
