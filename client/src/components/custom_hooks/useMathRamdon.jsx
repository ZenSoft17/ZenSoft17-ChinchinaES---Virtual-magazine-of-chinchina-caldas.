import { useState, useEffect } from "../../imports";

const useMathRandom = ({ length }) => {
  const [number, setNumber] = useState(0);

  useEffect(() => {
    const timeout = setTimeout(() => {
      setNumber((num) => (num === length ? 0 : num + 1));
    }, 200);

    return () => clearTimeout(timeout);
  }, [length]);

  return { number };
};

export default useMathRandom;
