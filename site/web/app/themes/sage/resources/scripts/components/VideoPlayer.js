import React, { useEffect, useRef } from 'react';
import Hls from 'hls.js';
import '@vidstack/react/player/styles/base.css';
import { MediaPlayer, MediaProvider } from '@vidstack/react';

const VideoPlayer = ({ videoId, thumbnailUrl }) => {
  const videoRef = useRef(null);

  useEffect(() => {
    if (videoRef.current) {
      if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(
          `https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`
        );
        hls.attachMedia(videoRef.current);
      } else if (
        videoRef.current.canPlayType('application/vnd.apple.mpegurl')
      ) {
        videoRef.current.src = `https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`;
      }
    }
  }, [videoId]);

  return (
    <MediaPlayer title="Video" poster={thumbnailUrl} playsInline>
      <MediaProvider>
        <video ref={videoRef} controls />
      </MediaProvider>
    </MediaPlayer>
  );
};

export default VideoPlayer;
