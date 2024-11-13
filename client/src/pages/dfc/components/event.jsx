import { Cert, useCounter, Slogans, useContext, Provider_Context } from "../../../imports";
import "../../../assets/styles/dfc/components/event.css";

const Event = () => {
  const { exports } = useContext(Provider_Context);

  const event = exports.DataDfc.event_information;

  const certs = exports.DataDfc.certs;

  const calendar = exports.DataDfc.calendar_activities;

  const { days, hours, minutes, seconds } = useCounter({
    eventDate:
      event && event.event_type === "date"
        ? event.event_element
        : "0000-00-00 00:00:00",
  });

  return (
    <section className="section-event-dfc">
      <Slogans />
      <div
        className={`container-counter-event-dfc ${
          event && event.event_type === "date"
            ? ""
            : "container-counter-event-dfc-change"
        }`}
      >
        <h1 className="title-counter-event-dfc">
          {days}
          <span className="date-counter-event-dfc">Dias</span>
        </h1>
        <hr className="hr-counter-event-dfc" />
        <h1 className="title-counter-event-dfc">
          {hours}
          <span className="date-counter-event-dfc">Horas</span>
        </h1>
        <hr className="hr-counter-event-dfc" />
        <h1 className="title-counter-event-dfc">
          {minutes}
          <span className="date-counter-event-dfc">Minutos</span>
        </h1>
        <hr className="hr-counter-event-dfc" />
        <h1 className="title-counter-event-dfc">
          {seconds}
          <span className="date-counter-event-dfc">Segundos</span>
        </h1>
      </div>
      <div
        className={`container-live-event-dfc ${
          event && event.event_type === "live"
            ? "container-live-event-dfc-change"
            : ""
        }`}
      >
        <h2 className="title-event-dfc">{event ? event.event_title : "no hay datos"}</h2>
        <iframe
          src={event && event === "live" ? event.event_element : ""}
          className="iframe-live-event-dfc"
        ></iframe>
      </div>
      <p className="text-event-dfc">
        Disponible muy pronto, no te pierdas el evento.
      </p>
      <h2 className="title-event-dfc">
        {calendar && calendar.lenght > 0 ? calendar[0].calendar_title : "no hay datos"}
      </h2>
      <div className="container-calendar-event-dfc">
        {calendar && calendar.lenght > 0 &&
          calendar.map(
            (item, index) =>
              index > 0 && (
                <div className="card-calendar-event-dfc" key={index}>
                  <div className="card-count-number-event-dfc">{index}</div>
                  <h4 className="title-calender-event-dfc">
                    {item.calendar_day_title}
                  </h4>
                  <p className="text-count-event-dfc">
                    {`${item.calendar_day_text}`}
                  </p>
                </div>
              )
          )}
      </div>
      <h2 className="title-event-dfc">Certificaciónes</h2>
      <div className="container-certification-event-dfc">
        {certs && certs.lenght > 0 &&
          certs.map((item, index) => (
            <div className="card-certificacion-event-dfc" key={index}>
              <div className="container-image-card-certificacion-dfc">
                <img
                  src={Cert}
                  className="image-card-certificacion-dfc"
                  alt=""
                />
              </div>
              <h3 className="title-certificacion-event-dfc">
                {item.cert_title}
              </h3>
              <p className="text-certificacion-event-dfc">{item.cert_text}</p>
            </div>
          ))}
      </div>
    </section>
  );
};

export default Event;
