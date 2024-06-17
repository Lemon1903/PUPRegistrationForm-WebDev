const signupForm = document.getElementById("signup-form");
const submitButton = document.querySelector(".card__btn--login");
const inputs = signupForm.querySelectorAll("input");

signupForm.addEventListener("submit", (e) => {
  e.preventDefault();

  submitButton.disabled = true;

  fetch("../includes/signup_model_inc.php", {
    method: "POST",
    body: new FormData(signupForm),
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

      if (!response.success) return alert(response.error);

      alert("User created successfully");
      window.location.href = "../index.php";
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});

function resetSubmitButton() {
  submitButton.innerHTML = "Sign Up";
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
