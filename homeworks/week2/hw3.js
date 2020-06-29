function reverse(str) {
 	var restr=''
 	for(var i=str.length-1;i>=0;i--){
 		restr+=str[i]
 	}
 	console.log(restr)
}

reverse('hello');
