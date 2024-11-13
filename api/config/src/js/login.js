// scripts login js

document.title = "Login - ChinchinaES IU";

const links = [
    "../assets/styles/utils/login.css",
    "../assets/styles/utils/form.css",
    "../assets/styles/global.css"
];

links.forEach(item => {
    const Link = document.createElement("link");
    Link.rel = "stylesheet";
    Link.href = item;
    document.head.appendChild(Link);
});