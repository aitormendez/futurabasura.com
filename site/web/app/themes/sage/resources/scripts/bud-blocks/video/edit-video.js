import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import PropTypes from 'prop-types';
import { useEffect } from '@wordpress/element';
import VideoPlayer from '../../components/VideoPlayer';

const EditVideo = ({ attributes, setAttributes }) => {
  const { videoId, thumbnailUrl, align } = attributes;

  useEffect(() => {
    // Realiza cualquier inicialización necesaria aquí.
  }, [videoId]);

  return (
    <div>
      <TextControl
        label={__('Video ID', 'sage')}
        value={videoId}
        onChange={(id) => setAttributes({ videoId: id })}
        placeholder={__('Enter Bunny.net video ID...', 'sage')}
      />
      <TextControl
        label={__('Thumbnail URL', 'sage')}
        value={thumbnailUrl}
        onChange={(url) => setAttributes({ thumbnailUrl: url })}
        placeholder={__('Leave blank to use the default poster', 'sage')}
      />
      {videoId && <VideoPlayer videoId={videoId} thumbnailUrl={thumbnailUrl} />}
    </div>
  );
};

EditVideo.propTypes = {
  attributes: PropTypes.shape({
    videoId: PropTypes.string,
    thumbnailUrl: PropTypes.string,
    align: PropTypes.string,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default EditVideo;
