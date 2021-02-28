$(document).ready(function(){
  $("form").keypress(function(e) {
    if (e.which == 13) {
        return false;
    }
  });  
});

/*
 *----------------------------------------------------------------------------------
 *----------------------------------------------------------------------------------
 */

function enviar(){
    
}

function prueba1(str){
  window.alert(str);
}

function mostrarAutoresSugeridos(str, sApi, sIndex) {
    var sBusquedaApi = sApi + "?action=get_nombre_sugerido&nom=" + str;
    //window.alert(sBusquedaApi);
    //window.alert("<--| Paso N. 1 |-->");

    var xhttp;
    if (str.length == 0) { 
      document.getElementById("divListaDatos").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //window.alert("<--| Paso N. 2 |-->");

        //document.getElementById("sugerencias").innerHTML = this.responseText;
        var respuesta = JSON.parse(this.responseText);
        //window.alert(respuesta);

        var texto4 = "Autores registrados:";  // Titulo resultados
        var texto5 = "Libros publicados:";    // Sub Titulo resultados
        var texto7 = "No se han encontrado resultados.";    // Sub Titulo resultados
        var texto6 = "";                      // Línea datos HTML5

        //var texto7 = "";    // Resultado consulta Libros autor

        var iId = "";       // ID de Autor
        var nombre = "";    // Nombre Autor
        var apellido = "";  // Apellidos autor
        var titulo = "";    // Titulo del libro
        var iNumReg = 999;

        // Completa el DataList del desplegable con las opciones encontradas;
        var texto = "";
        var texto3 = "";
        var sLink = "";

        texto = '<datalist id="lista1">';
        
        var texto1 = '<div id="span_TitulosBBDD">' + texto4 + '</div>';
        var texto2 = '<div class="span_SubTitulosBBDD">' + texto5 + '</div>';
        var texto6 = texto1;

        //window.alert(respuesta.length);
        if (respuesta.length > 0) {
          
          for (var i = 0; i < respuesta.length; i++) {
              //texto2 = respuesta[i].id + "-" + respuesta[i].nombre;
              iId = respuesta[i].Id_Autor;
              nombre = respuesta[i].nombre;
              apellido = respuesta[i].apellido;
              titulo = respuesta[i].titulo;

              
              if (iNumReg != iId) {
                iNumReg = iId;
                //window.alert(nombre);

                texto += '<option value="'+ nombre +'">';
                //sLink = sIndex + "?action=get_datos_autor&id=" + respuesta[i].id;
                sLink = sApi + "?action=get_datos_autor&id=" + respuesta[i].Id_Autor;

                texto3 += "<p class='p_datosBBDD' onclick='mostrar_DatosAutor(" + '"' + sLink + '"'  + ")'><b>" + nombre  + " " + apellido + "</b></p>";
                
                texto6 += '<div class="span_Elemento1BBDD"><b>Autor:</b> ' + nombre  + " " + apellido + '</div>';
                texto6 += texto2;

              }
              texto6 += '<div class="span_Elementos2BBDD"><b>- </b>' + titulo  + '</div>';
              //obtenerLibrosSugeridos(respuesta[i].id, sApi);
          }
        } else {
          texto6 = '<div id="span_TitulosBBDD">' + texto7 + '</div>';
        }


        //texto6 += texto2;
        texto += '</datalist>';
        document.getElementById("div_datosBBDD").innerHTML = texto6;

      }
    };
    //xhttp.open("GET", "gethint.php?q="+str, true);
    xhttp.open("GET", sBusquedaApi, true);
    xhttp.send();

}



function soloCaracteres(){
	var sLetra = String.fromCharCode(event.keyCode);
	
	//window.alert(sLetra);
  //console.log("key pressed ",  String.fromCharCode(event.keyCode));
	
	var regex = new RegExp("^[0-9]+$");

	if(regex.test(sLetra)){ 
	// Si queremos agregar letras acentuadas y/o letra ñ debemos usar
	// codigos de Unicode (ejemplo: Ñ: \u00D1  ñ: \u00F1)
		event.preventDefault();
		return false;
	} else {
	// Si pasamos todas la validaciones anteriores, entonces el input es valido
		return true;
	}
}