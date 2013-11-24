
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

//Graba una cookie, el nombre y el valor se le pasa por parametro
function Grabar(nombre,contenido){
  dCaduca=new Date();
  dCaduca.setMonth(dCaduca.getMonth()+1);
  mandarCookie(nombre,contenido,dCaduca);
}

function Grabar(nombre, valor, caducidad) {
  document.cookie = nombre + "=" + escape(valor) + ((caducidad == null) ? "" : ("; expires=" + caducidad.toGMTStrin()));
} 