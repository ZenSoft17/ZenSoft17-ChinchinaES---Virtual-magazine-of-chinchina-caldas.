import { useNavigate, useState, Swal } from "../../imports";

const useSearch = ({ search, state }) => {
  const [Search, setSearch] = useState("");
  const navigate = useNavigate();
  const OnChangeSearch = (e) => {
    setSearch(e.target.value);
  };
  const OnSubmitSearch = (e) => {
    e.preventDefault();
    if (Search.length === 0) {
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "debes llenar el campo de busqueda",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      state((prev) => !prev);
      setSearch("");
      navigate(`${search}`, { state: { Search } });
    }
  };
  return { OnChangeSearch, OnSubmitSearch };
};

export default useSearch;
