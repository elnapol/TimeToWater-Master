window.onload = inicializar;
var formConvalidaciones;
var refConvalidaciones;
var tbodyTablaConvalidaciones;
var CREATE = "Anadir Convalidacion";
var UPDATE = "Modificar Convalidacion";
var modo = CREATE;
var refConvalidacionAEditar;

function inicializar(){
	formConvalidaciones = document.getElementById("form-convalidaciones");
	formConvalidaciones.addEventListener("submit", enviarConvalidacionAFirebase, false)

	tbodyTablaConvalidaciones = document.getElementById("tbody-tabla-convalidaciones");

	refConvalidaciones = firebase.database().ref().child("convalidaciones");

	mostrarConvalidacionesDeFirebase();
} 

function mostrarConvalidacionesDeFirebase(){
	refConvalidaciones.on("value", function(snap){
		var datos = snap.val();
		var filasAmostrar = "";
		for(var key in datos){
			filasAmostrar += "<tr>" +
								"<td>" + datos[key].cicloAConvalidar + "</td>" +
								"<td>" + datos[key].moduloAConvalidar + "</td>" +
								"<td>" + datos[key].cicloAportado + "</td>" +
								"<td>" + datos[key].moduloAportado + "</td>" +
								'<td>' +
									'<button class="btn btn-default editar" data-convalidacion="' + key + '">' +
										'<span class="glyphicon glyphicon-pencil"></span>' +
									'</button>' +
								'</td>' +
								'<td>' +
									'<button class="btn btn-danger borrar" data-convalidacion="' + key + '">' +
										'<span class="glyphicon glyphicon-trash"></span>' +
									'</button>' +
								'</td>' +
							 "</tr>";
		}
		tbodyTablaConvalidaciones.innerHTML = filasAmostrar;
		if(filasAmostrar != ""){
			var elementosEditables = document.getElementsByClassName("editar");
			for(var i = 0; i < elementosEditables.length; i++){
				elementosEditables[i].addEventListener("click", editarConvalidacionDeFirebase, false);
			}
		
			var elementosBorrables = document.getElementsByClassName("borrar");
			for(var i = 0; i < elementosBorrables.length; i++){
				elementosBorrables[i].addEventListener("click", borrarConvalidacionDeFirebase, false);
			}
		}
	});
	

}

function editarConvalidacionDeFirebase(){
	var keyDeConvalidacionAEditar = this.getAttribute("data-convalidacion");
	refConvalidacionAEditar = refConvalidaciones.child(keyDeConvalidacionAEditar);
	refConvalidacionAEditar.once("value", function(snap){
	 	var datos = snap.val();	
		document.getElementById("modulo-a-convalidar").value = datos.moduloAConvalidar;
		document.getElementById("ciclo-a-convalidar").value = datos.cicloAConvalidar;
		document.getElementById("modulo-aportado").value = datos.moduloAportado;
		document.getElementById("ciclo-aportado").value = datos.cicloAportado;
	});
	document.getElementById("boton-enviar-convalidacion").value = UPDATE;
	modo = UPDATE;
}

function borrarConvalidacionDeFirebase(){
	var keyDeConvalidacionABorrar = this.getAttribute("data-convalidacion");
	var refConvalidacionABorrar = refConvalidaciones.child(keyDeConvalidacionABorrar);
	refConvalidacionABorrar.remove();
}

function enviarConvalidacionAFirebase(){
	event.preventDefault();
	switch(modo){
		case CREATE:
			refConvalidaciones.push({
				moduloAConvalidar: event.target.moduloAConvalidar.value,
				cicloAConvalidar: event.target.cicloAConvalidar.value,
				moduloAportado: event.target.moduloAportado.value,
				cicloAportado: event.target.cicloAportado.value
			});
		break;
		case UPDATE:
			refConvalidacionAEditar.update({
				moduloAConvalidar: event.target.moduloAConvalidar.value,
				cicloAConvalidar: event.target.cicloAConvalidar.value,
				moduloAportado: event.target.moduloAportado.value,
				cicloAportado: event.target.cicloAportado.value
			});
			modo = CREATE;
			document.getElementById("boton-enviar-convalidacion").value = CREATE;
		break;
	}
	formConvalidaciones.reset();
}