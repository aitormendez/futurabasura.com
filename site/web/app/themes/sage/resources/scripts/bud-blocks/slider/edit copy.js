import { InnerBlocks } from '@wordpress/block-editor';

const Edit = ({ attributes, setAttributes }) => {
  return (
    <div className="bg-allo p-20">
      <h1>Test Block</h1>
      <InnerBlocks allowedBlocks={['sage/slide']} />
    </div>
  );
};

export default Edit;
