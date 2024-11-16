import React, { useEffect } from 'react';

const AllowScroll = ({ children }) => {
  useEffect(() => {
    const allowScroll = (e) => {
      e.stopPropagation();
    };

    document.addEventListener('touchmove', allowScroll, { passive: false });

    return () => {
      document.removeEventListener('touchmove', allowScroll);
    };
  }, []);

  return <>{children}</>;
};

export default AllowScroll;
