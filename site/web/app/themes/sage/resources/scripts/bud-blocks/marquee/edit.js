import {
  useBlockProps,
  BlockControls,
  InspectorControls,
} from '@wordpress/block-editor';
import {
  ToolbarGroup,
  ToolbarButton,
  TextControl,
  PanelBody,
  ColorPalette,
  RangeControl,
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Marquee } from '@devnomic/marquee';
import '@devnomic/marquee/dist/index.css';

const Edit = ({ attributes, setAttributes }) => {
  const {
    marqueeText,
    backgroundColor,
    pillBackgroundColor,
    textColor,
    speed,
  } = attributes;
  const [isPreview, setIsPreview] = useState(false);

  const togglePreview = () => setIsPreview((prev) => !prev);

  const onChangeMarqueeText = (newMarqueeText) => {
    setAttributes({ marqueeText: newMarqueeText });
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
      </InspectorControls>

      {isPreview ? (
        <Marquee
          fade={true}
          direction="left"
          pauseOnHover={true}
          className={`gap-[1rem] [--duration:${speed}s]`}
        >
          <div>{marqueeText}</div>
        </Marquee>
      ) : (
        <div>
          <TextControl
            label={__('Marquee Text', 'sage')}
            value={marqueeText}
            onChange={onChangeMarqueeText}
            placeholder={__('Add your marquee text here...', 'sage')}
          />
        </div>
      )}
    </div>
  );
};

export default Edit;
