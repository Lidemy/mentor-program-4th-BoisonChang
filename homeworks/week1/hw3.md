## 教你朋友 CLI

#什麼是CLI(COMMAND-LINE INTERFACE)？

現在很多人可能不知道 CLI 是什麼，因為我們現在的電腦像是桌面之類，都是後來發展出來比較好操作的圖像化介面 GUI（Graphical User Interface），比如你現在的桌面、資料管理員，或者垃圾桶都是 GUI 一環，但是有些在軟體開發上的指令你還是要用 CLI 才有辦法執行，滿推薦大家都能了解一下的。

總之我理解 CLI 是用來命令你的電腦執行動作的介面，本質上背後也是由程式碼撰寫而成，又叫做文字使用者介面（character user interface, CUI）。

#什麼是CLI(COMMAND-LINE INTERFACE)怎麼用？

Mac 上叫做終端機 (Terminal)，Windows 系統上叫做命令提示字元（command），就是打開後一個小小的黑盒子黑壓壓一片的東西就是了。


#CLI的常用基本指令
pwd 	印出目前路徑位置	
ls      列出檔案清單	
cd      切換資料夾	
man     指令使用說明書	
clear	清空畫面	

#CLI的常用檔案相關指令
touch	建立檔案 / 更改時間
rm    	刪除檔案
mkdir   建立資料夾
mv      移動檔案或改名
cp      複製檔案
vim     文字編輯器
open    打開

#CLI的常用檔案相關指令
cat     列印出檔案內容
less    分頁印出檔案
echo    列出出打的東西
grep    抓取關鍵字 (ex: A)
wget    下載檔案（有可能需安裝
curl    送出 repuest
redirection	 重新導向 input output
append  可以新增內容進檔案
pipe    左邊指令的輸出變成右邊指令的輸入
date    輸出日期
top     查詢系統目前的工作狀態

#問題

> 假設你想要完全不透過圖形介面，建立一個叫做 wifi 的資料夾，並且在裡面建立一個叫 afu.js 的檔案，該怎麼做？


step1 – 跳到桌面：cd Desktop
step2 – 建立資料夾 wifi： mkdir wifi
step3 – 跳到資料夾 wifi：cd wifi
step4 – 建立檔案 afu.js：touch afu.ja
step5 – 查看所有位置所有檔案：ls

好讀版：https://tripxbook.com/100days-learn-to-do/frontend-developer-day5/


