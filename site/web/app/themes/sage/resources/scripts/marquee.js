import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { Marquee } from '@devnomic/marquee';
import '@devnomic/marquee/dist/index.css';

export function marquee() {
  const MarqueeBlock = ({
    text,
    pillBackgroundColor,
    textColor,
    speed,
    fontFamily,
  }) => {
    const containerRef = useRef(null);
    const textRef = useRef(null);
    const [repeatedText, setRepeatedText] = useState(text);

    useEffect(() => {
      const containerWidth = containerRef.current.offsetWidth;
      const textWidth = textRef.current.offsetWidth;

      let repeated = text;
      while (textWidth < containerWidth) {
        repeated += ' ' + text;
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

    // Construcción dinámica de la clase
    const clase = `gap-[0.5rem] [--duration:${speed}s]`;

    return (
      <div
        ref={containerRef}
        className="marquee-container rounded-3xl"
        style={{ backgroundColor: pillBackgroundColor }}
      >
        <Marquee
          className={clase}
          innerClassName="gap-[3rem] [--gap:3rem]"
          fade={false}
          direction="left"
          pauseOnHover={true}
        >
          <p
            ref={textRef}
            className="text-2xl inline-block"
            style={{ color: textColor, fontFamily: fontFamily }}
          >
            {repeatedText}
          </p>
        </Marquee>
      </div>
    );
  };

  document.querySelectorAll('.marquee').forEach((element) => {
    const text = element.getAttribute('data-text');
    const backgroundColor = element.getAttribute('data-background-color');
    const pillBackgroundColor = element.getAttribute(
      'data-pill-background-color'
    );
    const textColor = element.getAttribute('data-text-color');
    const speed = element.getAttribute('data-speed');
    const fontFamily = element.getAttribute('data-font-family');
    const root = createRoot(element);
    root.render(
      <MarqueeBlock
        text={text}
        backgroundColor={backgroundColor}
        pillBackgroundColor={pillBackgroundColor}
        textColor={textColor}
        speed={speed}
        fontFamily={fontFamily}
      />
    );
  });
}
