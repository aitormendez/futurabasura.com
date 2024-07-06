import EditVideo from './edit-video';

export default {
  name: `sage/video`,
  title: `Video`,
  category: `fb`,
  attributes: {
    videoId: {
      type: 'string',
      default: '',
    },
  },
  edit: EditVideo,
  save: () => null,
};
