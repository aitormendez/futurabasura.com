import EditVideo from './edit-video';
import { SVG, Path } from '@wordpress/components';
// import { video } from '@wordpress/icons';

const CustomIcon = (
  <SVG width="24" height="24" viewBox="0 0 24 24">
    <Path d="M22 12L2 24L2 -8.74228e-07L22 12Z" fill="black" />
  </SVG>
);

export default {
  name: `sage/video`,
  title: `Video`,
  category: `fb`,
  icon: CustomIcon,
  attributes: {
    videoId: {
      type: 'string',
      default: '',
    },
    thumbnailUrl: {
      type: 'string',
      default: '',
    },
    align: {
      type: 'string',
      default: 'none',
    },
    autoplay: {
      type: 'boolean',
      default: false,
    },
    loop: {
      type: 'boolean',
      default: false,
    },
    muted: {
      type: 'boolean',
      default: false,
    },
    controls: {
      type: 'boolean',
      default: true,
    },
    playsInline: {
      type: 'boolean',
      default: true,
    },
  },
  supports: {
    align: ['wide', 'full'],
    spacing: {
      margin: false,
      padding: false,
    },
  },
  edit: EditVideo,
  save: () => null,
};