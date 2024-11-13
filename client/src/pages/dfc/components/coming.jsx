import {
    fire,
    Link
} from "../../../imports";
import "../../../assets/styles/lost.css";

const Coming = () => {
    return (
        <section className="lost-container">
            <h2 className="title-lost">La feria de la cultura digital estará disponible muy pronto.</h2>
            <div className="lost">
                <img src={fire} className="image-lost" alt="" />
            </div>
            <p className="text-lost"><Link to="/">{'<-'} Volver</Link></p>
        </section>
    );
}

export default Coming;