import {
  RichText,
  InspectorControls,
  InnerBlocks,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { useRef, useEffect } from 'react';
import { useSelect } from '@wordpress/data';
import {
  PanelBody,
  ColorPalette,
  SelectControl,
  ToggleControl,
  RangeControl,
} from '@wordpress/components';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

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
  const swiperInstanceRef = useRef(null);

  // Obtener las familias tipográficas desde theme.json
  const fontFamilies = useSelect((select) => {
    const settings = select('core/block-editor').getSettings();
    return settings.__experimentalFeatures.typography?.fontFamilies.theme || [];
  }, []);

  const fontFamilyOptions = fontFamilies.map((font) => ({
    label: font.name,
    value: font.fontFamily,
  }));

  // navegación
  const handleNext = () => {
    if (swiperInstanceRef.current) {
      swiperInstanceRef.current.slideNext();
    }
  };

  const handlePrev = () => {
    if (swiperInstanceRef.current) {
      swiperInstanceRef.current.slidePrev();
    }
  };

  // Monitorizar los cambios en InnerBlocks
  const innerBlocks = useSelect((select) =>
    select('core/block-editor').getBlocks()
  );

  // Actualizar Swiper cuando cambian autoplay, autoplayTime, mobileSlides o desktopSlides
  useEffect(() => {
    if (swiperInstanceRef.current) {
      const swiper = swiperInstanceRef.current;
      swiper.update();
      swiper.params.autoplay = autoplay
        ? {
            delay: autoplayTime,
            disableOnInteraction: false,
          }
        : false;

      swiper.params.breakpoints = {
        640: {
          slidesPerView: mobileSlides,
        },
        1024: {
          slidesPerView: desktopSlides,
        },
      };

      swiper.update();

      if (autoplay) {
        swiper.autoplay.start();
      } else {
        swiper.autoplay.stop();
      }
    }
  }, [autoplay, autoplayTime, mobileSlides, desktopSlides, innerBlocks]);

  return (
    <>
      <InspectorControls>
        <PanelBody
          title={__('Slider Settings', 'textdomain')}
          initialOpen={true}
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
      </InspectorControls>
      <div className="w-full min-h-[200px]">
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

        <Swiper
          onSwiper={(swiper) => {
            swiperInstanceRef.current = swiper;
          }}
          slidesPerView={desktopSlides}
          modules={[Autoplay]}
          autoplay={
            autoplay
              ? { delay: autoplayTime, disableOnInteraction: false }
              : false
          }
          loop={true}
          breakpoints={{
            640: {
              slidesPerView: mobileSlides,
            },
            1024: {
              slidesPerView: desktopSlides,
            },
          }}
          style={{ backgroundColor }}
          slideClass="wp-block"
          wrapperClass="block-editor-block-list__layout"
        >
          <InnerBlocks allowedBlocks={['sage/slide']} />
        </Swiper>
        <div className="flex justify-between py-4">
          <button onClick={handlePrev} className="p-2">
            Prev
          </button>
          <button onClick={handleNext} className=" p-2">
            Next
          </button>
        </div>
      </div>
    </>
  );
};

export default Edit;
