

import { useState, useEffect } from "../../imports";

const useCarousel = ({ length }) => {
  const [Count, setCount] = useState(0);
  const [i, seti] = useState(false);

  const HandleNext = () => {
    setCount(Count === length - 1 ? 0 : Count + 1);
  };

  const HandlePreview = () => {
    setCount(Count === 0 ? length : Count - 1);
  };

  useEffect(() => {
    const timer = setTimeout(() => {
      if (i === false) {
        HandleNext();
      } else if (Count === length) {
        seti(true);
      } else if (i === true) {
        HandlePreview();
      } else if (Count === 0) {
        seti(false);
      }
    }, 5000);

    return () => clearTimeout(timer);
  }, [Count]);

  return { Count };
};

export default useCarousel;
