import "./dropdowns.js";
import { centerButton, navigationButtons, navigationPane, trackContainer, validateAllFields } from "./form_carousel.js";

const cardStart = document.querySelector(".card--start");
const carouselNav = document.querySelector(".carousel__nav--mobile");
const navigationItemContainer = document.querySelector(".navigation-pane__item-container");
const startButton = document.getElementById("start-btn");

startButton.addEventListener("click", () => {
  cardStart.style.display = "none";
  carouselNav.classList.add("show");
  trackContainer.classList.add("scale-up");

  if (window.innerWidth >= 768) {
    navigationPane.classList.add("fade-in");
    navigationItemContainer.classList.add("show");
    navigationButtons.forEach((button) => {
      button.classList.add("fade-in");
    });
  }
});

// handle form submission
const carouselForm = document.getElementById("carousel-form");
carouselForm.addEventListener("submit", (e) => {
  e.preventDefault();

  if (!validateAllFields()) return;

  const submitButton = document.querySelector(".card__btn[type='submit']");
  centerButton.textContent = "Please wait...";
  centerButton.disabled = true;
  submitButton.textContent = "Please wait...";
  submitButton.disabled = true;

  const urlParams = new URLSearchParams(window.location.search);
  fetch("../includes/reg_form_model_inc.php?" + urlParams.toString(), {
    method: "POST",
    body: new FormData(carouselForm),
  })
    .then((response) => response.json())
    .then((response) => {
      if (!response.success) return alert(response.error);
      if (response.role === "admin") {
        window.location.href = "./admin_dashboard.php";
      } else {
        window.location.href = "./finish_page.php";
      }
    })
    .catch((error) => {
      console.error(error);
    });
});
