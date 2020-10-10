## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫

直接存明文密碼在資料庫內在資訊安全上非常危險，若資料庫被駭、或者管理員居心不良，都可能取得你的常用密碼，因此密碼需要經過處理過後才存入資料庫。加密（Encrypt）和雜湊（Hashing）都是一種處理密碼的方式，而編碼（Encoding）也是一種類似加密的方式，但由於其安全性過低通常只用在非重要資訊的資料傳輸上。

1. 編碼（Encoding）：摩斯密碼就是一種編碼方式，其有一個對照表，因此只要取得對照表基本上沒有秘密可言。

2. 加密（Encrypt）：加密跟解密需要一個金鑰（Key)，簡單來說密碼會以 Key 值為基礎作一處理後偏移，加密的演算法可簡單可複雜，但基本上由於密碼與加密後的密碼是一對一的關係，還是有機會被回推。有趣的是區塊鏈也衍伸出了公鑰（Public Key）跟私鑰（Private Key）的特殊模式作為密碼在不同人間的傳輸。

3. 雜湊（Hashing）：基本上是多對一的加密演算法稱之「單向函式」，輸入很多值可能都會得到同樣加密後的結果，因此在茫茫大海的數字隨機組合中難以回推，但也有駭客會嘗試以常用密碼對照表的方式去猜測破解密碼，但在此基礎上雜湊也發展出密碼加鹽 (salt) 的方式，也就是在雜湊前先加入一段秘密的數字，在進行雜湊，讓破解的難度又更加上升。


## `include`、`require`、`include_once`、`require_once` 的差別

基本上功能都是用來讀取檔案，require 適合用來引入靜態的內容（如版權宣告），而 include 適合用來引入動態的程式碼（程式內容會依其他程式碼而變動）。include 跟 require 最大且可幾乎說是唯一的差異在於警告方式不同，include 的檔案缺失只會出現警告而已，但是 require 則是會跳出錯誤並且停止運行。

而 include_once 和 inculde，以及 require 和 require_once，這兩對 couple 基本上功能完全一樣，只是加入 once 後若重複引用相同檔案就會跳錯誤訊息，因此較為推薦使用。


## 請說明 SQL Injection 的攻擊原理以及防範方法


在資訊安全中有一項針對資料庫的漏洞攻擊稱作 SQL Injection，不僅僅是網頁程式，只要是有和資料庫進行連結的任何程式都可能產生此項漏洞。此漏洞的成因很簡單，就是允許使用者輸入的字串在代入 SQL 查詢語句時，沒有過濾非法字元，導致字串成為查詢語句的一部分，達到讓攻擊者能執行任意 SQL 語句。

常見的 SQL INjection 攻擊手法有：

1. Authorization Bypass（略過權限檢查）
2. Injecting SQL Sub-Statements into SQL Queries（注入 SQL 子語法）
3. Exploiting Stored Procedures（利用預存程序）

