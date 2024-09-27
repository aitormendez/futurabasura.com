import React from 'react';
import ReactDOM from 'react-dom';
import VideoPlayer from './VideoPlayer';

document.querySelectorAll('[id^="video-player-"]').forEach((el) => {
  const videoId = el.getAttribute('data-video-id');
  const thumbnailUrl = el.getAttribute('data-thumbnail-url');
  const autoplay = el.getAttribute('data-autoplay') === 'true';
  const loop = el.getAttribute('data-loop') === 'true';
  const muted = el.getAttribute('data-muted') === 'true';
  const controls = el.getAttribute('data-controls') === 'true';
  const playsInline = el.getAttribute('data-playsInline') === 'true';

  ReactDOM.render(
    <VideoPlayer
      videoId={videoId}
      thumbnailUrl={thumbnailUrl}
      autoplay={autoplay}
      loop={loop}
      muted={muted}
      controls={controls}
      playsInline={playsInline}
    />,
    el
  );
});
