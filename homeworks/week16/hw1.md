在 JavaScript 裡面，一個很重要的概念就是 Event Loop，
是 JavaScript 底層在執行程式碼時的運作方式。
請你說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。


console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)

---

ANS：基本上會輸出 13524，因為執行緒是照順序由上往下執行，但有很小的機率會輸出 13542（因為定時器差距太小）。

1. 把 console.log('1') 放進去 call stack
2. 執行 console.log('1')
3. 印出 1
4. 把 console.log('1') 移出 call stack
5. 把 console.log('1') 移出 call stack
6. 把 setTimeout(() => {console.log(2)}, 0) 放進去 call stack 
7. 把 setTimeout(() => {console.log(2)}, 0) 設定定時器，會在0秒過後把這個函式 () => console.log('2') 放入 callback queue
8. 把 setTimeout(() => {console.log(2)}, 0) 移出 call stack
9. 把 console.log('3') 放進去 call stack
10. 執行 console.log('3')
11. 印出 3
12. 把 console.log('3') 移出 call stack
13. 把 setTimeout(() => {console.log(4)}, 0) 放進去 call stack
14. 把 setTimeout(() => {console.log(4)}, 0) 設定定時器，會在0秒過後把這個函式 () => console.log('4') 放入 callback queue
15. 把 setTimeout(() => {console.log(4)}, 0) 移出 call stack
16. 把 console.log('5') 放進去 call stack
17. 執行 console.log('5')
18. 印出 5
19. 目前 callback queue 有兩個東西，依序是 () => console.log('2') 跟 () => console.log('4')
20. call stack 是空的，把 callback queue 裡的 () => console.log('2') 放進去 call stack
21. 執行 () => console.log('2')
22. 執行 console.log('2')
23. 印出 2
24. 把 console.log('2') 移出 call stack
25. call stack 是空的，把 callback queue 裡的 () => console.log('4') 放進去 call stack
26. 執行 () => console.log('4')
27. 執行 console.log('4')
28. 印出 4
29. 把 console.log('4') 移出 call stack

