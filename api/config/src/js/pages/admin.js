// admin scripts 

document.title = "Admin - ChinchinaES IU";

const stylesheets = [
    "../../assets/styles/admin/admin.css",
    "../../assets/styles/admin/components/bank.css",
    "../../assets/styles/admin/components/projects.css",
    "../../assets/styles/admin/components/colletion.css",
    "../../assets/styles/utils/table.css",
    "../../assets/styles/utils/profile.css",
    "../../assets/styles/utils/search_bar.css",
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

const menu = document.getElementById("menu");
const add = document.getElementById("add");
const close_menu = document.getElementById("close");

add.addEventListener("click", () => {
    menu.classList.add("sub-container-admin-change");
    add.classList.add("display-none-admin");
});

close_menu.addEventListener("click", () => {
    menu.classList.remove("sub-container-admin-change");
    add.classList.remove("display-none-admin");
});