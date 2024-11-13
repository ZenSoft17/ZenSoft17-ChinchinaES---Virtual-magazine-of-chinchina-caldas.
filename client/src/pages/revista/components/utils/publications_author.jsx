import {
  useMemo,
  usePostPublicationAuthor,
  useNavigation,
} from "../../../../imports";

const Publications_Author = ({ id }) => {
  const KeyPublicationAuthor = useMemo(
    () => ({ method: "get", key: "publications_author", id: id }),
    [id]
  );
  const { HandleNavigate } = useNavigation({
    navigate: "/revista/publication",
  });
  const { data, loading, error } =
    usePostPublicationAuthor(KeyPublicationAuthor);
  const publication_author = data;
  return (
    <div className="container-publications-publication-revista">
      {loading === false ? (
        publication_author &&
        publication_author.length > 0 &&
        publication_author.map((item, index) => (
          <section
            className="item-publications-publication-revista"
            key={index}
            onClick={() => HandleNavigate(item.publication_id)}
          >
            <div className="title-overlay-publication-revista"></div>
            <img
              src={`data:image/jpg;base64,${item.publication_image}`}
              className="imagen-publications-revista"
              alt="publication"
              loading="lazy"
            />
            <h6 className="title-publications-publication-revista">
              {item.publication_name}
            </h6>
            <p className="text-publications-revista">{item.publication_date}</p>
          </section>
        ))
      ) : (
        <>
          <p className="text-publication-revista">Cargando...</p>
          <br /> <br /> <br /> <br /> <br /> <br />
        </>
      )}
    </div>
  );
};

export default Publications_Author;
