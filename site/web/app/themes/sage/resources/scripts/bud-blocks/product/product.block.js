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
  name: `sage/product`,
  title: `Product`,
  icon: CustomIcon,
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
