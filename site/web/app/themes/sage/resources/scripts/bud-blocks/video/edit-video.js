import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import PropTypes from 'prop-types';
import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const EditVideo = ({ attributes, setAttributes }) => {
  const { videoId } = attributes;
  const [videoUrls, setVideoUrls] = useState({});
  const [thumbnailUrl, setThumbnailUrl] = useState('');

  useEffect(() => {
    if (videoId) {
      apiFetch({ path: `/wp-json/fb/v1/video-resolutions?video_id=${videoId}` })
        .then((data) => {
          if (data && data.videoUrls) {
            setVideoUrls(data.videoUrls);
            setThumbnailUrl(data.thumbnailUrl);
          } else {
            setVideoUrls({});
            setThumbnailUrl('');
          }
        })
        .catch((error) => {
          console.error('Error fetching video details:', error);
          setVideoUrls({});
          setThumbnailUrl('');
        });
    }
  }, [videoId]);

  return (
    <div>
      <TextControl
        label={__('Video ID', 'sage')}
        value={videoId}
        onChange={(newId) => setAttributes({ videoId: newId })}
        placeholder={__('Enter Bunny.net video ID...', 'sage')}
      />
      {thumbnailUrl && (
        <img src={thumbnailUrl} alt={__('Video Thumbnail', 'sage')} />
      )}
      {Object.keys(videoUrls).length > 0 && (
        <video controls>
          {Object.entries(videoUrls).map(([resolution, url]) => (
            <source key={resolution} src={url} type="video/mp4" />
          ))}
          {__('Your browser does not support the video tag.', 'sage')}
        </video>
      )}
    </div>
  );
};

EditVideo.propTypes = {
  attributes: PropTypes.shape({
    videoId: PropTypes.string,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default EditVideo;
