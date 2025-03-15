import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
// import { Marquee } from '@devnomic/marquee';
// import '@devnomic/marquee/dist/index.css';

export function marquee() {
  const MarqueeBlock = ({
    text,
    pillBackgroundColor,
    textColor,
    speed,
    fontFamily,
    linkUrl,
  }) => {
    const containerRef = useRef(null);
    const textRef = useRef(null);
    const [repeatedText, setRepeatedText] = useState(text);

    useEffect(() => {
      const containerWidth = containerRef.current.offsetWidth;
      const textWidth = textRef.current.offsetWidth;

      let repeated = `<span class="mx-10">${text}</span>`;
      while (textWidth < containerWidth) {
        repeated += `<span class="mx-10">${text}</span>`;
        const tempDiv = document.createElement('div');
        tempDiv.style.position = 'absolute';
        tempDiv.style.whiteSpace = 'nowrap';
        tempDiv.style.visibility = 'hidden';
        tempDiv.innerText = repeated;
        document.body.appendChild(tempDiv);
        const repeatedWidth = tempDiv.offsetWidth;
        document.body.removeChild(tempDiv);
        if (repeatedWidth >= containerWidth) break;
      }

      setRepeatedText(repeated);
    }, [text]);

    return (
      <a
        href={linkUrl}
        ref={containerRef}
        className="block marquee-container overflow-hidden rounded-3xl not-prose"
        style={{ backgroundColor: pillBackgroundColor }}
      >
        <div
          className="group flex overflow-hidden flex-row gap-[0.5rem]"
          style={{ '--duration': `${speed}s` }}
        >
          <div className="flex justify-around [--gap:0rem] shrink-0 animate-marquee-left flex-row group-hover:[animation-play-state:paused]">
            <p
              ref={textRef}
              className="text-2xl inline-block"
              style={{ color: textColor, fontFamily: fontFamily }}
              dangerouslySetInnerHTML={{ __html: repeatedText }}
            ></p>
          </div>
          <div className="flex justify-around [--gap:0rem] shrink-0 animate-marquee-left flex-row group-hover:[animation-play-state:paused]">
            <p
              ref={textRef}
              className="text-2xl inline-block"
              style={{ color: textColor, fontFamily: fontFamily }}
              dangerouslySetInnerHTML={{ __html: repeatedText }}
            ></p>
          </div>
        </div>
      </a>
    );
  };

  document.querySelectorAll('.marquee').forEach((element) => {
    const text = element.getAttribute('data-text');
    const backgroundColor = element.getAttribute('data-background-color');
    const pillBackgroundColor = element.getAttribute(
      'data-pill-background-color',
    );
    const textColor = element.getAttribute('data-text-color');
    const speed = parseFloat(element.getAttribute('data-speed')) || 10;
    const fontFamily = element.getAttribute('data-font-family');
    const linkUrl = element.getAttribute('data-link-url');
    const root = createRoot(element);
    root.render(
      <MarqueeBlock
        text={text}
        backgroundColor={backgroundColor}
        pillBackgroundColor={pillBackgroundColor}
        textColor={textColor}
        speed={speed}
        fontFamily={fontFamily}
        linkUrl={linkUrl}
      />,
    );
  });
}
