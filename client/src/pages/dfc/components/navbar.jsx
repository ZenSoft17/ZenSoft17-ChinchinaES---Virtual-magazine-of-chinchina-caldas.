import {
  Link,
  Youtube,
  Tik_Tok,
  Facebook,
  useScroll,
  useState,
  Menu,
  EsferaCafe,
  React,
  useContext,
  Provider_Context
} from "../../../imports";
import "../../../assets/styles/dfc/components/navbar.css";

const Navbar_dfc = () => {
  const { exports } = useContext(Provider_Context);
  const { scroll } = useScroll({ num: 0 });
  const [changeState, setChangeState] = useState(false);
  const views = exports.DataDfc.view;
  return (
    <header className="header-dfc">
      <nav
        className={`navbar-dfc ${scroll ? "navbar-dfc-scroll" : ""} ${
          changeState ? "navbar-dfc-scroll navbar-dfc-change" : ""
        }`}
      >
        <img src={EsferaCafe} alt="Logo" className="logo-png-dfc" />
        <ul
          className={`list-navigate-dfc ${
            changeState ? "list-navigate-dfc-change" : ""
          }`}
        >
          {views &&
            views.length > 0 &&
            views.map((item, index) => (
              <React.Fragment key={index}>
                {item.info_dfc && item.view === "si" && (
                  <li className="item-navigate-dfc">
                    <Link to="introduction">Digital Culture Fair</Link>
                  </li>
                )}
                {item.event_dfc && item.view === "si" && (
                  <li className="item-navigate-dfc">
                    <Link to="event">Evento</Link>
                  </li>
                )}
                {item.registrations_dfc && item.view === "si" && (
                  <li className="item-navigate-dfc">
                    <Link to="inscriptions">Inscripciones</Link>
                  </li>
                )}
                {item.projects_info && item.view === "si" && (
                  <li className="item-navigate-dfc">
                    <Link to="projects">Proyectos</Link>
                  </li>
                )}
                {item.stripe_dfc && item.view === "si" && (
                  <li className="item-navigate-dfc">
                    <Link to="stripe">Franja Virtual</Link>
                  </li>
                )}
              </React.Fragment>
            ))}
        </ul>
        <ul
          className={`list-networks-dfc ${
            changeState ? "list-networks-dfc-change" : ""
          }`}
        >
          <li className="item-networks-dfc">
            <a
              href="https://www.facebook.com/share/cikLBVwsctEHBY6B/?mibextid=qi2Omg"
              aria-label="Facebook"
            >
              <img src={Facebook} alt="Facebook" className="image-navbar-dfc" />
            </a>
          </li>
          <li className="item-networks-dfc">
            <a
              href="https://youtube.com/@esferacafe5105?si=_lSJhHF9KgWFBT3G"
              aria-label="Youtube"
            >
              <img src={Youtube} alt="Youtube" className="image-navbar-dfc" />
            </a>
          </li>
          <li className="item-networks-dfc">
            <a
              href="https://www.tiktok.com/@esferacafe?lang=es&is_from_webapp=1&sender_device=mobile&sender_web_id=7397192358050498054"
              aria-label="TikTok"
            >
              <img src={Tik_Tok} alt="TikTok" className="image-navbar-dfc" />
            </a>
          </li>
        </ul>
        <button
          className={`button-menu-dfc ${
            changeState ? "rotate-menu-navbar-dfc" : ""
          }`}
          onClick={() => setChangeState((prev) => !prev)}
        >
          <img src={Menu} className="image-navbar-dfc" alt="Menu" />
        </button>
      </nav>
    </header>
  );
};

export default Navbar_dfc;
