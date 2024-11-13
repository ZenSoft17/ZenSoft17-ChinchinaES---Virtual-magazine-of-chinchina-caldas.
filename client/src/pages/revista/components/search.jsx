import {
  useLocation,
  useNavigation,
  useMemo,
  usePostSearch,
} from "../../../imports";
import "../../../assets/styles/revista/components/search.css";

const Search_revista = () => {
  const { HandleNavigate } = useNavigation({
    navigate: "/revista/publication",
  });
  const location = useLocation();
  const { Search } = location.state || {};
  const keysearch = useMemo(
    () => ({ method: "get", key: "search", search: Search }),
    [Search]
  );
  const {
    data: publication,
    loading,
    error,
  } = usePostSearch(keysearch);
  console.log(publication);

  return (
    <section className="section-search-revista">
      {loading === false ? (
        <>
          <br />
          <h5 className="title-search-revista">{Search}</h5>
          <p className="text-search-revista">
            Hay{" "}
            <span className="count-search-revista">
              {publication && publication.data ? publication.data.length : "0"}
            </span>{" "}
            resultados para tu búsqueda.
          </p>
          <br />
          {publication &&
            publication.data &&
            publication.data.map((item, index) => (
              <div
                key={index}
                className="container-content-search-revista"
                onClick={() => HandleNavigate(item.publication_id)}
              >
                <img
                  src={`data:image/jpg;base64,${item.publication_image}`}
                  alt="image-search"
                  className="image-search-png-revista"
                />
                <div className="row-search-revista">
                  <span className="category-search-revista">
                    {item.category === "Otros"
                      ? item.category_others
                      : item.category}
                  </span>
                  <h6 className="title-section-search-revista">
                    {item.publication_name}
                  </h6>
                  <p className="text-section-search-revista">
                    {item.publication_date}
                  </p>
                </div>
              </div>
            ))}
          {publication && publication.error === "DontExistData" && (
            <>
              <p className="text-section-search-revista">
                No existen publicaciones
              </p>
              <br />
              <br /> <br /> <br /> <br /> <br /> <br />
            </>
          )}
          <br />
        </>
      ) : (
        <>
          <p className="text-section-search-revista">Cargando...</p>
          <br /> <br /> <br /> <br /> <br /> <br />
        </>
      )}
    </section>
  );
};

export default Search_revista;
