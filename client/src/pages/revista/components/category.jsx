import { Publications, useNavigation } from "../../../imports";
import "../../../assets/styles/revista/components/category.css";

const Category = () => {
  const { Location } = useNavigation({ navigate: "" });
  const { element } = Location.state || {};

  return (
    <section className="section-category-revista">
      <br />
      <h2 className="title-revista">{element}</h2>
      {/* <p className="text-revista">
        {element === "EsSaboresÚnicos" &&
          "Embárcate en un viaje culinario donde cada sabor cuenta una historia. Desde recetas tradicionales hasta innovaciones gastronómicas, aquí encontrarás lo mejor de la cocina."}
        {element === "EsRitmoDeLaVida" &&
          "Sumérgete en los ritmos que dan vida a nuestras historias. Explora artículos que celebran la música, la danza, y los sonidos que nos inspiran día a día."}
        {element === "EsNuestrosCuentos" &&
          "Deja que te envuelvan las narraciones que definen nuestra identidad. Relatos, leyendas, y anécdotas que han sido transmitidos a través de generaciones te esperan."}
        {element === "EsMulticultural" &&
          "Viaja por el mundo sin salir de tu pantalla y descubre la riqueza de las culturas que nos rodean. Diversidad, tradiciones, y costumbres se encuentran en este espacio."}
        {element === "EsArteInspirador" &&
          "Déjate inspirar por el arte en todas sus formas. Desde la pintura y la escultura hasta las nuevas formas de expresión, aquí celebramos la creatividad y la imaginación."}
        {element === "Otros" &&
          "Explora una variedad de temas interesantes que no encajan en las categorías habituales. Aquí encontrarás contenido diverso y sorprendente, listo para ser descubierto."}
      </p> */}
      <br />
      <Publications category={`${element}`} />
      <br />
      <br />
      <br />
    </section>
  );
};

export default Category;
