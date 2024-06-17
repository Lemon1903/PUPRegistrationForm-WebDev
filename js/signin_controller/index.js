const signinForm = document.getElementById("signin-form");
const submitButton = document.querySelector(".card__btn--login[type='submit']");
const inputs = signinForm.querySelectorAll("input");

signinForm.addEventListener("submit", (e) => {
  e.preventDefault();

  submitButton.disabled = true;

  fetch("includes/signin_model_inc.php", {
    method: "POST",
    body: new FormData(signinForm),
  })
    .then((response) => response.json())
    .then((response) => {
      resetFieldErrors();

      if (response.fieldErrors) {
        inputs.forEach((input) => {
          if (input.name in response.fieldErrors) {
            addFieldError(input, response.fieldErrors[input.name]);
          }
        });

        return resetSubmitButton();
      }

      if (response.user_role === "admin") {
        window.location.href = "pages/admin_dashboard.php";
      } else {
        window.location.href = "pages/registration_form.php";
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

function resetSubmitButton() {
  submitButton.innerHTML = "Sign In";
  submitButton.disabled = false;
}

function addFieldError(input, message) {
  input.classList.add("field__error");
  input.nextElementSibling.innerHTML = message;
}

function resetFieldErrors() {
  inputs.forEach((input) => {
    input.classList.remove("field__error");
    input.nextElementSibling.innerHTML = "";
  });
}
