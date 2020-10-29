## Webpack 是做什麼用的？可以不用它嗎？

Webpack 是一個「打包工具」。將眾多模組與資源打包成一包檔案，並編譯我們需要預先處理的內容，變成瀏覽器看得懂的東西，讓我們可以上傳到伺服器。適合用在大型的應用程式。因為大型的應用程式需要管理眾多不同類型的檔案，使用起來相對有感。

可以不用，但就要把不同的模組用 script 引入，此時可能會產生全域變數名稱衝突的問題，比較麻煩。

webpack 有一個很重要的概念叫做loader，只要有相對應的 loader，你的東西就可以模組化。舉例來說，你只要用 babel-loader，就可以把你的 ES6 檔案透過 babel compile 之後變成 ES5。而 json 檔案也可以透過 json-loader 載入，你在程式碼裡面就可以require('xx.json')。甚至你還可以把 CSS 也當作模組來載入，只要你有 css-loader 就好！



## gulp 跟 webpack 有什麼不一樣？


先一句話瞭解 webpack，webpack 本質上就是單純的 bundler 工具，用來把所有的資源打包成一塊！

gulp 則是用來把原本分散的工作流程自動化，定義執行順序，構建前端程式碼的自動化執行流程。

之所以會有人把其搞混，導致要來特地說明其差異的原因在於，兩者都能做到某部分的功能，例如文件壓縮和預處理等等，但本質上主要的定位和功能就是不同的。

## CSS Selector 權重的計算方式為何？

基本上一個先決條件就是 CSS 屬性是會繼承到底下的標籤內容的，但越底下的屬性優先次序越高。而若是 CSS 同一階層則越後面寫的優先。

如果同時在 id, class 和 tag 定義不同的屬性時，則優先次序為 id > class > tag。其權重計算方式為根據出現的次數，比方出現兩次 id 和一次 class 定義一個屬性，則其權重分數為（2, 1, 0），權重先比較優先次序高的分數，若相同則往後依次比較。

而 inline style 如  <!-- <div id="pickme" class="item" style="color: red;"> --> 則更高一層

若用權重方式可表示為 (inline style , id , attributes, element)

而 !important 是為最高層級， 但一般情況不太使用因為會覆蓋掉其他所有的屬性，讓之前寫的屬性都失去意義。

ex:  .wrapper { color: red !important; }



註：參考資料1 - [我也想要模組化開發：Webpack](https://ithelp.ithome.com.tw/articles/10188007)
註：參考資料2 - [gulp与webpack的区别](https://www.cnblogs.com/lovesong/p/6413546.html)
