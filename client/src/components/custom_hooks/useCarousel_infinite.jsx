// script con logica para construir un carousel infinito, pero esta logica no se implemnto
import { useEffect } from "../../imports";

// custom hook con proms de referencia y la cantidad de elementos que tiene que arrastrar
const useCarousel_Infinite = ({ container, projects }) => {

  // effect
  useEffect(() => {

    // contidicion que compureba que los promps sean diferentes a null y que esten definidos
    if (container.current && projects) {

      // se crea la constante 
      const elements = container.current.children;  
      for (let i = 0; i < elements.length; i++) {
        elements[i].classList.add('marquee');
      }
    }
  }, [container, projects]);  

  return {};
};

export default useCarousel_Infinite;
