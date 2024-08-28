import PropTypes from 'prop-types';
import { __ } from '@wordpress/i18n';

const Preview = ({
  layout = 'layout1',
  name = 'Sample Product',
  image_url = 'https://via.placeholder.com/150',
  image_orientation = 'horizontal',
  backgroundColor = '#ffffff',
  artists_terms = [],
}) => {
  return (
    <div className="preview-block">
      {layout === 'layout1' && (
        <div className="product-block flex aspect-[50/60] w-full !max-w-none md:aspect-[100/50]">
          <div
            className="col-left w-[10%] border-r-2 border-black md:w-[30%]"
            style={{ backgroundColor }}
          ></div>

          <div className="col-center filtro-azul flex w-[80%] flex-col justify-between md:w-[40%]">
            <div className="flex h-full items-center justify-center">
              <img
                src={image_url}
                alt={name}
                className={
                  image_orientation === 'horizontal' ? 'w-full' : 'w-2/3'
                }
              />
            </div>

            {artists_terms.length > 0 && (
              <div className="mx-4 mb-3 grow-0 font-arialblack text-sm text-black md:text-base">
                <span>{name} by </span>
                {artists_terms.map((term, index) => (
                  <span key={index}>{term.name}</span>
                ))}
              </div>
            )}
          </div>

          <div
            className="col-right w-[10%] border-l-2 border-black md:w-[30%]"
            style={{ backgroundColor }}
          ></div>
        </div>
      )}

      {layout === 'layout2' && (
        <div className="layout2-preview">
          <p>{name} - Layout 2 Preview</p>
        </div>
      )}
    </div>
  );
};

Preview.propTypes = {
  layout: PropTypes.string.isRequired,
  name: PropTypes.string.isRequired,
  image_url: PropTypes.string.isRequired,
  image_orientation: PropTypes.string,
  backgroundColor: PropTypes.string,
  artists_terms: PropTypes.arrayOf(
    PropTypes.shape({
      name: PropTypes.string.isRequired,
    }),
  ),
};

export default Preview;
