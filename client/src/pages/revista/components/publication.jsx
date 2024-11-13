import {
  useNavigation,
  usePostPublication,
  usePostElementsPublication,
  Publications_Author
} from "../../../imports";
import "../../../assets/styles/revista/components/publication.css";

const Publication_revista = () => {
  const { Location } = useNavigation({ navigate: "" });
  const { element } = Location.state || {};
  const {
    data: datapublication,
    loading: loadingpublication,
    error: errorpublication,
  } = usePostPublication({ method: "get", key: "publication", id: element });
  const {
    data: dataElementspublication,
    loading: loadingElementspublication,
    error: errorElementspublication,
  } = usePostElementsPublication({ method: "get", key: "elements", id: element });
  const publication = datapublication;
  const elements_publication = dataElementspublication;
  console.log(dataElementspublication);
  
  return (
    <section className="container-publication-revista">
      {loadingpublication === false ? (
        <>
          <div className="container-title-revista">
            <div className="title-overlay-publication-revista"></div>
            <h3 className="category-publication-revista">
              {publication && publication.category
                ? publication.category === "Otros"
                  ? publication.category_others
                  : publication.category
                : ""}
            </h3>
            <img
              src={`data:image/jpg;base64,${
                publication ? publication.publication_image : null
              }`}
              alt=""
              className="image-png-publication-revista"
            />
            <h2 className="title-publication-revista">
              {publication ? publication.publication_name : null}
            </h2>
            <hr className="hr-publication-revista" />
            <p className="text-publication-revista">
              {publication ? publication.publication_date : null}
            </p>
          </div>
          <div className="container-content-publication-revista">
            {loadingElementspublication === false ? (
              elements_publication &&
              elements_publication.length > 0 &&
              elements_publication.map((item, index) => (
                <div
                  className="element-content-publication-revista"
                  key={index}
                >
                  {item.element_type === "title" && (
                    <h3 className="sub-title-publication-revista">
                      {item.element_text}
                    </h3>
                  )}
                  {item.element_type === "subtitle" && (
                    <h5 className="bold-text-publication-revista">
                      {item.element_text}
                    </h5>
                  )}
                  {item.element_type === "text" && (
                    <p className="sub-text-publication-revista">
                      {item.element_text}
                    </p>
                  )}
                  {item.element_type === "hr" && (
                    <hr className="sub-hr-publication-revista" />
                  )}
                  {item.element_type === "imagen" && (
                    <img
                      src={`data:image/jpg;base64,${item.element_image}`}
                      className="sub-image-publication-revista"
                      alt=""
                    />
                  )}
                  {item.element_type === "video" && (
                    <video controls className="video-publication-revista">
                      <source
                        src={`data:video/mp4;base64,${item.element_video}`}
                      />
                    </video>
                  )}
                </div>
              ))
            ) : (
              <>
                <p className="text-publication-revista">Cargando...</p>
                <br /> <br /> <br /> <br /> <br /> <br />
              </>
            )}
            <div className="container-author-publication-dfc">
              <img
                src={`data:image/jpg;base64,${
                  publication ? publication.author_image : null
                }`}
                alt=""
                className="image-author-publication-dfc"
              />
              <h3 className="name-author-publication-dfc">
                {publication ? publication.author_name : null}
              </h3>
              <p className="category-author-publication-dfc">
                {publication ? publication.author_role : null}
              </p>
            </div>
          </div>
          <h3 className="text-autor-publications-revista">
            Todas las publicaciones de este autor.
          </h3>
          {loadingpublication === false && datapublication && (
            <Publications_Author id={publication.author_id} />
          )}
        </>
      ) : (
        <>
          <p className="text-publication-revista">Cargando...</p>
          <br /> <br /> <br /> <br /> <br /> <br />
        </>
      )}
    </section>
  );
};

export default Publication_revista;
