import {
  Link,
  useState,
  EsferaCafe,
  Menu,
  Facebook,
  Youtube,
  useScroll,
  useContext,
  Provider_Context,
} from "../../../imports";
import "../../../assets/styles/home/components/navbar.css";

const Navbar_Home = () => {
  const { exports } = useContext(Provider_Context);
  const fair = exports.DataDfc.fair;
  const publications = exports.DataRevista.publications_all;
  const [ChangeState, setChangeState] = useState(false);
  const { scroll } = useScroll({ num: 0 });
  return (
    <header className="header-home">
      <nav
        className={`navbar-home ${ChangeState ? "active-home" : ""} ${
          scroll ? "scroll-home" : ""
        }`}
      >
        <img
          className="logo-png-home"
          src={EsferaCafe}
          alt="Logo de ChinchinaES"
          loading="lazy"
        />
        <ul className={`list-home ${ChangeState ? "active-list-home" : ""}`}>
          <li className="item-home">
            <Link to="/" className="item-home">
              Home
            </Link>
          </li>
          {publications &&
            publications !== "DontExistData" &&
            publications.length > 0 && (
              <li className="item-home">
                <Link to="/revista" className="item-home">
                  ChinchinaES
                </Link>
              </li>
            )}
          {fair && fair.fair === true && (
            <li className="item-home">
              <Link to="/feria-de-la-cultura-digital" className="item-home">
                Digital Culture Fair
              </Link>
            </li>
          )}
        </ul>
        <ul
          className={`list-2-home ${ChangeState ? "active-list-2-home" : ""}`}
        >
          <li>
            <a
              href="https://youtube.com/@esferacafe5105?si=_lSJhHF9KgWFBT3G"
              className="button-networks-home"
            >
              <img
                src={Youtube}
                className="button-png-home"
                alt="YouTube icon"
                loading="lazy"
              />
            </a>
          </li>
          <li>
            <a
              href="https://www.facebook.com/share/cikLBVwsctEHBY6B/?mibextid=qi2Omg"
              className="button-networks-home"
            >
              <img
                src={Facebook}
                className="button-png-home"
                alt="Facebook icon"
                loading="lazy"
              />
            </a>
          </li>
        </ul>
        <button
          onClick={() => setChangeState((prev) => !prev)}
          className={`button-menu-home ${ChangeState ? "rotate-home" : ""}`}
          aria-label="Menu"
        >
          <img
            src={Menu}
            className="button-png-home"
            alt="Menu icon"
            loading="lazy"
          />
        </button>
      </nav>
    </header>
  );
};

export default Navbar_Home;
