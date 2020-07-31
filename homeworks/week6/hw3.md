## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。


<base>	定義頁面上相對 url 的基準 url

<article> 定義一段完全可以獨立於其他內容的內容塊。

<aside> 定義一段完全可以獨立於其他內容的內容塊，常使用於側邊欄。

<figure> 定義一段獨立的內容，經常用來放引用的圖片，使用方法為先用 <figure> 來包覆圖片區塊，再使用 <figcation> 來描述此張圖片的標題。


## 請問什麼是盒模型（box modal）

盒模型的解釋我認為有兩種。

其一是用來描述網頁中像是盒子的這個區塊的內層（Padding），外框（Border），以及外框外面的一層與其他區塊的距離（Margin）。

其二是打開網頁原始碼後，可以從網頁中找到盒模型的可視化區塊，會顯示每一點選區塊其盒模型的視覺化介面，讓你了解目前區塊內各「層」的大小。

補充：如果不希望設定 Padding 時，改變到整個盒子的大小，可以從 css 設定 box-sizing: border-box。就會在保留原先 border 大小下加減 padding。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

CSS display 屬性是讓網頁設計師可以自由設定網頁元素的顯示類型，HTML 每一種不同的元素都會有自己的預設值，常見的有「區塊元素」與「內行元素」。

預設為 display:block 的為「區塊元素」，而預設為 display:inline 的則是內行元素。

Flex 是 display 中新增的配置之一，能夠對被設定為 Flex 區塊內的內容做排版，想要使用 Flexbox，只要將外容器的 display 更改為 flex 或 inline-flex。。

1. 預設 inline 類型的元素有：span, a, input, img, em...。其不能調整寬和高、上下邊距也不能調。

2. 預設 block 類型的元素有 div、p、ul、li...。可以設定高度（height）、寬度（width）。（元素寬度預設會撐到最大，使其占滿整個容器）

3. 預設 inline-block 類型的元素有：buttom, input, select...。其對外像 display:inline 可以併排，對內像 display:block 可以調整各種屬性。（可水平排列）


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

css 的 position 屬性有：static (預設值)、absolute (絕對配置)、relative (相對配置)、fixed (固定配置)，以及 css3 才加入的新屬性值 sticky


1. static 預設值：網頁預設的排版方式。會一個一個元素的繪製。（由左往右或者由上往下）

2. relative 相對定位：會針對「自己原本顯示的位置為基準位置」做位移，且區塊原本的空間仍會保留不會消失。

3. absolute 絕對定位：重新以「基準元素」（非 position: static ）為起點，可以自由指定配置位置。若無基準元素就會用 body 做為參考點

4. fixed 固定定位：相對於瀏覽器的定位，一開始的位置瀏覽器即使捲動還是固定在那不動。

5. sticky：是黏住的意思，會讓元素在畫面滾動到設定值的時候，就固定在那個位置。