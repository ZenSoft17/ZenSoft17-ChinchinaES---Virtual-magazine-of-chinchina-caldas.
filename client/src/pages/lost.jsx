import {
    Navbar_Home,
    Footer_Home,
    ChinchinaES,
    lost,
    Link
} from "../imports";
import "../assets/styles/lost.css";

const Lost = () => {
    document.title = "Página no encontrada - ChinchinaES";
    return (
        <section className="lost-container">
            <Navbar_Home />
            <h2 className="title-lost">Página no encontrada.</h2>
            <div className="lost">
                <img src={ChinchinaES} className="image-lost" alt="" />
            </div>
            <p className="text-lost"><Link to="/">{'<-'} Volver</Link></p>
            <Footer_Home />
        </section>
    );
}

export default Lost;