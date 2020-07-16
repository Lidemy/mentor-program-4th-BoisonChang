/* eslint-disable */
function capitalize(str) {
	var SaveFirst=''

  if (str[0]>='a' && str[0]<='z'){
  	var SaveFirst=String.fromCharCode(str[0].charCodeAt(0)-32)  
 	  	for(var i=1;i<=str.length-1;i++){
  		SaveFirst+=str[i]
  		}
 	 }else{
 	 	SaveFirst = str}
 	return SaveFirst
}

console.log(capitalize('hello'));
