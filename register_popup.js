function registerToggle() {
   var container = document.querySelector(".container");
   container.classList.toggle("active");
   var popup = document.querySelector(".register-form");
   popup.classList.toggle("active");
}