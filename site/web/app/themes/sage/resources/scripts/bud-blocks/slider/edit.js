import { useEffect, useRef } from 'react';
import { InnerBlocks } from '@wordpress/block-editor';
import Swiper from 'swiper';
import 'swiper/css';

const Edit = ({ attributes, setAttributes }) => {
  const swiperRef = useRef(null);
  const swiperInstanceRef = useRef(null);

  useEffect(() => {
    if (swiperRef.current) {
      swiperInstanceRef.current = new Swiper(swiperRef.current, {
        slidesPerView: 3,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        // Especifica las clases para Swiper
        wrapperClass: 'block-editor-block-list__layout',
        slideClass: 'wp-block',
      });

      return () => {
        if (swiperInstanceRef.current) {
          swiperInstanceRef.current.destroy();
        }
      };
    }
  }, []);

  return (
    <>
      <div className="swiper" ref={swiperRef}>
        <div className="swiper-wrapper block-editor-block-list__layout">
          <InnerBlocks
            allowedBlocks={['sage/slide']}
            renderAppender={InnerBlocks.ButtonBlockAppender}
          />
        </div>
      </div>
      <div className="flex justify-between py-4">
        <button
          onClick={() => swiperInstanceRef.current.slidePrev()}
          className="p-2"
        >
          Prev
        </button>
        <button
          onClick={() => swiperInstanceRef.current.slideNext()}
          className="p-2"
        >
          Next
        </button>
      </div>
    </>
  );
};

export default Edit;
