import { InnerBlocks, useBlockProps, RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

const Edit = ({ attributes, setAttributes }) => {
  const blockProps = useBlockProps();
  const { title, textAlign, fontSize, lineHeight, fontFamily } = attributes;
  console.log('blockProps', blockProps);
  console.log(attributes);

  return (
    <div {...blockProps}>
      <div className="w-full min-h-20">
        <RichText
          tagName="h3"
          value={title}
          onChange={(newTitle) => {
            setAttributes({ title: newTitle });
            console.log(blockProps);
          }}
          placeholder={__('Enter title...', 'textdomain')}
          style={{
            textAlign: textAlign,
            fontSize: fontSize,
            lineHeight: lineHeight,
            fontFamily: fontFamily,
          }}
        />
        <div className="slider">{/* <InnerBlocks /> */}</div>
      </div>
    </div>
  );
};

export default Edit;
