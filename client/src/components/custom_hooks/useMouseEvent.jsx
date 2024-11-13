import { useEffect, useState } from "../../imports";

const useMouseEvent = ({ Ref }) => {
  const [MouseEvent, setMouseEvent] = useState(false);

  useEffect(() => {
    const MouseLeave = () => setMouseEvent(false);
    const MouseOver = () => setMouseEvent(true);

    const node = Ref.current;

    if (node) {
      node.addEventListener("mouseover", MouseOver);
      node.addEventListener("mouseleave", MouseLeave);
    }

    return () => {
      if (node) {
        node.removeEventListener("mouseover", MouseOver);
        node.removeEventListener("mouseleave", MouseLeave);
      }
    };
  }, [Ref]);

  return { MouseEvent };
};

export default useMouseEvent;
