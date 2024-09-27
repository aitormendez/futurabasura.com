import {
  RichText,
  InspectorControls,
  InnerBlocks,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { useEffect, useRef } from 'react';
import { useSelect } from '@wordpress/data'; // Aquí se importa useSelect
import Glide, { Autoplay, Keyboard } from '@glidejs/glide';
import { Controls } from '@glidejs/glide/dist/glide.modular.esm';
import {
  PanelBody,
  ColorPalette,
  SelectControl,
  ToggleControl,
  RangeControl,
} from '@wordpress/components';

const Edit = ({ attributes, setAttributes }) => {
  const {
    title,
    fontFamily,
    backgroundColor,
    textColor,
    autoplay,
    autoplayTime,
    mobileSlides,
    desktopSlides,
  } = attributes;
  const glideRef = useRef(null);

  // Obtener las familias tipográficas desde theme.json
  const fontFamilies = useSelect((select) => {
    const settings = select('core/block-editor').getSettings();
    return settings.__experimentalFeatures.typography?.fontFamilies.theme || [];
  }, []);

  // Convertir las familias tipográficas a un formato que el SelectControl pueda utilizar
  const fontFamilyOptions = fontFamilies.map((font) => ({
    label: font.name,
    value: font.fontFamily,
  }));

  // Monitorizar los cambios en InnerBlocks
  const innerBlocks = useSelect((select) =>
    select('core/block-editor').getBlocks()
  );

  useEffect(() => {
    if (glideRef.current) {
      const glide = new Glide(glideRef.current, {
        type: 'carousel',
        perView: desktopSlides,
        focusAt: 'center',
        autoplay: autoplay ? autoplayTime : false,
        breakpoints: {
          800: {
            perView: mobileSlides,
          },
        },
      });

      glide.mount({ Controls });

      return () => glide.destroy(); // Cleanup para evitar fugas de memoria
    }
  }, [desktopSlides, mobileSlides, autoplay, autoplayTime, innerBlocks]);

  return (
    <>
      <InspectorControls>
        <PanelBody
          title={__('Background Color', 'textdomain')}
          initialOpen={true}
        >
          <ColorPalette
            value={backgroundColor}
            onChange={(newColor) =>
              setAttributes({ backgroundColor: newColor })
            }
          />
        </PanelBody>
        <PanelBody title={__('Title Color', 'textdomain')} initialOpen={true}>
          <ColorPalette
            value={textColor}
            onChange={(newColor) => setAttributes({ textColor: newColor })}
          />
        </PanelBody>
        <PanelBody title={__('Font Family', 'textdomain')} initialOpen={false}>
          <SelectControl
            label={__('Select Font Family', 'textdomain')}
            value={fontFamily}
            options={fontFamilyOptions}
            onChange={(newFont) => setAttributes({ fontFamily: newFont })}
          />
        </PanelBody>
        <PanelBody
          title={__('Slider Settings', 'textdomain')}
          initialOpen={false}
        >
          <ToggleControl
            label={__('Autoplay', 'textdomain')}
            checked={autoplay}
            onChange={(newAutoplay) => setAttributes({ autoplay: newAutoplay })}
          />
          {autoplay && (
            <RangeControl
              label={__('Autoplay Time (ms)', 'textdomain')}
              value={autoplayTime}
              onChange={(newTime) => setAttributes({ autoplayTime: newTime })}
              min={1000}
              max={10000}
            />
          )}
          <RangeControl
            label={__('Mobile Visible Slides', 'textdomain')}
            value={mobileSlides}
            onChange={(newSlides) => setAttributes({ mobileSlides: newSlides })}
            min={1}
            max={5}
          />
          <RangeControl
            label={__('Desktop Visible Slides', 'textdomain')}
            value={desktopSlides}
            onChange={(newSlides) =>
              setAttributes({ desktopSlides: newSlides })
            }
            min={1}
            max={5}
          />
        </PanelBody>
      </InspectorControls>
      <div className="w-full min-h-20">
        <div className="p-4" style={{ backgroundColor }}>
          <RichText
            className="!m-0 text-center"
            tagName="h3"
            value={title}
            onChange={(newTitle) => setAttributes({ title: newTitle })}
            placeholder={__('Enter title...', 'textdomain')}
            style={{
              fontFamily,
              color: textColor,
            }}
          />
        </div>

        <div ref={glideRef} className="glide">
          <div className="glide__track" data-glide-el="track">
            <ul className="glide__slides" style={{ backgroundColor }}>
              <InnerBlocks allowedBlocks={['sage/slide']} />
            </ul>
          </div>
          <div className="flex justify-between py-3" data-glide-el="controls">
            <button className="w-1/2 max-w-[100px]" data-glide-dir="<">
              <svg
                viewBox="0 0 92 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M92 12L2 12" stroke="#3E2B2F" stroke-width="2" />
                <path
                  d="M12.9601 1L1.99999 11.9602L12.6066 22.5668"
                  stroke="#3E2B2F"
                  stroke-width="2"
                />
              </svg>
            </button>
            <button className="w-1/2 max-w-[100px]" data-glide-dir=">">
              <svg
                width="92"
                height="24"
                viewBox="0 0 92 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M0 11.5668L90 11.5668M79.0399 22.5668L90 11.6066L79.3934 1"
                  stroke="#3E2B2F"
                  stroke-width="2"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Edit;
