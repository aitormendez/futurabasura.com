import React, { useEffect, useRef } from 'react';
import Hls from 'hls.js';
import '@vidstack/react/player/styles/base.css';
import { MediaPlayer, MediaProvider, Poster } from '@vidstack/react';
import {
  DefaultAudioLayout,
  defaultLayoutIcons,
  DefaultVideoLayout,
} from '@vidstack/react/player/layouts/default';

const VideoPlayer = ({
  videoId,
  thumbnailUrl,
  autoplay,
  loop,
  muted,
  controls,
  playsInline,
}) => {
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

  function onCanPlay(detail, nativeEvent) {
    // ...
  }

  return (
    <MediaPlayer
      title="Video"
      poster={thumbnailUrl}
      playsInline={playsInline}
      className="w-full aspect-video bg-slate-900 text-white font-sans overflow-hidden rounded-md ring-media-focus data-[focus]:ring-4"
      src={`https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`}
      crossOrigin
      autoPlay={autoplay}
      loop={loop}
      muted={muted}
      controls={false} // Desactiva los controles del navegador
      onCanPlay={onCanPlay}
    >
      <MediaProvider>
        <Poster
          className="absolute inset-0 block h-full w-full rounded-md opacity-0 transition-opacity data-[visible]:opacity-100 object-cover"
          src={thumbnailUrl}
          alt="Video thumbnail"
        />
      </MediaProvider>
      <DefaultVideoLayout
        icons={defaultLayoutIcons}
        thumbnails="https://files.vidstack.io/sprite-fight/thumbnails.vtt"
      />
    </MediaPlayer>
  );
};

export default VideoPlayer;
