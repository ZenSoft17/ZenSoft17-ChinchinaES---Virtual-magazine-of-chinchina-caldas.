import {
  Slider_dfc,
  Quotation,
  Robot_Icon,
  Music_Icon,
  Cinema_Icon,
  Slogans,
  Persons,
  useContext,
  Provider_Context,
  brand,
} from "../../../imports";
import "../../../assets/styles/dfc/components/introduction.css";

const Introduction = () => {
  const { exports } = useContext(Provider_Context);
  const introduction = exports.DataDfc.introduction_information;
  const image_bank = exports.DataImageBank.image_bank;
  const video_bank = exports.DataVideoBank.video_bank;
  const modalities = exports.DataDfc.modalities;
  const location = exports.DataDfc.location;
  const schedules = exports.DataDfc.asist_hours;
  const contributors = exports.DataAdvertising.contribuitor;

  return (
    <section className="section-introduction-dfc">
      <Slogans />
      <h1 className="title-introduction-dfc">
        {introduction && introduction.length > 0
          ? introduction.introduction_title
          : "no hay datos"}
      </h1>
      <p className="text-introduction-dfc">
        {introduction && introduction.length > 0
          ? introduction.introduction_description
          : "no hay datos"}
      </p>
      <Slider_dfc />
      <div className="container-objective-dfc">
        <div className="sub-container-objective-text-dfc">
          <h3 className="title-objetive-dfc">
            {"Estructura y Propósito general"}
          </h3>
          <p className="text-objective-dfc">
            <img
              src={Quotation}
              className="image-quotation-mark-dfc"
              alt="Comillas"
              loading="lazy"
            />
            {introduction && introduction.length > 0
              ? introduction.introduction_general_objective
              : "no hay datos"}
            <img
              src={Quotation}
              className="image-quotation-mark-dfc"
              alt="Comillas"
              loading="lazy"
            />
          </p>
        </div>
        <img
          className="image-objective-dfc"
          src={
            image_bank && image_bank.length > 0
              ? `data:image/jpg;base64,${
                  image_bank && image_bank.length > 0
                    ? image_bank[Math.floor(Math.random() * image_bank.length)]
                        .image
                    : null
                }`
              : brand
          }
          alt="Imagen del objetivo de la feria"
          loading="lazy"
        />
      </div>
      <h1 className="title-introduction-dfc">{"Información General"}</h1>
      <div className="container-cards-info-dfc">
        <div className="sub-card-info-dfc">
          <div className="card-info-dfc-small">
            <h3 className="title-card-info-small-dfc">Modalidades</h3>
            <p className="text-card-info-small-dfc-1">
              {modalities && modalities.length > 0
                ? modalities[2].modality
                : "no hay datos"}
              <img
                className="image-card-info-dfc-1"
                src={Robot_Icon}
                alt="Ícono de robótica"
                loading="lazy"
              />
            </p>
            <p className="text-card-info-small-dfc-2">
              <img
                className="image-card-info-dfc-2"
                src={Music_Icon}
                alt="Ícono de música electrónica"
                loading="lazy"
              />
              {modalities && modalities.length > 0
                ? modalities[1].modality
                : "no hay datos"}
            </p>
            <p className="text-card-info-small-dfc-3">
              {modalities && modalities.length > 0
                ? modalities[0].modality
                : "no hay datos"}
              <img
                className="image-card-info-dfc-1"
                src={Cinema_Icon}
                alt="Ícono de contenidos digitales"
                loading="lazy"
              />
            </p>
          </div>
          <div className="card-info-dfc-small">
            <h3 className="title-card-info-location">
              {location && location.length > 0
                ? location.location_title
                : "no hay datos"}
            </h3>
            <p className="text-card-info-location">
              {location && location.length > 0
                ? `${location.location_text.slice(0, 50)}...`
                : "no hay datos"}
            </p>
            <img
              src={
                location && location.length > 0
                  ? `data:image/jpg;base64,${
                      location && location.length > 0
                        ? location.location_image
                        : null
                    }`
                  : brand
              }
              className="image-card-info-small-3"
              alt="Imagen del auditorio"
              loading="lazy"
            />
          </div>
        </div>
        <div className="card-info-dfc-big">
          <h3 className="title-card-info-small-dfc">Horarios y Asistencia</h3>
          <br />
          <div className="container-hours-attendance-dfc">
            {schedules && schedules.length > 0 ? (
              schedules.map((item, index) => (
                <div className="sub-index-hours-attendance-dfc" key={index}>
                  <img
                    src={Persons}
                    className="index-hours-attendance-dfc"
                    alt=""
                  />
                  <h3 className="title-hours-attendance-dfc">
                    {`${item.schedules_init.slice(0, 2)} am`} -{" "}
                    {`${item.schedules_init.slice(0, 2)} am`}
                  </h3>
                  <p className="text-hours-attendance-dfc">
                    {item.schedules_text}
                  </p>
                </div>
              ))
            ) : (
              <p className="text-introduction-dfc">no hay datos</p>
            )}
          </div>
        </div>
        <div className="card-info-dfc-big">
          <h3 className="title-card-info-small-dfc">
            Video de la Digital Culture Fair
          </h3>
          <br />
          {video_bank &&
          video_bank !== "DontExistData" &&
          video_bank.length > 0 ? (
            <video className="video-card-info-big-dfc" controls>
              {(() => {
                const randomIndex = Math.floor(
                  Math.random() * video_bank.length
                );
                const videoItem = video_bank[randomIndex];

                if (videoItem && videoItem.video) {
                  return (
                    <source src={`data:video/mp4;base64,${videoItem.video}`} />
                  );
                } else {
                  return <p>No video available</p>;
                }
              })()}
            </video>
          ) : (
            <p className="text-introduction-dfc">no hay datos</p>
          )}
        </div>
      </div>
      <p className="text-introduction-dfc">
        {"Colaboradores de la Digital Culture Fair"}
      </p>
      <div className="sponsors-introduction-dfc">
        {contributors && contributors.length > 0 ? (
          contributors.map((item, index) => (
            <div className="card-sponsors-introduction-dfc" key={index}>
              <div className="sub-card-sponsors-introduction-dfc">
                <img
                  src={`data:image/jpg;base64,${item.image}`}
                  className="image-sponsors-dfc"
                  alt="Logotipo del patrocinador"
                  loading="lazy"
                />
                <h4 className="title-card-sponsors-dfc">{item.name}</h4>
                <p className="text-card-sponsors-dfc">{`${item.nickname.slice(
                  0,
                  50
                )}`}</p>
              </div>
              <p className="message-card-sponsors-dfc">
                {`${item.description.slice(0, 100)}..`}
              </p>
            </div>
          ))
        ) : (
          <>
          <p className="text-introduction-dfc">no hay datos</p>
          </>
        )}
      </div>
    </section>
  );
};

export default Introduction;
