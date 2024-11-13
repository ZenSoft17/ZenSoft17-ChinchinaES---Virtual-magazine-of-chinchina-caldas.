import {
  Arrow_Left,
  Arrow_Right,
  Provider_Context,
  useContext,
  useNavigation,
  usePagination,
} from "../../../../imports";
import "../../../../assets/styles/revista/components/publications.css";

const Publications = ({ category }) => {
  const { exports } = useContext(Provider_Context);
  const publications = exports.DataRevista.publications_all;;
  const { HandleNavigate } = useNavigation({ navigate: "/revista/publication" });
  const filteredPublications = publications && publications !== "DontExistData" && publications.length > 0 ? publications.filter((item) => item.category === category || category === "all") : [];
  const { currentItems: currentPublications, currentPage, totalPages, goToNextPage, goToPrevPage } = usePagination(filteredPublications, 18);
  return (
    <div className="section-publications-revista">
      <div className="container-publications-revista">
        {currentPublications.map((item, index) => (
          <section
            key={item.publication_id}
            onClick={() => HandleNavigate(item.publication_id)}
            className="item-publications-revista"
          >
            <div className="title-overlay-publications-revista"></div>
            <img
              src={`data:image/jpg;base64,${item.publication_image}`}
              className="imagen-publications-revista"
              alt={`publication_${index}`}
              loading="lazy"
            />
            <h6 className="title-publications-revista">
              {item.publication_name}
            </h6>
            <p className="text-publications-revista">{item.publication_date}</p>
          </section>
        ))}
      </div>
      <div className="container-controls-publications-revista">
        <button
          className="control-publications-revista"
          onClick={goToPrevPage}
          disabled={currentPage === 1}
        >
          <img
            src={Arrow_Left}
            className="image-control-publications-revista"
            alt="image-control-revista-publications"
            loading="lazy"
          />
        </button>
        <span className="counter-publications-revista">
          {currentPage} / {totalPages}
        </span>
        <button
          className="control-publications-revista"
          onClick={goToNextPage}
          disabled={currentPage === totalPages}
        >
          <img
            src={Arrow_Right}
            className="image-control-publications-revista"
            alt="image-control-revista-publications"
            loading="lazy"
          />
        </button>
      </div>
    </div>
  );
};

export default Publications;
