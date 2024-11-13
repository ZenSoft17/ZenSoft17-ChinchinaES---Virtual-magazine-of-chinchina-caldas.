// layout scripts 

document.title = "Layout - ChinchinaES IU";

const stylesheets = [
    "../../assets/styles/layout/layout.css",
    "../../assets/styles/layout/components/publication.css",
    "../../assets/styles/utils/table.css",
    "../../assets/styles/utils/profile.css",
    "../../assets/styles/utils/zone.css",
    "../../assets/styles/utils/form.css",
    "../../assets/styles/global.css"
];

stylesheets.forEach(item => {
    const link = document.createElement("link");
    link.rel = 'stylesheet';
    link.href = item;
    document.head.appendChild(link);
});

const add_menu_publication = document.getElementById("add-menu-publications");
const menu_publication = document.getElementById("menu-publication");
const close_publication = document.getElementById("close-menu-publication");

add_menu_publication.addEventListener("click", () => {
    menu_publication.classList.add("row-change");
    add_menu_publication.classList.add("display-none-layout");
});

close_publication.addEventListener("click", () => {
    add_menu_publication.classList.remove("display-none-layout");
    menu_publication.classList.remove("row-change");
});