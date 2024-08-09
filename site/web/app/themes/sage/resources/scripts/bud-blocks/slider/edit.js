import { InnerBlocks, useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { useEffect, useRef } from 'react';
import Glide from '@glidejs/glide';

const Edit = ({ attributes, setAttributes }) => {
  const blockProps = useBlockProps();
  const { title, textAlign, fontSize, lineHeight, fontFamily } = attributes;
  const glideRef = useRef(null);

  useEffect(() => {
    if (glideRef.current) {
      const glide = new Glide(glideRef.current, {
        type: 'carousel',
        perView: 3,
        focusAt: 'center',
      });

      glide.mount();

      return () => glide.destroy(); // Cleanup para evitar fugas de memoria
    }
  }, []);

  return (
    <div {...blockProps}>
      <div className="w-full min-h-20">
        <RichText
          tagName="h3"
          value={title}
          onChange={(newTitle) => {
            setAttributes({ title: newTitle });
          }}
          placeholder={__('Enter title...', 'textdomain')}
          style={{
            textAlign: textAlign,
            fontSize: fontSize,
            lineHeight: lineHeight,
            fontFamily: fontFamily,
          }}
        />

        <div ref={glideRef} className="glide">
          <div className="glide__track" data-glide-el="track">
            <ul className="glide__slides">
              <li className="glide__slide">0</li>
              <li className="glide__slide">1</li>
              <li className="glide__slide">2</li>
            </ul>
          </div>
        </div>

        <div data-glide-el="controls">
          <button data-glide-dir="<<">Start</button>
          <button data-glide-dir=">>">End</button>
        </div>
      </div>
    </div>
  );
};

export default Edit;
