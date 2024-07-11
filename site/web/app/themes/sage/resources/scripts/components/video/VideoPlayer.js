import React, { useEffect, useRef, useState } from 'react';
import '@vidstack/react/player/styles/default/theme.css';
import {
  MediaPlayer,
  MediaProvider,
  Poster,
  Track,
  Controls,
  isHLSProvider,
} from '@vidstack/react';

const VideoPlayer = ({
  videoId,
  thumbnailUrl,
  autoplay,
  loop,
  muted,
  controls,
  playsInline,
}) => {
  const playerRef = useRef(null);
  const [src, setSrc] = useState(
    `https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`
  );
  const [viewType, setViewType] = useState('unknown');

  useEffect(() => {
    setSrc(`https://vz-9a0bcf65-610.b-cdn.net/${videoId}/playlist.m3u8`);
  }, [videoId]);

  function onProviderChange(provider, nativeEvent) {
    // Configurar el proveedor aquí si es necesario.
    if (isHLSProvider(provider)) {
      provider.config = {};
    }
  }

  function onCanPlay(detail, nativeEvent) {
    // ...
  }

  return (
    <MediaPlayer
      className="w-full aspect-video bg-slate-900 text-white font-sans overflow-hidden ring-media-focus data-[focus]:ring-4"
      title="Video"
      src={src}
      crossOrigin
      playsInline={playsInline}
      autoPlay={autoplay}
      loop={loop}
      muted={muted}
      controls={controls}
      onProviderChange={onProviderChange}
      onCanPlay={onCanPlay}
      ref={playerRef}
    >
      <MediaProvider>
        <Poster
          className="absolute inset-0 block h-full w-full opacity-0 transition-opacity data-[visible]:opacity-100 object-cover"
          src={thumbnailUrl}
          alt="Video thumbnail"
        />
      </MediaProvider>

      <Controls.Root className="vds-controls">
        <Controls.Group className="vds-controls-group">
          {/* Aquí puedes agregar controles personalizados */}
        </Controls.Group>
      </Controls.Root>
    </MediaPlayer>
  );
};

export default VideoPlayer;
