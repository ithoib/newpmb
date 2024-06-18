document.addEventListener("DOMContentLoaded", function() {
    // Your existing script code here

    const menuToggle = document.getElementById("lh"); // Assuming the toggle element has an ID "lh"

    function updateMenuState(folded) {
        try {
            if (folded) {
                sessionStorage.setItem("menuState", "folded");
            } else {
                sessionStorage.removeItem("menuState");
            }
        } catch (error) {
            console.error("Error using sessionStorage:", error);
        }
    }

    function setMenuState() {
        const menuState = sessionStorage.getItem("menuState");
        if (menuState === "folded") {
            document.getElementById("a").classList.add("folded");
            document.getElementById("lh").querySelector("i").className = "fas fa-chevron-circle-right";
            document.getElementById("lh").querySelector("em").textContent = "Tampilkan";
        }
    }

    setMenuState(); // Set initial state from sessionStorage


    menuToggle.addEventListener("click", function(event) {
        const element = document.getElementById("a");
        element.classList.toggle("folded");
        const icon = document.getElementById("lh").querySelector("i");
        if (element.classList.contains("folded")) {
            icon.className = "fas fa-chevron-circle-right";
            document.getElementById("lh").querySelector("em").textContent = "Tampilkan";
            updateMenuState(true);
          } else {
            icon.className = "fas fa-chevron-circle-left";
            document.getElementById("lh").querySelector("em").textContent = "Sembunyikan";
            updateMenuState(false);
          }
    });
    // JS for Menu
    const leftMenu = document.getElementById("l");
    const toggleButton = document.getElementById("am");
    let isVisible = false;
    toggleButton.addEventListener("click", function() {
        isVisible = !isVisible;
        leftMenu.classList.toggle("show-menu");
    });
    document.addEventListener("click", function(event) {
        if (isVisible && !event.target.closest("#am") && !event.target.closest("#l")) {
            isVisible = false;
            leftMenu.classList.remove("show-menu");
        }
    });
});