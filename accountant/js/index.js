var hidePara = document.getElementById ("hidePara");
var hideBtn = document.getElementById ("hideBtn");
hideBtn.addEventListener("click", hideBtnClick);
function hideBtnClick () {
    hidePara.style.display = "none";
}