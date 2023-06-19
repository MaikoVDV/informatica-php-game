// Big selects are really just radio inputs, but are styled quite differently.
// This required some work for changing a div's styles based on if a radio input is active or not.
function setupBigSelects() {
  let bigSelects = document.getElementsByClassName("big-select");
  document.getElementById("gamemode-button-container").onchange = function() {
    updateBigSelects();
  }

  updateBigSelects();

  function updateBigSelects() {
    for (let i = 0; i < bigSelects.length; i++) {
      if(bigSelects[i].control.checked) {
        bigSelects[i].classList.add("active")
      } else {
        bigSelects[i].classList.remove("active")
      }
    }
  }
}
