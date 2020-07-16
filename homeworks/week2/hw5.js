/* eslint-disable */
function join(arr, concatStr) {
  var Newarr =''
  for(var i=0;i<=arr.length-1;i++){
  	Newarr += arr[i]
  	if ( i != arr.length-1){
  		Newarr += concatStr
  	}
  }
  return Newarr
}



function repeat(str, times) {
  var re =''
  for(var i=0;i<=times;i++){
  	re+=str
  }
  return re
}

console.log(join(["a", 1, "b", 2, "c", 3], ','));
console.log(repeat('a', 5));
