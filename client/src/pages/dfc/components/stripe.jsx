import { Provider_Context, useContext } from "../../../imports";
import "../../../assets/styles/dfc/components/stripe.css";

const Stripe = () => {
  const { exports } = useContext(Provider_Context);
  const stripe = exports.DataDfc.stripe_information;
  const advertising = exports.DataAdvertising.mark;
  const cast_time = exports.DataDfc.cast_hours;
  const themes = exports.DataDfc.themes;
  const modalities = exports.DataDfc.modalities;
  const invited = exports.DataDfc.invited;

  return (
    <section className="section-stripe-dfc">
      <h1 className="title-stripe-dfc">
        {stripe ? stripe.stripe_title : "no hay datos"}
      </h1>
      <p className="text-stripe-dfc">
        {stripe ? stripe.stripe_description.slice(0, 200) : "no hay datos"}
      </p>
      <div className="container-live-stripe-dfc">
        <div className="sub-live-stripe-dfc">
          <iframe
            src={stripe ? stripe.stripe_live : "no hay datos"}
            className="iframe-live-stripe-dfc"
            frameBorder="0"
          ></iframe>
        </div>
        <div className="sub-live-stripe-dfc">
          <h3 className="subtitle-stripe-dfc">Informacion</h3>
          <h5 className="title-live-stripe-dfc">Hora de Transmisión</h5>
          <p className="text-live-stripe-dfc">
            {cast_time && cast_time.length > 0
              ? `${cast_time.cast_time_hour_init.slice(0, 2)} am`
              : "no hay datos"}
          </p>
          <p className="text-live-stripe-dfc">
            {cast_time && cast_time.length > 0
              ? `${cast_time.cast_time_hour_end.slice(0, 2)} am`
              : "no hay datos"}
          </p>
          <h5 className="title-live-stripe-dfc">Invitado</h5>
          <p className="text-live-stripe-dfc">
            {invited ? invited.invited_name : "no hay datos"}
          </p>
          <p className="text-live-stripe-dfc">
            {invited ? invited.invited_profession : "no hay datos"}
          </p>
          <p className="text-live-stripe-dfc">
            {invited ? invited.invited_modality : "no hay datos"}
          </p>
          <h5 className="title-live-stripe-dfc">Temáticas</h5>
          {themes && themes.length > 0 &&
            themes.map((item, index) => (
              <p key={index} className="text-live-stripe-dfc">{item.theme}</p>
            ))}
          <h5 className="title-live-stripe-dfc">Modalidades</h5>
          {modalities && modalities.length > 0 ?
            modalities.map((item, index) => (
              <p key={index} className="text-live-stripe-dfc">{item.modality}</p>
            )) : (
              "no hay datos"
            )}
        </div>
      </div>
      <p className="text-stripe-dfc">Nuestros Aliados</p>
      <div className="container-marks-stripe-dfc">
        {advertising && advertising.length > 0 ?
          advertising.map((item, index) => (
            <img
              className="partner-png-home"
              src={`data:image/jpg;base64,${item.image}`}
              key={index}
              alt="Patrocinador"
              loading="lazy"
            />
          )) : (
            "no hay datos"
          )}
      </div>
    </section>
  );
};

export default Stripe;

