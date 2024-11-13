// profile scripts 

const profile = document.getElementById("profile");
const add_profile = document.getElementById("add-profile");
const close_profile = document.getElementById("close-profile");

add_profile.addEventListener("click", () => {
    profile.classList.add("profile-change");
});

close_profile.addEventListener("click", () => {
    profile.classList.remove("profile-change");
})