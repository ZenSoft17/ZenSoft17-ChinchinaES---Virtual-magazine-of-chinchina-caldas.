import {
  special,
  culture,
  BookMenu,
  arts,
  MusicMenu,
  gastronomy,
  world,
  Link,
  useState,
  useScroll,
  useSearch,
  useNavigation,
  ChinchinaES,
  Menu_Vertical,
  Search,
  useContext,
  Provider_Context
} from "../../../../imports";
import "../../../../assets/styles/revista/components/navbar.css";
import "../../../../assets/styles/revista/components/menu_vertical.css";

const Navbar_revista = () => {
  const { exports } = useContext(Provider_Context);
  const [active_search, setactive_search] = useState(false);
  const [menuVerticalVisible, setMenuVerticalVisible] = useState(false);
  const { scroll } = useScroll({ num: 0 });
  const { OnChangeSearch, OnSubmitSearch } = useSearch({ search: "search", state: setactive_search });
  const { HandleNavigate } = useNavigation({ navigate: 'category' });
  const specialcategory = exports.DataRevista.special_category;

  return (
    <header className="container-navbar-revista">
      <nav className={`navbar-revista ${scroll ? "scroll-navbar" : ""}`}>
        <img
          src={ChinchinaES}
          className={`logo-revista-png ${active_search ? "display-none-revista" : ""}`}
          alt="logo"
        />
        <ul className={`list-nav-revista ${active_search ? "display-none-revista" : ""}`}>
          <li className="item-nav-revista">
            <Link to="/revista">
              <span className="cat-special-revista">
                {specialcategory ? specialcategory.special_category : null}
              </span>
            </Link>
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('EsMulticultural')}>
            EsMulticultural
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('EsNuestrosCuentos')}>
            EsNuestrosCuentos
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('EsArteInspirador')}>
            EsArteInspirador
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('EsRitmoDeLaVida')}>
            EsRitmoDeLaVida
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('EsSaboresÚnicos')}>
            EsSaboresÚnicos
          </li>
          <li className="item-nav-revista" onClick={() => HandleNavigate('Otros')}>
            Otros
          </li>
        </ul>
        <button
          className={`search-active-revista ${active_search ? "display-none-revista" : ""}`}
          onClick={() => setactive_search((prev) => !prev)}
        >
          <img src={Search} className="image-png-revista" alt="search" />
        </button>
        <form
          onSubmit={OnSubmitSearch}
          className={`container-search-revista ${active_search ? "display-flex-revista" : ""}`}
        >
          <input
            type="text"
            onChange={OnChangeSearch}
            className="input-search-revista"
            placeholder="Buscar..."
            name="search"
          />
          <input type="submit" className="submit-revista" />
          <button
            type="reset"
            className="search-close-revista"
            onClick={() => setactive_search((prev) => !prev)}
          >
            x
          </button>
        </form>
        <button
          className={`button-menu-revista ${active_search ? "display-none-revista" : ""}`}
          onClick={() => setMenuVerticalVisible((prev) => !prev)}
        >
          <img src={Menu_Vertical} className="image-png-revista" alt="menu" />
        </button>
      </nav>
      {menuVerticalVisible && (
        <div className="container-menu-vertical menu-vertical-display-flex-revista">
          <ul className="list-menu-vertical-revista">
            <li className="item-menu-vertical-revista">
              <img src={special} className="image-menu-vertical-revista" alt="special" />
              <Link className="cat-special-revista" to="/revista">
                {specialcategory ? specialcategory.special_category : null}
              </Link>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={culture} className="image-menu-vertical-revista" alt="culture" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("EsMulticultural")}>
                EsMulticultural
              </p>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={BookMenu} className="image-menu-vertical-revista" alt="book" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("EsNuestrosCuentos")}>
                EsNuestrosCuentos
              </p>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={arts} className="image-menu-vertical-revista" alt="arts" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("EsArteInspirador")}>
                EsArteInspirador
              </p>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={MusicMenu} className="image-menu-vertical-revista" alt="music" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("EsRitmoDeLaVida")}>
                EsRitmoDeLaVida
              </p>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={gastronomy} className="image-menu-vertical-revista" alt="gastronomy" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("EsSaboresÚnicos")}>
                EsSaboresÚnicos
              </p>
            </li>
            <li className="item-menu-vertical-revista">
              <img src={world} className="image-menu-vertical-revista" alt="world" />
              <p className="link-menu-vertical-revista" onClick={() => HandleNavigate("Otros")}>
                Otros
              </p>
            </li>
          </ul>
        </div>
      )}
    </header>
  );
};

export default Navbar_revista;
