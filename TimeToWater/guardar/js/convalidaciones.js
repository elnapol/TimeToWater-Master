window.onload = inicializar
var formConvalidaciones;
var refConvalidaciones;

function inicializar(){
	formConvalidaciones = document.getElementById("form-convalidaciones");
	formConvalidaciones.addEventListener("submit", enviarConvalidacionAFirebase, false)


	refConvalidaciones = firebase.database().ref().child("convalidaciones");
} 



function enviarConvalidacionAFirebase(){
	event.preventDefault();
	refConvalidaciones.push({
		moduloAConvalidar: event.target.moduloAConvalidar.value,
		cicloAConvalidar: event.target.cicloAConvalidar.value,
		moduloAportado: event.target.cicloAportado.value,
		moduloAportado: event.target.moduloAportado.value
	});
}