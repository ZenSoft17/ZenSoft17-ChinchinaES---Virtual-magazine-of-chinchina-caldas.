import {
  Twitter,
  Email,
  Whatsapp,
  useContext,
  Provider_Context,
  Form_Inscriptions,
} from "../../../imports";
import "../../../assets/styles/dfc/components/inscriptions.css";

const Inscriptions = () => {
  const { exports } = useContext(Provider_Context);
  const inscriptions = exports.DataDfc.inscriptions_information;
  return (
    <section className="section-inscriptions-dfc">
      <h1 className="title-inscriptions-dfc">
        {inscriptions ? inscriptions.incriptions_title : "no hay datos"}
      </h1>

      <p className="text-inscriptions-dfc">
        {inscriptions
          ? inscriptions.incriptions_description.slice(0, 200)
          : null}
      </p>

      <div className="container-card-info-inscripcions-dfc">
        <div className="card-info-inscriptions-dfc">
          <h4 className="title-card-info-inscriptions-dfc">
            Plazo de inscripción
          </h4>
          <h6 className="sub-title-card-info-inscriptions-dfc">
            Fecha de inicio
          </h6>
          <div className="container-date-card-info-inscriptions-dfc">
            <span className="day-container-inscriptions-dfc">
              {inscriptions ? inscriptions.incriptions_start_date_day : "no hay datos"}
            </span>
            <span className="month-container-inscriptions-dfc">
              {inscriptions ? inscriptions.incriptions_start_date_month : "no hay datos"}
            </span>
          </div>
          <h6 className="sub-title-card-info-inscriptions-dfc">
            Fecha de Finalización
          </h6>
          <div className="container-date-card-info-inscriptions-dfc">
            <span className="day-container-inscriptions-dfc">
              {inscriptions ? inscriptions.incriptions_end_date_day : "no hay datos"}
            </span>
            <span className="month-container-inscriptions-dfc">
              {inscriptions ? inscriptions.incriptions_end_date_month : "no hay datos"}
            </span>
          </div>
        </div>

        <div className="card-info-inscriptions-dfc">
          <h4 className="title-card-info-inscriptions-dfc">
            Información General
          </h4>
          <p className="text-card-info-inscriptions-dfc">
            {inscriptions
              ? `${inscriptions.incriptions_general_info.slice(0, 300)}...`
              : null}
          </p>
        </div>

        <div className="card-info-inscriptions-dfc">
          <h4 className="title-card-info-inscriptions-dfc">Contacto</h4>
          <ul className="list-card-info-inscriptions-dfc">
            <li className="item-card-info-inscriptions-dfc">
              <img
                src={Whatsapp}
                className="image-card-info-inscriptions-dfc"
                alt="Facebook"
                loading="lazy"
              />
              +57 3134089876
            </li>
            <li className="item-card-info-inscriptions-dfc">
              <img
                src={Email}
                className="image-card-info-inscriptions-dfc"
                alt="Email"
                loading="lazy"
              />
              jhojanlopez@gmail.com
            </li>
            <li className="item-card-info-inscriptions-dfc">
              <img
                src={Twitter}
                className="image-card-info-inscriptions-dfc"
                alt="Instagram"
                loading="lazy"
              />
              @jhojan_lopez34
            </li>
          </ul>
        </div>
      </div>

      <h1 className="title-form-inscriptions-dfc">Datos</h1>
      <Form_Inscriptions />
    </section>
  );
};

export default Inscriptions;