詳細請見 [[Postx1] 攻擊行為－SQL 資料隱碼攻擊 SQL injection](https://ithelp.ithome.com.tw/articles/10189201) 一文

目前為止最推薦的防範方法是 Prepared Statement，Prepared Statement 會替 SQL 語句進行預處理，再利用它提供的 bindValue 或 bindParam 函式將欲查詢的參數的值或變數綁定上去，底層查詢時，其參數會保證作為數值傳遞，不可能成為 SQL 語句的一部分，也因此就不會產生 SQL Injection 的問題。


## 請說明 XSS 的攻擊原理以及防範方法

XSS（Cross-site scripting），也叫做 JavaScript Injection，是現代網站最頻繁出現的問題之一，指的是網站被惡意使用者植入了其他程式碼，通常發生在網站將使用者輸入的內容直接放到網站內容時。例如論壇、討論區等可輸入任意文字的網站，惡意使用者如果寫入 < script >，且前端、後端都沒有針對輸入內容做字元轉換、過濾處理，直接將使用者輸入的字串當成頁面內容的話，就有可能遭到 XSS。

常見的有分成幾個類型：
1. 儲存型 XSS：將惡意程式寫入 DB，等資料被讀取出來時就會執行。
2. 反射型 XSS：使用者輸入的內容直接帶回頁面上。
3. DOM-based 型 XSS：網頁javascript在執行過程中，沒有詳細檢查資料使 js 產生網頁內容的時候被注入惡意字串，DOM 型 XSS 攻擊中，取出和執行惡意代碼由瀏覽器端完成，屬於前端JavaScript 自身的安全漏洞，而其他兩種XSS 都屬於服務端的安全漏洞。


1 和 2 兩種類型必須由後端來防範，而 DOM-Based 則必須由前端來防範，但基本上還是跟前面的原則相同。防範方法簡單來說，就是對於所有不信任來源的 input 都要以 encode 後的方式呈現在瀏覽器上，而不是直接讓他執行，分為兩種方式：

1. 驗證：使用者輸入的內容後，才把資料存入資料庫，例如，過濾掉 < script > 這類到標籤。
2. 消毒：在將資料庫的內容呈現給使用者前，先對這些內容進行消毒（sanitize），例如將內容中的 HTML Body 和 attribute 內的 HTML Entities 都進行編碼。

其中一種好用的防範方式為使用 htmlspecialchars 函數，htmlspecialchars() 函數把特殊字符轉換為 HTML 實體。這意味著 < 和 > 之類的 HTML 字符會被替換為 &lt; 和 &gt; 。這樣可防止攻擊者通過在表單中注入 HTML 或 JavaScript 程式碼（跨站點 scripts 攻擊）對程式碼進行利用，通常會在網頁渲染輸出時才轉換。

htmlspecialchars 函數更多的時候要加上第二個參數：htmlspecialchars（$ string，ENT_QUOTES），否則預設是只轉化雙引號的。當然，如果需要不轉化任何引號，用htmlspecialchars（$ string，ENT_NOQUOTES），而第三個參數則可以設定是針對英文或者中文等語言。

更詳細請參考 [PHP htmlspecialchars() 函数](https://www.w3school.com.cn/php/func_string_htmlspecialchars.asp)


## 請說明 CSRF 的攻擊原理以及防範方法

CSRF 是一種 Web 上的攻擊手法，全稱是 Cross Site Request Forgery（跨站請求偽造）。簡單來說當用户登錄原網站，瀏覽器會記錄Cookies ，如果用户未登出或Cookies並未過期(用户關閉瀏覽器不代表網站已登出或Cookies會立即過期)。在這期間，如果用户造訪其他危險網站，點擊了攻擊者的連結，便會向原網站發出某個功能請求 (request)，原網站的伺服器接收後會被誤會以為是用户合法操作。

防範方式從兩個面向，使用者端 （Clients）和伺服器端 (Server) 來說：

- 使用者端 （Clients）
1. 登錄網站後，使用期間不要去瀏覽不明的網站，使用完畢後記得馬上登出。
2. 避免在瀏覽器自動儲存帳户名稱或密碼。

- 伺服器端（Server）
1. 檢查 Referer：

request 的 header 裡面會帶一個欄位叫做 referer，代表這個 request 是從哪個地方過來的，可以檢查這個欄位看是不是合法的 domain。

2. 加上圖形驗證碼、簡訊驗證碼：

基本上萬無一失的方法，常見於銀行帳戶等需要高度安全的領域，但若是每個網頁都要這樣，對於使用者很不方便。

3. 加上 CSRF token

我們在 form 裡面加上一個 hidden 的欄位，叫做csrftoken，這裡面填的值由 server 隨機產生，並且存在 server 的 session 中，
按下 submit 之後，server 比對表單中的csrftoken與自己 session 裡面存的是不是一樣的，是的話就代表這的確是由使用者本人發出的 request。這個 csrftoken 由 server 產生，並且每一段不同的 session 就應該要更換一次。

4. Double Submit Cookie

這個解法的前半段與 CSRF token 的相似，由 server 產生一組隨機的 token 並且加在 form 上面。但不同的點在於，除了不用把這個值寫在 session 保存在 server 當中以外，同時也讓 client side 設定一個名叫 csrftoken 的 cookie，值也是同一組 token。

最後補充下從 browser 端本身也能進行防禦，而且在適當的條件下意外的簡單方便，Google 在 Chrome 51 版時加入此功能「SameSite cookie」。只要將妳原本設置的 Cookie 的 header 改幾行代碼即完成。原理簡單來說你的 cookie 只要不是從原本網頁來的就會被消除掉，由於目前只有 Chrome 支援這個新的特性，就不多贅述。

原先：Set-Cookie: session_id=ewfewjf23o1;
修正：Set-Cookie: session_id=ewfewjf23o1; SameSite

註：
參考資料：[讓我們來談談 CSRF](https://blog.techbridge.cc/2017/02/25/csrf-introduction/)

