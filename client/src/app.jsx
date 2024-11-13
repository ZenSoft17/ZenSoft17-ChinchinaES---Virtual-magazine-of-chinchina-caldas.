import {
  Router,
  Routes,
  Route,
  Terms,
  DFC,
  Revista,
  Lost,
  Home,
  Global_Context,
  Provider_Context,
  useContext,
} from "./imports";
import "./assets/styles/global.css";

const App = () => {
  return (
    <Global_Context>
      <Router>
        <Routes>
          <Route path="/" element={<Home />} />
           <Route path="/revista/*" element={<Revista />} />
           <Route path="/feria-de-la-cultura-digital/*" element={<DFC />} />
          <Route path="/terms/*" element={<Terms />} />
          <Route path="*" element={<Lost />} />
        </Routes>
      </Router>
    </Global_Context>
  );
};

export default App;
