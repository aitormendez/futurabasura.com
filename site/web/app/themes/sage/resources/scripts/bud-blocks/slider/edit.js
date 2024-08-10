import { RichText, InspectorControls } from '@wordpress/block-editor';
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
  }, [desktopSlides, mobileSlides, autoplay, autoplayTime]);

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
              <li className="glide__slide">0</li>
              <li className="glide__slide">1</li>
              <li className="glide__slide">2</li>
              <li className="glide__slide">3</li>
              <li className="glide__slide">4</li>
              <li className="glide__slide">5</li>
            </ul>
          </div>
          <div data-glide-el="controls">
            <button data-glide-dir="<<">Start</button>
            <button data-glide-dir=">>">End</button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Edit;
