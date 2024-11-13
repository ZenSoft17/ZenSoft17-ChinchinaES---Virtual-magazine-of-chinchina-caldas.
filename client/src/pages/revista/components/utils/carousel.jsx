import { Provider_Context, useCarousel, useContext, useNavigation,  } from "../../../../imports";
import "../../../../assets/styles/revista/components/carousel.css";

const Carousel = () => {
  const { exports } = useContext(Provider_Context);
  const publications = exports.DataRevista.publications_all;
  const Lenght = publications ? publications.length : 0;
  const { Count } = useCarousel({ length: Lenght });
  const { HandleNavigate } = useNavigation({ navigate: "publication" });

  return (
    <section className="container-carousel-revista">
      {publications &&
        publications !== "DontExistData" &&
        publications.length > 0 &&
        publications.map((item, index) => (
          <div
            key={index}
            className="carousel-revista"
            style={{ transform: `translateX(-${Count * 100}%)` }}
            onClick={() => HandleNavigate(item.publication_id)}
          >
            <img
              src={`data:image/jpg;base64,${item.publication_image}`}
              className="carousel-png-revista"
              alt={`carousel-image-${index}`}
            />
            <h1 className="title-carousel-revista">{item.publication_name}</h1>
            <hr className="hr-carousel-revista" />
            <p className="text-carousel-revista">{item.publication_date}</p>
          </div>
        ))}
    </section>
  );
};

export default Carousel;
