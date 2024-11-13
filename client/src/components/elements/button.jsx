import { useState, useEffect } from "../../imports";

const Button = ({ action, text, src, class_button, class_img, alt_img }) => {
  const [condition, setCondition] = useState('');

  useEffect(() => {
    if (text) {
      setCondition('text');
    } else if (src) {
      setCondition('img');
    }
  }, [text, src]);

  return (
    <button className={class_button} onClick={action}>
      {condition === 'text' && text}
      {condition === 'img' && <img src={src} className={class_img} alt={alt_img} />}
    </button>
  );
};

export default Button;

