import React, { useEffect, useRef } from 'react';
import '@vidstack/react/player/styles/default/theme.css';
import {
  MediaPlayer,
  MediaProvider,
  Poster,
  Controls,
  PlayButton,
  useMediaState,
  isHLSProvider,
} from '@vidstack/react';
import { VideoLayout } from './video-layout';

const VideoPlayer = ({
  videoId,
  thumbnailUrl,
  autoplay,
  loop,
  muted,
  playsInline,
  controls,
}) => {
  function onProviderChange(provider, nativeEvent) {
    if (isHLSProvider(provider)) {
      provider.config = {};
    }
  }

  function onCanPlay(detail, nativeEvent) {
    // ...
  }

  return (
    <MediaPlayer
      className="relative w-full aspect-video bg-slate-900 text-white font-sans overflow-hidden ring-media-focus data-[focus]:ring-4"
      title="Video"
      src={`https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`}
      crossOrigin
      playsInline={playsInline}
      autoPlay={autoplay}
      loop={loop}
      muted={muted}
      onProviderChange={onProviderChange}
      onCanPlay={onCanPlay}
    >
      <MediaProvider>
        <Poster
          className="absolute inset-0 block h-full w-full opacity-0 transition-opacity data-[visible]:opacity-100 object-cover"
          src={thumbnailUrl}
          alt="Video thumbnail"
        />
      </MediaProvider>
      {controls && <VideoLayout />}
    </MediaPlayer>
  );
};

export default VideoPlayer;
