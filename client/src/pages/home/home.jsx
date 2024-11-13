import {
  Video_bg,
  Link,
  Navbar_Home,
  Footer_Home,
  Typewriter,
  Book,
  Fair,
  useContext,
  Provider_Context,
} from "../../imports";
import "../../assets/styles/home/home.css";

const Home = () => {
  document.title = "Home - ChinchinaES";
  const { exports } = useContext(Provider_Context);
  const fair = exports.DataDfc.fair;
  const publications = exports.DataRevista.publications_all;
  const mark = exports.DataAdvertising.mark;

  return (
    <div className="container-home">
      <Navbar_Home />
      <div className="container-video-bg-home">
        <video autoPlay muted loop className="bg-video-home" preload="auto">
          <source src={Video_bg} type="video/mp4" />
        </video>
      </div>
      <h1 className="title-home">
        Bienvenido a <span className="span-home-1">ChinchinaES</span>{" "}
        <span className="span-home">
          <Typewriter
            options={{
              strings: [
                "Diversión",
                "Multicultural",
                "Resistencia",
                "Patrimonio",
                "Deporte",
                "PCCC",
                "Cultura",
                "Educación",
                "Diversidad",
                "Niñas & Niños",
                "Familiar",
                "Jóvenes",
                "Internacional",
                "Solidario",
                "Empresa",
                "Emprender",
                "Comercial",
                "Comunitario",
                "Mujeres & Hombres",
                "Ambiental",
                "Veredal",
                "Barrial",
                "Región",
                "Paisaje",
                "Turismo",
                "Institucional",
                "es mucho más",
              ],
              autoStart: true,
              loop: true,
              cursor: "!",
            }}
          />
        </span>
      </h1>
      <p className="text-home">Conoce nuestras herramientas.</p>
      <section className="container-card-home">
        {publications &&
        publications !== "DontExistData" &&
        publications.length > 0 ? (
          <Link to="/revista" className="card-home">
            <div className="container-card-1-home">
              <img
                src={Book}
                className="card-png-home"
                alt="Revista del café"
                loading="lazy"
              />
            </div>
            <div className="container-text-home">
              <h3 className="title-card-home">ChinchinaES</h3>
              <p className="text-card-home">
                Entra a nuestra revista ChinchinaES; encontrarás todo tipo de
                información interesante sobre Chinchiná y el Eje Cafetero
                colombiano.
              </p>
            </div>
          </Link>
        ) : (
          <></>
        )}
        {fair && fair.fair === true ? (
          <Link to="/feria-de-la-cultura-digital" className="card-home">
            <div className="container-card-2-home">
              <img
                src={Fair}
                alt="Feria de la Cultura Digital"
                className="card-png-home"
                loading="lazy"
              />
            </div>
            <div className="container-text-home">
              <h3 className="title-card-home">DFC</h3>
              <p className="text-card-home">
                Conoce la Feria de la Cultura Digital: su información, su sede y
                inscríbete para participar en la feria digital más grande del
                municipio de Chinchiná, Caldas.
              </p>
            </div>
          </Link>
        ) : (
          <></>
        )}
      </section>
      <p className="text-home">Nuestras marcas aliadas</p>
      <section className="container-partner-home">
        {mark && mark.length > 0 ? (
          mark.map((item, index) => (
            <img
              className="partner-png-home"
              src={`data:image/jpg;base64,${item.image}`}
              key={index}
              alt="Patrocinador"
              loading="lazy"
            />
          ))
        ) : (
          <></>
        )}
      </section>
      <Footer_Home />
    </div>
  );
};

export default Home;
