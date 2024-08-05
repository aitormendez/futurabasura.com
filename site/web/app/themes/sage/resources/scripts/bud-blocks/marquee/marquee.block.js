import Edit from './edit';
import { SVG, Path } from '@wordpress/components';

const CustomIcon = (
  <svg width="24" height="4" viewBox="0 0 24 4">
    <path
      d="M0 2C0 0.895431 0.895431 0 2 0H8V4H2C0.895431 4 0 3.10457 0 2V2Z"
      fill="black"
    />
    <rect x="9" width="3" height="4" fill="black" />
    <path
      d="M13 0H22C23.1046 0 24 0.895431 24 2V2C24 3.10457 23.1046 4 22 4H13V0Z"
      fill="black"
    />
  </svg>
);

export default {
  name: `sage/marquee`,
  title: `Marquee`,
  icon: CustomIcon,
  category: `fb`,
  attributes: {
    marqueeText: {
      type: 'string',
      default: 'Test text',
    },
    backgroundColor: {
      type: 'string',
      default: '#000000',
    },
    pillBackgroundColor: {
      type: 'string',
      default: '#ffffff',
    },
    textColor: {
      type: 'string',
      default: '#000000',
    },
  },
  supports: {
    align: ['wide', 'full'],
  },
  edit: Edit,
  save: () => null,
};
