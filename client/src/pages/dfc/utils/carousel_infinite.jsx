import { useState, useCarousel, useContext, Provider_Context } from "../../../imports";
import "../../../assets/styles/dfc/components/projects.css";

const Carousel_DFC = () => {
  const { exports } = useContext(Provider_Context);
  const projects = exports.DataDfc.projects;
  const [ChangeState, setChangeState] = useState(true);
  const Lenght = projects.length;
  const { Count } = useCarousel({ length: Lenght });
  const isWidth = window.innerWidth < 901 ? 105 : 55;

  return (
    <div className="container-carousel-projects-dfc">
      {projects && projects.lenght > 0 && projects.map((item, index) => (
        <div
          key={index}
          className="element-carousel-projects-dfc"
          style={{ transform: `translateX(-${Count * isWidth}%)`, transition : 'transform 1s' }}
          onClick={() => setChangeState((prev) => !prev)}
        >
          <div className="row-element-carousel-projects-dfc">
            <img
              src={`data:image/jpg;base64,${item.project_image}`}
              className="image-carousel-projects-dfc"
              alt=""
            />
            {item.project_status === 'green' && (<button className="button-state-green"></button>)}
            {item.project_status === 'yellow' && (<button className="button-state-yellow"></button>)}
            {item.project_status === 'red' && (<button className="button-state-red"></button>)}
          </div>
          <div
            className={`row-element-carousel-projects-dfc ${ChangeState ? "change-opacity" : ""}`}
          >
            <p className="text-carousel-projects-dfc">{item.project_modality}</p>
            <h3 className="title-carousel-projects-dfc">{item.project_title}</h3>
            <p className="info-carousel-projects-dfc">{item.project_author}</p>
          </div>
        </div>
      ))}
    </div>
  );
};

export default Carousel_DFC;
