## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？

DNS 全名叫 Domain Name Server，當使用者輸入網址（Domain Name），DNS 會負責查到 Server 對應的 IP 位置，讓 Clients 能夠發送 Request 到 Server 去。

Google 推出 8.8.8.8 和 8.8.4.4 這兩組 Public DNS 伺服器，對 Google 的好處是能夠獲取更多資料，讓他們的搜尋結果能夠更精準；而對用戶端的好處可能是選擇變多，但對於使用 Google DNS 速度是否較快，好像就不一定。


## 什麼是資料庫的 lock？為什麼我們需要 lock？

而鎖定機制（lock）便是為了實現交易的隔離性，好像此時資料庫系統是專屬你一個人的。


使用情境上可以舉個例子，當今天如果有很多人一起去搶購，同時執行怎麼辦？

這種情況就叫做 race condition，這是電腦術語，意思就是有兩個或以上同時在存取資個資料的時候會發生的問題。假設今天有兩個 request 同時抵達這個 server，那就會一起處理，不會去分先後順序，如果只是讀取的話，沒什麼差異。但像這種情況，同時處理交易(Transaction)，就變成東西超賣。


在指令後面加上 for update 。就可以鎖定資料，讓資料後續接收資料之後，才可以繼續接收其他資料。這時候只能接收一筆資料。所以如果 for update 之後，並沒有後續的動作，整個程式就會當掉。因為沒辦法處理其他的指令，因為被鎖起來了。只要 $conn->commit(); 之後，就會把資料解鎖。有指定 where id = 1 就會只把那個 row 給鎖定起來。但如果沒有的話，就會把整個 table 被鎖定。

## NoSQL 跟 SQL 的差別在哪裡？

最大的區別就是 NoSQL 可以使用非關連式資料庫，不需要固定的結構，你不必事先知道你要存哪些資料，主要使用 key 值來儲存資料，NoSQL 意思是 no only SQL，NoSQL資料庫包括十幾種資料庫系統，也很不像關聯式資料庫那樣有一套通用的基礎資料庫理論，常用的有 MongoSQL，在處理大量資料情況下常適合適用「非關聯式資料庫」。


## 資料庫的 ACID 是什麼？

在資料庫的交易(Transaction)中，為確保交易(Transaction)是正確可靠的，所以必須具備四個特性，Atomicity (原子性）、Consistency (一致性）、Isolation (隔離性）、Durability (持續性）。

- Atomicity (原子性）
在資料庫的每一筆交易中只有兩種可能發生，第一種是全部完全(commit)，第二種是全部不完成(rollback)，不會因為某個環節出錯，而終止在那個環節，在出錯之後會恢復至交易之前的狀態，如同還沒執行此筆交易。資料操作不能只有部分完成。一次的 transaction 只能有兩種結果：成功或失敗。

- Consistency (一致性）
在交易中會產生資料或者驗證狀態，然而當錯誤發生，所有已更改的資料或狀態將會恢復至交易之前。transaction 完成前後，資料都必須永遠符合 schema 的規範，保持資料與資料庫的一致性。

- Isolation (隔離性）
資料庫允許多筆交易同時進行，交易進行時未完成的交易資料並不會被其他交易使用，直到此筆交易完成。資料庫允許多個 transactions 同時對其資料進行操作，但也同時確保這些 transaction 的交叉執行，不會導致數據的不一致。

- Durability (持續性）
交易完成後對資料的修改是永久性的，資料不會因為系統重啟或錯誤而改變。

註：參考資料1 [SQL 大小事](https://medium.com/@totoroLiu/資料庫-acid-bb87324035a8)
註：參考資料2 [後端基礎：資料庫 NoSQL、transaction、ACID 與 Lock](https://hugh-program-learning-diary-js.medium.com/後端基礎-資料庫-nosql-transaction-acid-與-lock-882f3079fd3d)