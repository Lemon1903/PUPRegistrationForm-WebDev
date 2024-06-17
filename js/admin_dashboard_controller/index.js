import { initializeSearch } from "./search.js";

function fetchAndDisplayUsers() {
  fetch("../includes/admin_dashboard_model_inc.php")
    .then((response) => response.json())
    .then((users) => {
      initializeTableBody(users);
      initializeSearch(users, initializeTableBody);
    })
    .catch((error) => {
      console.error(error);
    });
}

function initializeTableBody(users) {
  const tableBody = document.querySelector(".table-body");
  const userRows = users.map((user) => {
    const firstName = user.first_name;
    const middleName = user.middle_name;
    const lastName = user.last_name;
    const fullName = firstName ? `${firstName} ${middleName} ${lastName}` : "N/A";

    return /* html */ `
      <tr class="table-row">
        <td class="table-cell">${user.username}</td>
        <td class="table-cell table-cell--full-name">${fullName}</td>
        <td class="table-cell table-cell--course">${user.course || "N/A"}</td>
        <td class="table-cell text-center">${user.submitted ? "YES" : "NO"}</td>
        <td class="table-cell table-cell--actions">
          <a class="action-btn" href="./registration_form.php?user_id=${user.id}">
            <i class="bx bx-edit bx-sm"></i>
          </a>
          <form class="delete-form">
            <input type="hidden" name="user_id" value="${user.id}">
            <button type="submit" class="action-btn">
              <i class="bx bx-trash bx-sm"></i>
            </button>
          </form>
        </td>
      </tr>
    `;
  });
  tableBody.innerHTML = userRows.join("");
  initializeDeleteForms();
}

function initializeDeleteForms() {
  const deleteForms = document.querySelectorAll(".delete-form");

  deleteForms.forEach((deleteForm) => {
    deleteForm.addEventListener("submit", (e) => {
      e.preventDefault();

      if (!confirm("Are you sure you want to delete this user?")) return;

      const submitBtn = deleteForm.querySelector(".action-btn[type='submit']");
      submitBtn.disabled = true;

      fetch("../includes/admin_dashboard_model_inc.php", {
        method: "POST",
        body: new FormData(deleteForm),
      })
        .then((reponse) => reponse.json())
        .then((response) => {
          if (!response.success) return alert(response.error);
          fetchAndDisplayUsers();
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });
}

fetchAndDisplayUsers();
