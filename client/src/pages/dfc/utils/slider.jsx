import { Provider_Context, useCarousel, useContext,brand } from "../../../imports";
import "../../../assets/styles/dfc/components/slider.css";

const Slider_dfc = () => {
  const { exports } = useContext(Provider_Context);
  const image_bank = exports.DataImageBank.image_bank;
  const { Count } = useCarousel({ length: 3 });
  return (
    <div className="slider-dfc">
      <div className="container-card-slider-dfc">
        <div className={`card-slider-dfc slider-position-${(Count % 3) + 1}`}>
          <img
            src={image_bank && image_bank.length > 0 ? `data:image/jpg;base64,${
              image_bank && image_bank.length > 0 ? image_bank[0].image : null
            }` : brand}
            className="image-slider"
            alt="Arte conceptual de la feria - Imagen 1"
            loading="lazy"
          />
        </div>
        <div
          className={`card-slider-dfc slider-position-${((Count + 1) % 3) + 1}`}
        >
          <img
            src={image_bank && image_bank.length > 0 ? `data:image/jpg;base64,${
              image_bank && image_bank.length > 0 ? image_bank[1].image : null
            }` : brand}
            className="image-slider"
            alt="Arte conceptual de la feria - Imagen 2"
            loading="lazy"
          />
        </div>
        <div
          className={`card-slider-dfc slider-position-${((Count + 2) % 3) + 1}`}
        >
          <img
            src={image_bank && image_bank.length > 0 ? `data:image/jpg;base64,${
              image_bank && image_bank.length > 0 ? image_bank[2].image : null
            }` : brand}
            className="image-slider"
            alt="Arte conceptual de la feria - Imagen 3"
            loading="lazy"
          />
        </div>
      </div>
    </div>
  );
};

export default Slider_dfc;
