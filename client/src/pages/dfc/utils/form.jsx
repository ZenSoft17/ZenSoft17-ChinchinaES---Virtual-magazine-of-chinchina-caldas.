import { Link, usePostIFormInscriptions, useRef } from "../../../imports";

const Form_Inscriptions = () => {
  const reset = useRef(null);
  const { OnSubmit, OnChange, data, error, loading } = usePostIFormInscriptions(
    { method: "post", type: "inscriptions-insert" },
    reset
  );
  return (
    <form
      method="post"
      encType="multipart/form-data"
      className="form-inscriptions-dfc"
      onSubmit={OnSubmit}
      ref={reset}
    >
      <div className="inputs-zone-inscriptions-dfc">
        <h4 className="title-form-input-inscriptions-dfc">Autor</h4>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="email" className="label-inscriptions-dfc">
            Correo Electrónico
            <input
              type="email"
              name="email" // Nombre del input actualizado
              id="email"
              className="input-inscriptions-dfc"
              aria-required="true"
              aria-label="Correo Electrónico"
              onChange={OnChange} // Asignar el manejador onChange al input
              required
            />
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_leader" className="label-inscriptions-dfc">
            Nombre del Docente Líder del Proyecto y Datos de Contacto
            <textarea
              name="project_leader" // Nombre del input actualizado
              id="project_leader"
              className="input-inscriptions-dfc"
              aria-required="true"
              aria-label="Nombre del Docente Líder del Proyecto y Datos de Contacto"
              onChange={OnChange} // Asignar el manejador onChange al input
              required
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_mentors" className="label-inscriptions-dfc">
            Nombre del o los Mentores del Proyecto y Datos de Contacto
            <textarea
              name="project_mentors" // Nombre del input actualizado
              id="project_mentors"
              className="input-inscriptions-dfc"
              aria-required="true"
              aria-label="Nombre del o los Mentores del Proyecto y Datos de Contacto"
              required
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="exhibitors_info" className="label-inscriptions-dfc">
            Nombres de los Expositores en la Feria
            <textarea
              name="exhibitors_info" // Nombre del input actualizado
              id="exhibitors_info"
              className="input-inscriptions-dfc"
              aria-required="true"
              required
              aria-label="Nombres de los Expositores en la Feria"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <h4 className="title-form-input-inscriptions-dfc">Proyecto</h4>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_name" className="label-inscriptions-dfc">
            Nombre del Proyecto
            <input
              type="text"
              name="project_name" // Nombre del input actualizado
              id="project_name"
              className="input-inscriptions-dfc"
              required
              aria-required="true"
              aria-label="Nombre del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al input
            />
          </label>
        </div>
      </div>

      <div className="inputs-zone-inscriptions-dfc">
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_modality" className="label-inscriptions-dfc">
            Modalidad del Proyecto
            <select
              name="project_modality" // Nombre del input actualizado
              id="project_modality"
              className="input-inscriptions-dfc"
              required
              aria-required="true"
              aria-label="Modalidad del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al select
            >
              <option value="robotica">Robótica</option>
              <option value="contenidos_digitales">Contenidos Digitales</option>
              <option value="musica_electronica">Música Electrónica</option>
              <option value="musica_instrumental">Música Instrumental</option>
              <option value="otros">Otros</option>
            </select>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label
            htmlFor="project_description"
            className="label-inscriptions-dfc"
          >
            Descripción Objetiva del Proyecto
            <textarea
              name="project_description" // Nombre del input actualizado
              id="project_description"
              className="input-inscriptions-dfc"
              required
              aria-required="true"
              aria-label="Descripción Objetiva del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_phase" className="label-inscriptions-dfc">
            Fase del Proyecto
            <input
              type="text"
              name="project_phase" // Nombre del input actualizado
              id="project_phase"
              className="input-inscriptions-dfc"
              required
              aria-required="true"
              aria-label="Fase del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al input
            />
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_design" className="label-inscriptions-dfc">
            Diseño del Proyecto
            <textarea
              name="project_design" // Nombre del input actualizado
              id="project_design"
              required
              className="input-inscriptions-dfc"
              aria-required="true"
              aria-label="Diseño del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label
            htmlFor="project_development"
            className="label-inscriptions-dfc"
          >
            Desarrollo e Implementación del Proyecto
            <textarea
              name="project_development" // Nombre del input actualizado
              id="project_development"
              className="input-inscriptions-dfc"
              aria-required="true"
              aria-label="Desarrollo e Implementación del Proyecto"
              required
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
      </div>

      <div className="inputs-zone-inscriptions-dfc">
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_image" className="label-inscriptions-dfc">
            Subir Imagen del Proyecto.
            <div className="container-input-file-inscriptions-dfc">
              <input
                type="file"
                name="project_image" // Nombre del input actualizado
                id="project_image"
                className="input-file-inscriptions-dfc"
                required
                accept=".jpg,.png"
                aria-label="Subir imagen de proyecto jpeg, jpg y png"
                onChange={OnChange} // Asignar el manejador onChange al input de archivo
              />
            </div>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label
            htmlFor="project_implementation"
            className="label-inscriptions-dfc"
          >
            ¿El proyecto se ha implementado?
            <textarea
              name="project_implementation" // Nombre del input actualizado
              id="project_implementation"
              className="input-inscriptions-dfc"
              aria-required="true"
              required
              aria-label="¿El proyecto se ha implementado?"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="project_evidences" className="label-inscriptions-dfc">
            Subir Evidencias, Soportes, Certificados, etc.
            <div className="container-input-file-inscriptions-dfc">
              <input
                type="file"
                name="project_evidences" // Nombre del input actualizado
                id="project_evidences"
                className="input-file-inscriptions-dfc"
                required
                accept="*"
                aria-label="Subir Evidencias, Soportes, Certificados, etc."
                onChange={OnChange} // Asignar el manejador onChange al input de archivo
              />
            </div>
          </label>
        </div>
        <h4 className="title-form-input-inscriptions-dfc">Institución</h4>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="institution_name" className="label-inscriptions-dfc">
            Nombre de la Institución Educativa
            <input
              type="text"
              name="institution_name" // Nombre del input actualizado
              id="institution_name"
              className="input-inscriptions-dfc"
              aria-required="true"
              required
              aria-label="Nombre de la Institución Educativa"
              onChange={OnChange} // Asignar el manejador onChange al input
            />
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="foundation_date" className="label-inscriptions-dfc">
            Fecha de Fundación
            <input
              type="date"
              name="foundation_date" // Nombre del input actualizado
              id="foundation_date"
              className="input-inscriptions-dfc"
              required
              aria-required="true"
              aria-label="Fecha de Fundación"
              onChange={OnChange} // Asignar el manejador onChange al input
            />
          </label>
        </div>
      </div>

      <div className="inputs-zone-inscriptions-dfc">
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="institution_logo" className="label-inscriptions-dfc">
            Subir Escudo de la Institución Educativa
            <div className="container-input-file-inscriptions-dfc">
              <input
                type="file"
                name="institution_logo" // Nombre del input actualizado
                required
                id="institution_logo"
                className="input-file-inscriptions-dfc"
                accept=".jpg,.png"
                aria-label="Subir Escudo de la Institución Educativa"
                onChange={OnChange} // Asignar el manejador onChange al input de archivo
              />
            </div>
          </label>
        </div>
        <h4 className="title-form-input-inscriptions-dfc">Requerimientos</h4>
        <div className="inputs-group-inscriptions-dfc">
          <label
            htmlFor="technical_requirements"
            className="label-inscriptions-dfc"
          >
            Requerimientos Técnicos de Exposición del Proyecto
            <textarea
              name="technical_requirements" // Nombre del input actualizado
              id="technical_requirements"
              className="input-inscriptions-dfc"
              aria-required="true"
              required
              aria-label="Requerimientos Técnicos de Exposición del Proyecto"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-group-inscriptions-dfc">
          <label htmlFor="comments" className="label-inscriptions-dfc">
            Comentarios Adicionales
            <textarea
              name="comments" // Nombre del input actualizado
              id="comments"
              required
              className="input-inscriptions-dfc"
              aria-label="Comentarios Adicionales"
              onChange={OnChange} // Asignar el manejador onChange al input
            ></textarea>
          </label>
        </div>
        <div className="inputs-terms-group-inscriptions-dfc">
          <label
            htmlFor="terms_conditions"
            className="label-terms-inscriptions-dfc"
          >
            <input
              type="checkbox"
              name="terms_conditions"
              required
              id="terms_conditions"
              className="input-checkbox-inscriptions-dfc"
              aria-required="true"
            />
            <span className="span-label-terms-inscriptions-dfc">
              <Link to="/terms">Acepto los Términos y Condiciones</Link>
            </span>
          </label>
        </div>
        <button type="submit" className="submit-inscriptions-dfc">
          Enviar
        </button>
      </div>
    </form>
  );
};

export default Form_Inscriptions;
