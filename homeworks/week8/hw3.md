## 什麼是 Ajax？

AJAX 是「Asynchronous JavaScript and XML」（非同步的 JavaScript 與 XML 技術）的縮寫，簡單說就是網頁不用重新整理，就能即時地透過瀏覽器去跟伺服器溝通，撈出資料。

伺服器對 AJAX 資料請求回應通常是以三種資料格式其中之一（HTML、XML、JSON），最常與 Javascript 做搭配就是 JSON。

1. 向伺服器請求 HTML 片段，然後客戶端瀏覽器上的 JavaScript 再替換掉頁面上的元素。
2. 向伺服器請求 JavaScript 程式腳本，然後客戶端瀏覽器執行它。
3. 向伺服器請求 JSON 或 XML 資料格式，然後客戶端瀏覽器的 JavaScript 解析後再動作。

## 用 Ajax 與我們用表單送出資料的差別在哪？

在非同步請求 (Asynchronous request) 還沒被開發之前，如果我們要瀏覽一則留言，就必須向 Server 重新 request 一個完整的頁面，也就是所謂的「用表單送出資料」。等待頁面切換的這段時間畫面往往會卡住不動，直到接收 response，才會重新渲染 (render) 畫面。

而 Ajax 技術的出現，讓瀏覽器可以向 Server 請求資料而不需費時等待。當瀏覽器接收到 response 之後，新的內容就會即時地添入原本網頁。這也是為什麼當我們瀏覽 Facebook、Twitter 內容時，不會看見整個網頁一直重新整理。


## JSONP 是什麼？


JSONP（JSON with Padding）是資料格式JSON的一種「使用模式」，可以讓網頁從別的網域要資料。 透過 JSONP(JSON with Padding)傳輸的，將 JSON 資料填入 Padding(Padding就是要呼叫的函式)，利用 src 不受同源限制的特性，透過 script 標籤裡的 src 元素可以引用外部網站的資源(例如jQuery)

實務上在操作 JSONP 的時候，Server 通常會提供一個 callback 的參數讓 client 端帶過去。 但 JSONP 的缺點就是你要帶的那些參數「 永遠都只能用附加在網址上的方式（GET）帶過去，沒辦法用 POST 」。很重要的一點是，要使用 JSONP 傳送資料，也要 Server 端有提供 JSONP 的方法（ 意指用 callback function 包起來 ）才行，不然回傳的 Response 就只是字串而已，沒有辦法取得資料。

## 要如何存取跨網域的 API？

只要 Server 端在 response 的 header 加上一行，就可以允許不同網域的 request 存取

access-control-allow-origin: * (* 是代表都可以存取的意思)


## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？

在 node.js 環境下發 request，並沒有瀏覽器這層限制，跨域問題只存在於透過瀏覽器發送的 request。只要瀏覽器發的 request 位置 跟 Server 端的 位置是不同源的（不同 domain ）， request 就會被瀏覽器擋掉。




參考資料1：https://medium.com/馬格蕾特的冒險者日誌/js-ajax-筆記-b9a57976fa60
參考資料2：https://yakimhsu.com/project/project_w10_review_Ajax_JSONP.html