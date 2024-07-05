import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

//dark mode toggle
const darkThemeIcon = document.querySelector("#toggle-dark-theme-icon");
const lightThemeIcon = document.querySelector("#toggle-light-theme-icon");
const themeToggleBtn = document.querySelector("#theme-toggle");
const savedTheme = localStorage.getItem("color-theme");

const toggleDarkMode = () => {
    darkThemeIcon.classList.add("hidden");
    lightThemeIcon.classList.remove("hidden");
    document.documentElement.classList.add("dark");
    localStorage.setItem("color-theme", "dark");
};

const toggleLightMode = () => {
    darkThemeIcon.classList.remove("hidden");
    lightThemeIcon.classList.add("hidden");
    document.documentElement.classList.remove("dark");
    localStorage.setItem("color-theme", "light");
};

if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    toggleDarkMode();
} else {
    toggleLightMode();
}

themeToggleBtn.addEventListener("click", function () {
    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            toggleDarkMode();
        } else {
            toggleLightMode();
        }
    } else {
        if (document.documentElement.classList.contains("dark")) {
            toggleLightMode();
        } else {
            toggleDarkMode();
        }
    }
});
