import {
  useBlockProps,
  BlockControls,
  InspectorControls,
  URLInput,
} from '@wordpress/block-editor';
import {
  ToolbarGroup,
  ToolbarButton,
  TextControl,
  PanelBody,
  ColorPalette,
  RangeControl,
  SelectControl,
} from '@wordpress/components';
import { useState, useEffect, useRef } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Marquee } from '@devnomic/marquee';
import '@devnomic/marquee/dist/index.css';

const fontFamilies = [
  { label: 'Arial', value: 'arial,sans-serif' },
  { label: 'Times New Roman', value: 'times-new-roman,times,serif' },
  {
    label: 'Ui-monospace',
    value:
      'ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace',
  },
  { label: 'Bugrino', value: 'Bugrino,sans-serif' },
  { label: 'FK Display', value: 'FK Display,sans-serif' },
  { label: 'ArialBlack', value: 'ArialBlack,sans-serif' },
];

const Edit = ({ attributes, setAttributes }) => {
  const {
    marqueeText,
    backgroundColor,
    pillBackgroundColor,
    textColor,
    speed,
    fontFamily,
    linkUrl,
  } = attributes;
  const [isPreview, setIsPreview] = useState(false);
  const containerRef = useRef(null);
  const textRef = useRef(null);
  const [repeatedText, setRepeatedText] = useState(marqueeText);

  const togglePreview = () => setIsPreview((prev) => !prev);

  const onChangeMarqueeText = (newMarqueeText) => {
    setAttributes({ marqueeText: newMarqueeText });
    setRepeatedText(newMarqueeText); // Reset repeatedText when text changes
  };

  const onChangeBackgroundColor = (newColor) => {
    setAttributes({ backgroundColor: newColor });
  };

  const onChangePillBackgroundColor = (newColor) => {
    setAttributes({ pillBackgroundColor: newColor });
  };

  const onChangeTextColor = (newColor) => {
    setAttributes({ textColor: newColor });
  };

  const onChangeSpeed = (newSpeed) => {
    setAttributes({ speed: newSpeed });
  };

  const onChangeFontFamily = (newFontFamily) => {
    setAttributes({ fontFamily: newFontFamily });
  };

  const onChangeLinkUrl = (newLinkUrl) => {
    setAttributes({ linkUrl: newLinkUrl });
  };

  useEffect(() => {
    if (isPreview) {
      const containerWidth = containerRef.current?.offsetWidth || 0;
      const textWidth = textRef.current?.offsetWidth || 0;

      let repeated = marqueeText;
      while (textWidth < containerWidth && textWidth > 0) {
        repeated += ' ' + marqueeText;
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
    }
  }, [marqueeText, isPreview]);

  return (
    <div {...useBlockProps()}>
      <BlockControls>
        <ToolbarGroup>
          <ToolbarButton
            icon={isPreview ? 'edit' : 'visibility'}
            label={isPreview ? __('Edit', 'sage') : __('Preview', 'sage')}
            onClick={togglePreview}
          />
        </ToolbarGroup>
      </BlockControls>
      <InspectorControls>
        <PanelBody title={__('Background Color', 'sage')} initialOpen={true}>
          <ColorPalette
            value={backgroundColor}
            onChange={onChangeBackgroundColor}
          />
        </PanelBody>
        <PanelBody
          title={__('Pill Background Color', 'sage')}
          initialOpen={true}
        >
          <ColorPalette
            value={pillBackgroundColor}
            onChange={onChangePillBackgroundColor}
          />
        </PanelBody>
        <PanelBody title={__('Text Color', 'sage')} initialOpen={true}>
          <ColorPalette value={textColor} onChange={onChangeTextColor} />
        </PanelBody>
        <PanelBody title={__('Speed', 'sage')} initialOpen={true}>
          <RangeControl
            label={__('Marquee Speed', 'sage')}
            value={speed}
            onChange={onChangeSpeed}
            min={1}
            max={20}
          />
        </PanelBody>
        <PanelBody title={__('Font Family', 'sage')} initialOpen={true}>
          <SelectControl
            label={__('Font Family', 'sage')}
            value={fontFamily}
            options={fontFamilies}
            onChange={onChangeFontFamily}
          />
        </PanelBody>
      </InspectorControls>

      {isPreview ? (
        <a
          href={linkUrl}
          ref={containerRef}
          className="block marquee-container overflow-hidden rounded-3xl"
          style={{ backgroundColor: pillBackgroundColor }}
        >
          <Marquee
            fade={false}
            direction="left"
            pauseOnHover={true}
            className={`gap-[0.5rem] [--duration:${speed}s]`}
          >
            <p
              ref={textRef}
              className="text-2xl inline-block"
              style={{ fontFamily, color: textColor }}
            >
              {repeatedText}
            </p>
          </Marquee>
        </a>
      ) : (
        <div>
          <TextControl
            label={__('Marquee Text', 'sage')}
            value={marqueeText}
            onChange={onChangeMarqueeText}
            placeholder={__('Add your marquee text here...', 'sage')}
          />
          <URLInput
            label={__('Link URL', 'sage')}
            value={linkUrl}
            onChange={onChangeLinkUrl}
            placeholder={__('Add your link here...', 'sage')}
          />
        </div>
      )}
    </div>
  );
};

export default Edit;
