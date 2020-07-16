/* eslint-disable */
function search(arr, n) {
	var minIndex = 0
	var maxIndex = arr.length-1
	var avgIndex = Math.round(arr.length/2)

	do{
		if ( arr[avgIndex] === n ){
			return ('有找到 '+ n +' ，index 值是：'+ avgIndex )
		} else if ( arr[minIndex] === n ){
			return ('有找到 '+ n +' ，index 值是：'+ minIndex )
		} else if ( arr[maxIndex] === n ){
			return ('有找到 '+ n +' ，index 值是：'+ maxIndex )
		} else if (arr[avgIndex] > n){
			maxIndex = avgIndex;
			avgIndex = Math.round((maxIndex+minIndex)/2)
		} else if (arr[avgIndex] < n){
			minIndex = avgIndex;
			avgIndex = Math.round((maxIndex+minIndex)/2)
		}
	} while( avgIndex != maxIndex)

	 return -1
}


console.log(search([1, 3, 10, 14, 39], 14))
