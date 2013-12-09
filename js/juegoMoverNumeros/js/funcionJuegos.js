function aleatorio(n) {
  var aTabla = new Array(n*n);
  var aAzar = new Array(n);
  for(i = 0; i < (n*n); i++){
    
	bMal = true;
	while(bMal){
	  bMal = false;
	  iAzar =  Math.floor(Math.random() * (n*n));
	  for (j = 0; j < i; j++) {
	    if(iAzar == aTabla[j]){
		  bMal = true;
		}
	  }
	}
	aTabla[i] = iAzar;
  }
  
  for(i = 0; i < n; i++ ){
    aAzar[i] = new Array(n);
  }
  
  k = 0;
  for(i = 0; i < n; i++){
    for(j = 0; j < n; j++){
	  aAzar[i][j] = aTabla[k];
	  k++;
	}
  }
  
  return (aAzar);

}