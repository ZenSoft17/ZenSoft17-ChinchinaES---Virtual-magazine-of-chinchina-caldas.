import { Carousel, Publications, useContext, Provider_Context } from "../../../imports";
import "../../../assets/styles/revista/components/content.css";

const Content = () => {

  const { exports } = useContext(Provider_Context);
  const specialcategory = exports.DataRevista.special_category;

  return (
    <section className="section-content-revista">
      <Carousel />
      <br />
      <h2 className="title-revista">
        {specialcategory ? specialcategory.special_category : null}
      </h2>
      {/* <p className="text-revista">
        Descubre contenido único que resalta lo más excepcional de nuestra
        comunidad. No te pierdas esta selección especial que promete
        sorprenderte.
      </p> */}
      <br />
      <Publications
        category={`${
          specialcategory ? specialcategory.special_category : null
        }`}
      />
      <br />
      <h2 className="title-revista">Todas las categorías</h2>
      {/* <p className="text-revista">
        Descubre una amplia gama de publicaciones que capturan la esencia de
        cada tema. Sumérgete en experiencias únicas, relatos inspiradores y
        expresiones culturales, todo en un solo lugar. ¡Explora ahora!
      </p> */}
      <br />
      <Publications category={"all"} />
      <br />
      <br />
      <br />
    </section>
  );
};

export default Content;
