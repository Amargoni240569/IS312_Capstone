const hamburger = document.querySelector(".hamburger");

const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {

    navLinks.classList.toggle("active");

});

const dropdown = document.querySelector(".dropdown");

dropdown.addEventListener("click", function(e){

    if(window.innerWidth <= 768){

        e.preventDefault();

        this.classList.toggle("active");

    }

});

// DARK MODE

const darkBtn =
document.getElementById("darkModeBtn");

if(darkBtn){

    darkBtn.addEventListener("click", () => {

        document.body.classList.toggle("dark");

        localStorage.setItem(
            "theme",
            document.body.classList.contains("dark")
            ? "dark"
            : "light"
        );
    });
}

// LOAD SAVED THEME

if(localStorage.getItem("theme") === "dark"){
    document.body.classList.add("dark");
}

// PASSWORD TOGGLE

const togglePassword =
document.getElementById("togglePassword");

const password =
document.getElementById("password");

if(togglePassword){

    togglePassword.addEventListener("click", () => {

        const type =
        password.getAttribute("type") === "password"
        ? "text"
        : "password";

        password.setAttribute("type", type);
    });
}