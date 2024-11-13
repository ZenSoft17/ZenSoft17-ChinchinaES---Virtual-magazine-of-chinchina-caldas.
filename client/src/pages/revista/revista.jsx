import { Footer_Home, Routes, Route, Category, Content, Navbar_revista, Search_revista, Publication_revista } from "../../imports";
import "../../assets/styles/revista/revista.css";


const Revista = () => {
  document.title = "Revista - ChinchinaES";
  return (
    <div className="container-revista">
      <Navbar_revista />
      <Routes>
        <Route path="/" element={<Content />} />
        <Route path="/category" element={<Category />} />
        <Route path="/search" element={<Search_revista />} />
        <Route path="/publication" element={<Publication_revista />} />
        <Route path="*" element={<Content />} />
      </Routes>
      <Footer_Home />
    </div>
  );
};

export default Revista;
