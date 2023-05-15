function setupBigSelects() {
  let bigSelects = document.getElementsByClassName("big-select");
  document.getElementById("gamemode-button-container").onchange = function() {
    console.log("Something changed...");
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
