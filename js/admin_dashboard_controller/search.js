const searchInput = document.querySelector(".card__input--search");

export function initializeSearch(users, callback) {
  searchInput.addEventListener("input", (e) => {
    const searchValue = e.target.value.toLowerCase();
    const filteredUsers = users.filter((user) => {
      return isNameIncluded(user, searchValue) || isUsernameIncluded(user, searchValue);
    });
    callback(filteredUsers);
  });
}

function isNameIncluded(user, searchValue) {
  const fullName = `${user.first_name} ${user.middle_name} ${user.middle_name} ${user.last_name}`.toLowerCase();
  return fullName.includes(searchValue);
}

function isUsernameIncluded(user, searchValue) {
  return user.username.toLowerCase().includes(searchValue);
}
