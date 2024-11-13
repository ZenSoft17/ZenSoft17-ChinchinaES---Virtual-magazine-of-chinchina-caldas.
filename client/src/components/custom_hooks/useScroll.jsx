import { useState, useEffect } from "../../imports";

const useScroll = ({ num }) => {
  const [scroll, setscroll] = useState(false);

  const handle = () => {
    setscroll(window.scrollY > num);
  };

  useEffect(() => {
    window.addEventListener("scroll", handle);

    return () => {
      window.removeEventListener("scroll", handle);
    };
  }, []);

  return { scroll };
};

export default useScroll;
