import {
  Routes,
  Route,
  Introduction,
  Event,
  Footer_Home,
  Inscriptions,
  Projects,
  Stripe,
  Navbar_dfc,
  Coming,
  React,
  useContext,
  Provider_Context
} from "../../imports";
import "../../assets/styles/dfc/dfc.css";

const DFC = () => {
  document.title = "Feria de la Cultura Digital - ChinchinaES";
  const { exports } = useContext(Provider_Context);
  const views = exports.DataDfc.view;
  return (
    <section className="section-dfc">
      <Navbar_dfc />
      <Routes>
        {views && views.filter((item) => item.view === "si").length > 0 ? (
          views.map((item, index) => (
            <React.Fragment key={index}>
              {item.info_dfc && <Route path="/" element={<Introduction />} />}
              {item.event_dfc && <Route path="/event" element={<Event />} />}
              {item.registrations_dfc && (
                <Route path="/inscriptions" element={<Inscriptions />} />
              )}
              {item.projects_info && (
                <Route path="/projects" element={<Projects />} />
              )}
              {item.stripe_dfc && <Route path="/stripe" element={<Stripe />} />}
              {item.info_dfc && <Route path="*" element={<Introduction />} />}
            </React.Fragment>
          ))
        ) : (
          <Route path="*" element={<Coming />} />
        )}
      </Routes>
      <Footer_Home />
    </section>
  );
};

export default DFC;
