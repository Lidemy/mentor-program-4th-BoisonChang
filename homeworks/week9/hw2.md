## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼


1. char長度固定， 即每條數據佔用等長字節空間；適合用在身份證號碼、手機號碼等定。
2. varchar可變長度，可以設置最大長度；適合用在長度可變的屬性。
3. text不設置長度， 當不知道屬性的最大長度時，適合用text。

> 按照查詢速度： char最快， varchar次之，text最慢。

- char(n)中的 n 表示字符數，最大長度是 255 個字符，如果是 utf8 編碼方式， 那麼 char 類型佔 255 * 3 個字節。（utf8 下一個字符佔用 1 至 3 個字節）
- varchar 實際範圍是 65532 或 65533， 因爲內容頭部會佔用 1 或 2 個字節保存該字符串的長度；如果字段 default null（即默認值爲空），整條記錄還需要 1 個字節保存默認值 null。如果是 utf8 編碼，那麼 varchar 最多存 65532/3 = 21844 個字符。


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又是怎麼把 Cookie 帶去 Server 的？


Cookie 就是一個小型文字檔，它的特性是會自動帶到 Server。

Server 可以透過 HTTP Response 把資料寫到 Cookie，在 Server 的 Response 中會有一個 Header 叫做 Set-Cookie: ...，裡面就能夠放一些資訊回傳給瀏覽器，像是辨識使用者身份的 token。舉例以身份辨識來說，所有的 Requset 瀏覽器都會自動把 Cookie 帶上去，讓 Server 可以辨識這個身份。

- 用法如下（假設要存 token ）
1. setcookie("token", $token, 到期時間)     // 登入時暫存
2. setcookie("token", "", 到期時間設成負值)  // 登出時清除 token
 

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？


1. 密碼不要存明碼：否則若是資料庫被偷走，或者管理員可能可以拿到你的密碼去其他網站登入。
2. 預處理：輸入的內容，有些在 Server 中可以變成是 sql 的指令，因此要將輸入的資料用「預處理語句」處理過，明確將 sql 指令和輸入內容區分開來。
3. Token：username 要存成 token，這樣別人才無法透過更改瀏覽器 cookie 去偽造你的身份。
4. XSS：有些輸入的內容在 JS 中是有意義的，會造成非預料的網站程式碼被執行，因此要用 htmlspecialchars 將其處理成一般字串。




- 資料來源1: [MySQL性能優化之char、varchar、text的區別](https://www.twblogs.net/a/5c126982bd9eee5e40bb4de6)
