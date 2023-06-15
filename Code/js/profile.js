const editBtn = document.querySelector(".edit-btn");
const saveBtn = document.querySelector(".save-btn");
const editInputs = document.querySelectorAll("input");

function edit() {
  editBtn.style.display = "none";
  saveBtn.style.display = "block";
  editInputs.forEach(function (input) {
    input.removeAttribute("disabled");
  });
}
function save() {
  editBtn.style.display = "block";
  saveBtn.style.display = "none";
  editInputs.forEach(function (input) {
    input.setAttribute("disabled", "disabled");
  });
}
