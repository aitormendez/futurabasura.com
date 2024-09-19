import Edit from './edit';
import { InnerBlocks } from '@wordpress/block-editor';

const CustomIcon = (
  <svg
    width="7"
    height="9"
    viewBox="0 0 7 9"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <rect width="7" height="9" fill="black" />
  </svg>
);

export default {
  name: `sage/slide`,
  title: `Slide`,
  icon: CustomIcon,
  category: `fb`,

  edit: Edit,
  save: (props) => <InnerBlocks.Content />,
};
