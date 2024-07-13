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
}) => {
  const playerRef = useRef(null);

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
      className="w-full aspect-video bg-slate-900 text-white font-sans overflow-hidden rounded-md ring-media-focus data-[focus]:ring-4"
      title="Video"
      src={`https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`}
      crossOrigin
      playsInline={playsInline}
      autoPlay={autoplay}
      loop={loop}
      muted={muted}
      controls={false} // Desactiva los controles del navegador
      onProviderChange={onProviderChange}
      onCanPlay={onCanPlay}
      ref={playerRef}
    >
      <MediaProvider>
        <Poster
          className="absolute inset-0 block h-full w-full rounded-md opacity-0 transition-opacity data-[visible]:opacity-100 object-cover"
          src={thumbnailUrl}
          alt="Video thumbnail"
        />
      </MediaProvider>
      <VideoLayout />
    </MediaPlayer>
  );
};

export default VideoPlayer;
