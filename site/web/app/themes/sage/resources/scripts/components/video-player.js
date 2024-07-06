import React from 'react';
import ReactDOM from 'react-dom';
import VideoPlayer from './VideoPlayer';

document.querySelectorAll('[id^="video-player-"]').forEach((el) => {
  const videoId = el.getAttribute('data-video-id');
  const thumbnailUrl = el.getAttribute('data-thumbnail-url');
  ReactDOM.render(
    <VideoPlayer videoId={videoId} thumbnailUrl={thumbnailUrl} />,
    el
  );
});
