import { Footer_Home, Navbar_Home } from "../../imports";
import "../../assets/styles/terms/terms.css";

const Terms = () => {
  document.title = "Términos y Condiciones - ChinchinaES";
  return (
    <section className="container-terms">
      <Navbar_Home />
      <div className="sub-container-terms">
        <div className="row-container-terms">
          <h2 className="sub-title-list-terms" id="indice">
            Índice
          </h2>
          <h3 className="title-list-terms" id="revista-digital">
            Revista Digital
          </h3>
          <ul className="list-row-terms" aria-labelledby="revista-digital">
            <li className="item-row-terms">
              <a href="#uso-de-imagen">Uso de imagen</a>
            </li>
            <li className="item-row-terms">
              <a href="#escritura">Escritura</a>
            </li>
            <li className="item-row-terms">
              <a href="#autores">Autores</a>
            </li>
          </ul>

          <h3 className="title-list-terms" id="evento">
            Evento
          </h3>
          <ul className="list-row-terms" aria-labelledby="evento">
            <li className="item-row-terms">
              <a href="#contenido">Contenido</a>
            </li>
            <li className="item-row-terms">
              <a href="#datos">Datos</a>
            </li>
            <li className="item-row-terms">
              <a href="#inscripciones">Inscripciones</a>
            </li>
          </ul>

          <h3 className="title-list-terms" id="seguridad">
            Seguridad y Protección
          </h3>
          <ul className="list-row-terms" aria-labelledby="seguridad">
            <li className="item-row-terms">
              <a href="#proteccion-de-datos">Protección de datos</a>
            </li>
            <li className="item-row-terms">
              <a href="#responsabilidad">Responsabilidad</a>
            </li>
            <li className="item-row-terms">
              <a href="#terminacion">Terminación</a>
            </li>
          </ul>
        </div>

        <div className="row-container-terms">
          <h3 className="title-row-terms" id="terminos-y-condiciones">
            Términos y Condiciones
          </h3>

          <h5 className="title-content-terms" id="uso-de-imagen">
            Uso de Imagen
          </h5>
          <div
            className="container-content-terms"
            aria-labelledby="uso-de-imagen"
          >
            <p className="text-terms">
              1. Todos los usuarios de la revista digital deben obtener el
              permiso adecuado antes de utilizar cualquier imagen publicada en
              el sitio. Las imágenes deben ser utilizadas únicamente para los
              fines autorizados por el titular de los derechos.
            </p>
            <p className="text-terms">
              2. Cualquier uso comercial de las imágenes requiere una
              autorización explícita. Esto incluye, pero no se limita a, la
              reproducción en materiales promocionales, publicidad o en
              plataformas comerciales.
            </p>
            <p className="text-terms">
              3. Las imágenes deben ser atribuidas adecuadamente según las
              licencias especificadas por el autor o el titular de los derechos.
              Esta atribución debe incluir el nombre del autor, la fuente de la
              imagen y cualquier otra información requerida por la licencia.
            </p>
          </div>

          <h5 className="title-content-terms" id="escritura">
            Escritura
          </h5>
          <div className="container-content-terms" aria-labelledby="escritura">
            <p className="text-terms">
              4. Todos los artículos publicados deben ser originales y no deben
              contener contenido que infrinja los derechos de autor o que sea
              plagiado de otras fuentes. El plagio está estrictamente prohibido.
            </p>
            <p className="text-terms">
              5. Los autores son responsables de la precisión y veracidad del
              contenido presentado en sus publicaciones. Cualquier error o
              inexactitud en los datos es responsabilidad del autor.
            </p>
            <p className="text-terms">
              6. Las publicaciones deben adherirse a un código de conducta
              profesional y no deben contener lenguaje ofensivo, difamatorio o
              que promueva el odio hacia individuos o grupos.
            </p>
          </div>

          <h5 className="title-content-terms" id="autores">
            Autores
          </h5>
          <div className="container-content-terms" aria-labelledby="autores">
            <p className="text-terms">
              7. Los autores deben proporcionar información verídica y precisa
              sobre su identidad cuando envíen artículos para publicación. La
              información falsa o engañosa puede llevar a la descalificación.
            </p>
            <p className="text-terms">
              8. Cada autor es responsable de garantizar que todos los hechos
              presentados en su trabajo sean correctos y que la información
              proporcionada sea completa y fiable.
            </p>
            <p className="text-terms">
              9. Los autores deben asegurarse de que tienen todos los derechos
              necesarios para publicar cualquier contenido de terceros utilizado
              en su trabajo, incluyendo imágenes, gráficos y textos.
            </p>
          </div>

          <h5 className="title-content-terms" id="contenido">
            Contenido
          </h5>
          <div className="container-content-terms" aria-labelledby="contenido">
            <p className="text-terms">
              10. El contenido publicado en la revista digital debe ser
              relevante para el tema del evento. Debe aportar valor y estar
              relacionado con los objetivos del evento o del tema de la revista.
            </p>
            <p className="text-terms">
              11. Se prohíbe la publicación de contenido que promueva
              actividades ilegales, inmorales o que pueda causar daño. Esto
              incluye, pero no se limita a, contenido que promueva el
              terrorismo, la violencia o el racismo.
            </p>
            <p className="text-terms">
              12. Todo el contenido debe cumplir con las leyes y regulaciones
              aplicables. Los usuarios deben asegurarse de que sus publicaciones
              no violen ninguna ley local, nacional o internacional.
            </p>
          </div>

          <h5 className="title-content-terms" id="datos">
            Datos
          </h5>
          <div className="container-content-terms" aria-labelledby="datos">
            <p className="text-terms">
              13. Los datos personales recolectados durante el evento serán
              utilizados exclusivamente para fines relacionados con la
              organización y gestión del evento. No se utilizarán para fines no
              relacionados sin el consentimiento del usuario.
            </p>
            <p className="text-terms">
              14. La recopilación y el manejo de datos se realizarán en
              conformidad con las leyes de protección de datos vigentes. Esto
              incluye la implementación de medidas de seguridad adecuadas para
              proteger la información de los participantes.
            </p>
            <p className="text-terms">
              15. Los participantes tienen el derecho de solicitar la
              eliminación de sus datos en cualquier momento. Las solicitudes
              serán atendidas conforme a las políticas de privacidad aplicables.
            </p>
          </div>

          <h5 className="title-content-terms" id="inscripciones">
            Inscripciones
          </h5>
          <div
            className="container-content-terms"
            aria-labelledby="inscripciones"
          >
            <p className="text-terms">
              16. La inscripción al evento debe completarse antes de la fecha
              límite establecida para garantizar la participación. Los
              formularios de inscripción deben ser precisos y estar completos.
            </p>
            <p className="text-terms">
              17. La inscripción no garantiza automáticamente la aceptación en
              el evento. El organizador se reserva el derecho de seleccionar a
              los participantes en base a criterios establecidos.
            </p>
            <p className="text-terms">
              18. En caso de que un participante no pueda asistir al evento,
              debe notificar al organizador con la mayor antelación posible.
              Esto permitirá que se realicen ajustes necesarios en la
              programación del evento.
            </p>
          </div>

          <h5 className="title-content-terms" id="proteccion-de-datos">
            Protección de Datos
          </h5>
          <div
            className="container-content-terms"
            aria-labelledby="proteccion-de-datos"
          >
            <p className="text-terms">
              19. La protección de los datos personales es una prioridad. Se
              implementarán medidas de seguridad físicas y electrónicas para
              proteger la información contra accesos no autorizados y posibles
              violaciones.
            </p>
            <p className="text-terms">
              20. En caso de una violación de la seguridad de los datos, se
              notificará a los afectados de manera oportuna. Se tomarán medidas
              correctivas para mitigar cualquier daño y cumplir con los
              requisitos legales de notificación.
            </p>
          </div>
        </div>
      </div>
      <Footer_Home />
    </section>
  );
};

export default Terms;
