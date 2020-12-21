請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

const obj = {
  value: 1,
  vv: this.value,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}
  
const obj2 = obj.inner
const hello = obj.inner.hello


obj.inner.hello() // ??
obj2.hello() // ??
hello() // ??


作答：

觀念1：this 跟你程式碼在哪裡無關，只跟你哪裡呼叫有關。
觀念2：this 會去找到上一層為 object 的本身（例如 arr, class, obj），假如是呼叫處就從呼叫處找。


1. obj.inner.hello() 輸出 2

因為 this 找到的物件是 inner，而其中的 inner.value 是 2

2. obj2.hello() 輸出 2

因為有宣告 const obj2 = obj.inner 所以 obj2 地址是指向跟 obj.inner 一樣的地方
所以 obj2.hello() 基本上等於 obj.inner.hello() 所以跟上題答案一樣是 2

3. hello() 輸出是 undefined 

因為有宣告 const hello = obj.inner.hello 
所以這時期情況就有點不同

實際上是長這樣 const hello = function() {
      console.log(this.value)
    }
所以這是當你呼叫 this 他是等於 function() {
      console.log(this.value)
    }
所以 value 是找不到值的，所以輸出 console.log(this.value) 會是 undefined

