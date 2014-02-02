
//Devuelve el valor de una cookie
function consultarCookie(nombre) {
  var buscamos = nombre + "=";
  if (document.cookie.length > 0) {
  i = document.cookie.indexOf(buscamos);
  if (i != -1) {
    i += buscamos.length;
    j = document.cookie.indexOf(";", i);
    if (j == -1)
      j = document.cookie.length;
      return unescape(document.cookie.substring(i,j));
    }
  }
}

//Lee una cookie, el nombre de la misma se le pasa como parametro, 
//dependiendo del resultado envia a una u otra pagina
function Leer(x) {
	
  var valor = consultarCookie(x);
  if(!valor) {
    return 0;
  } else if(valor == 1){
    return 1;
  } else if(valor == 0){
    return 0; 
  } else {
    return 0; 
  }

}

//Graba una cookie, el nombre y el valor se le pasa por parametro
function Grabar(nombre,contenido){
  dCaduca=new Date();
  dCaduca.setMonth(dCaduca.getDay()+10);
  mandarCookie(nombre,contenido,dCaduca);
}

function mandarCookie(nombre, valor, caducidad) {
  document.cookie = nombre + "=" + escape(valor) + ((caducidad == null) ? "" : ("; expires=" + caducidad.toGMTString()));
} 