var btnEntraLiga = document.querySelector("#entraLiga");

btnEntraLiga.addEnventListener("click", () => {
    var liga = document.querySelector("#nomeLiga");
    var cod = document.querySelector("#codLiga");
    var alerta = document.querySelector("#alerta");

    if (!liga.value || !cod.value) {
	alerta.visibility = "visible";
  	alerta.textContent = "Campo não preenchido!";
    }
});

var btnCriaLiga = document.querySelector("#criaLiga");

btnCriaLiga.addEventListener("click", () => {
    window.location.href = "criaLiga.html";
});
