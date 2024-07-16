import {
  TextControl,
  PanelBody,
  ToggleControl,
  Button,
} from '@wordpress/components';
import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import PropTypes from 'prop-types';
import { useEffect } from '@wordpress/element';
import VideoPlayer from '../../components/video/VideoPlayer';

const EditVideo = ({ attributes, setAttributes }) => {
  const {
    videoId,
    thumbnailUrl,
    align,
    autoplay,
    loop,
    muted,
    controls,
    playsInline,
    libraryId,
  } = attributes;

  const removeImage = () => {
    setAttributes({ thumbnailUrl: '' });
  };

  useEffect(() => {
    // Realiza cualquier inicialización necesaria aquí.
  }, [videoId]);

  return (
    <div>
      <InspectorControls>
        <PanelBody title={__('Video Settings', 'sage')}>
          <ToggleControl
            label={__('Autoplay', 'sage')}
            checked={autoplay}
            onChange={(value) => setAttributes({ autoplay: value })}
          />
          <ToggleControl
            label={__('Loop', 'sage')}
            checked={loop}
            onChange={(value) => setAttributes({ loop: value })}
          />
          <ToggleControl
            label={__('Muted', 'sage')}
            checked={muted}
            onChange={(value) => setAttributes({ muted: value })}
          />
          <ToggleControl
            label={__('Playback Controls', 'sage')}
            checked={controls}
            onChange={(value) => setAttributes({ controls: value })}
          />
          <ToggleControl
            label={__('Play Inline', 'sage')}
            checked={playsInline}
            onChange={(value) => setAttributes({ playsInline: value })}
          />
        </PanelBody>
      </InspectorControls>
      <TextControl
        label={__('Video ID', 'sage')}
        value={videoId}
        onChange={(id) => setAttributes({ videoId: id })}
        placeholder={__('Enter Bunny.net video ID...', 'sage')}
        className="m-4"
      />
      <TextControl
        label={__('Library ID', 'sage')}
        value={libraryId}
        onChange={(id) => setAttributes({ libraryId: id })}
        placeholder={__('Leave blank to get default library', 'sage')}
        className="m-4"
      />
      <MediaUploadCheck>
        <MediaUpload
          onSelect={(media) => setAttributes({ thumbnailUrl: media.url })}
          allowedTypes={['image']}
          render={({ open }) => (
            <div>
              {thumbnailUrl ? (
                <div>
                  <img
                    src={thumbnailUrl}
                    alt={__('Thumbnail', 'sage')}
                    className="block w-60 mx-4 mt-4"
                  />
                  <Button onClick={open} variant="secondary" className="m-4">
                    {__('Change Thumbnail', 'sage')}
                  </Button>
                  <Button onClick={removeImage} variant="destructive">
                    {__('Remove Thumbnail', 'sage')}
                  </Button>
                </div>
              ) : (
                <Button variant="secondary" onClick={open} className="m-4">
                  {__('Select Thumbnail', 'sage')}
                </Button>
              )}
            </div>
          )}
        />
      </MediaUploadCheck>

      {videoId && (
        <VideoPlayer
          videoId={videoId}
          thumbnailUrl={thumbnailUrl}
          autoplay={autoplay}
          loop={loop}
          muted={muted}
          controls={controls}
          playsInline={playsInline}
        />
      )}
    </div>
  );
};

EditVideo.propTypes = {
  attributes: PropTypes.shape({
    videoId: PropTypes.string,
    thumbnailUrl: PropTypes.string,
    align: PropTypes.string,
    autoplay: PropTypes.bool,
    loop: PropTypes.bool,
    muted: PropTypes.bool,
    controls: PropTypes.bool,
    playsInline: PropTypes.bool,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default EditVideo;
