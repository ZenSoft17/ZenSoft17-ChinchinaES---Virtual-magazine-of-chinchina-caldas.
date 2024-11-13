import { Carousel_DFC, Provider_Context, useContext } from "../../../imports";
import "../../../assets/styles/dfc/components/projects.css";

const Projects = () => {
  const { exports } = useContext(Provider_Context);
  const projects = exports.DataDfc.projects_information;
  console.log(projects);
  
  return (
    <section className="section-projects-dfc">
      <h1 className="title-projects-dfc">
        {projects ? projects.projects_information_title : "no hay datos"}
      </h1>
      <p className="text-projects-dfc">
        {projects ? projects.projects_information_description : "no hay datos"}
      </p>
      <Carousel_DFC />
    </section>
  );
};

export default Projects;
