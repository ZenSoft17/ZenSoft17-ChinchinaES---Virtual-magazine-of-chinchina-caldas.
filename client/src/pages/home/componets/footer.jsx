import {
  Youtube,
  Link,
  Facebook,
  Tik_Tok,
  Twitter,
  ChinchinaES,
  CorpoSer,
  useContext,
  Provider_Context,
} from "../../../imports";
import "../../../assets/styles/home/components/footer.css";

const Footer_Home = () => {
  const { exports } = useContext(Provider_Context);

  const fair = exports.DataDfc.fair;
  const publications = exports.DataRevista.publications_all;
  return (
    <footer className="footer-home">
      <div className="container-links-home">
        <ul className="list-footer-home">
          <li className="item-footer-title-home">Navegacion</li>
          <li className="item-footer-home">
            <Link to="/" className="item-footer-home">
              Home
            </Link>
          </li>
          {publications &&
            publications !== "DontExistData" &&
            publications.length > 0 && (
              <li className="item-footer-home">
                <Link to="/revista" className="item-footer-home">
                  ChinchinaES
                </Link>
              </li>
            )}
          {fair && fair.fair === true && (
            <li className="item-footer-home">
              <Link
                to="/feria-de-la-cultura-digital"
                className="item-footer-home"
              >
                Digital Culture Fair
              </Link>
            </li>
          )}
          <li className="item-footer-home">
            <Link
              to="/feria-de-la-cultura-digital"
              className="item-footer-home"
            >
              Colección CorpoSer
            </Link>
          </li>
        </ul>
        <ul className="list-footer-home">
          <li className="item-footer-title-home">Politicas del sitio</li>
          <li className="item-footer-home">
            <Link to="/terms" className="item-footer-home">
              Terminos y Condiciones
            </Link>
          </li>
          <li className="item-footer-home">
            <Link to="/terms" className="item-footer-home">
              Acerca de nosotros
            </Link>
          </li>
        </ul>
        <ul className="list-networks-home">
          <a
            href="https://www.facebook.com/share/cikLBVwsctEHBY6B/?mibextid=qi2Omg"
            className="item-network-home"
            aria-label="Facebook"
          >
            <img
              className="item-nework-png-home"
              src={Facebook}
              alt="Icono de Facebook"
              loading="lazy"
            />
          </a>
          <a
            href="https://www.tiktok.com/@esferacafe?lang=es&is_from_webapp=1&sender_device=mobile&sender_web_id=7397192358050498054"
            className="item-network-home"
            aria-label="TikTok"
          >
            <img
              className="item-nework-png-home"
              src={Tik_Tok}
              alt="Icono de Tik Tok"
              loading="lazy"
            />
          </a>
          <a
            href="https://youtube.com/@esferacafe5105?si=_lSJhHF9KgWFBT3G"
            className="item-network-home"
            aria-label="Youtube"
          >
            <img
              className="item-nework-png-home"
              src={Youtube}
              alt="Icono de YouTube"
              loading="lazy"
            />
          </a>
          <a
            href="https://twitter.com/CafeEsfera?fbclid=IwZXh0bgNhZW0CMTEAAR1Fo9hXCjCQYkVjwnvfcnlUUg6SpZdPV10jlBxWPZN0v-dB09udJE-X3NM_aem_33qBhAnk8u-uHUBwYuFFZg&sfnsn=scwspwa"
            className="item-network-home"
            aria-label="Twitter"
          >
            <img
              className="item-nework-png-home"
              src={Twitter}
              alt="Icono de Twitter"
              loading="lazy"
            />
          </a>
        </ul>
      </div>
      <div className="container-by-home">
        <p className="text-footer-home">By</p>
        <div className="by-home">
          <img
            src={CorpoSer}
            alt="Logotipo de CorpoSer"
            className="by-png-home"
            loading="lazy"
          />
          <p className="by-text-home">CorpoSer</p>
        </div>
        <div className="by-home">
          <img
            src={ChinchinaES}
            alt="Logotipo de ChinchinaES"
            className="by-png-home"
            loading="lazy"
          />
          <p className="by-text-home">EsferaCafé Producciones</p>
        </div>
        <p className="text-footer-home">@ CorpoSer.org, all rights reserved.</p>
        <br />
        <br />
      </div>
    </footer>
  );
};

export default Footer_Home;
