請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}



1. main() 被放進去 call stack
2. 執行 for 迴圈
3. 宣告 i 為全域變數
4. 把 i 賦值為 0
5. 由於 i < 5 () 為 true 進入 for 迴圈
6. console.log('i: ' + i) 被放進去 call stack
7. 執行 console.log('i: ' + i) 
8. 印出 i: 0
9. 把 console.log('i: ' + i) 移出 call stack 
10. 把 setTimeout(() => {console.log(i)}, i * 1000) 放進去 call stack 
11. 把 setTimeout(() => {console.log(i)}, i * 1000) 設定定時器，會在 0 秒過後把這個函式 () => console.log(i) 放入 callback queue
12. 再執行一次 for 迴圈
13. 此時 i = 0, i + 1 = 1，由於 i < 5 () 為 true 進入 for 迴圈
14. console.log('i: ' + i) 被放進去 call stack
15. 執行 console.log('i: ' + i) 
16. 印出 i: 1
17. 把 console.log('i: ' + i) 移出 call stack 
18. 把 setTimeout(() => {console.log(i)}, i * 1000) 放進去 call stack 
19. 把 setTimeout(() => {console.log(i)}, i * 1000) 設定定時器，會在 1000 秒過後把這個函式 () => console.log(i) 放入 callback queue
20. 再執行一次 for 迴圈
21. 此時 i = 1, i + 1 = 2，由於 i < 5 () 為 true 進入 for 迴圈
22. console.log('i: ' + i) 被放進去 call stack
23. 執行 console.log('i: ' + i) 
24. 印出 i: 2
25. 把 console.log('i: ' + i) 移出 call stack 
26. 把 setTimeout(() => {console.log(i)}, i * 1000) 放進去 call stack 
27. 把 setTimeout(() => {console.log(i)}, i * 1000) 設定定時器，會在 2000 秒過後把這個函式 () => console.log(i) 放入 callback queue
28. 再執行一次 for 迴圈
29. 此時 i = 2, i + 1 = 3，由於 i < 5 () 為 true 進入 for 迴圈
30. console.log('i: ' + i) 被放進去 call stack
31. 執行 console.log('i: ' + i) 
32. 印出 i: 3
33. 把 console.log('i: ' + i) 移出 call stack 
34. 把 setTimeout(() => {console.log(i)}, i * 1000) 放進去 call stack 
35. 把 setTimeout(() => {console.log(i)}, i * 1000) 設定定時器，會在 3000 秒過後把這個函式 () => console.log(i) 放入 callback queue
36. 再執行一次 for 迴圈
37. 此時 i = 3, i + 1 = 3，由於 i < 5 () 為 true 進入 for 迴圈
38. console.log('i: ' + i) 被放進去 call stack
39. 執行 console.log('i: ' + i) 
40. 印出 i: 4
41. 把 console.log('i: ' + i) 移出 call stack 
42. 把 setTimeout(() => {console.log(i)}, i * 1000) 放進去 call stack 
43. 把 setTimeout(() => {console.log(i)}, i * 1000) 設定定時器，會在 4000 秒過後把這個函式 () => console.log(i) 入 callback queue
44. 再執行一次 for 迴圈
46. 此時 i = 4, i + 1 = 5，由於 i < 5 () 為 false 離開 for 迴圈
46. 把 main() 移出 call stack 
47. 目前 callback queue 有五個東西，依序是 () => console.log(i)  跟 () => console.log(i)  跟 () => console.log(i)   跟 () => console.log(i)   跟 () => console.log(i) 
48. call stack 是空的，把 callback queue 裡的 () => console.log(i) 放進去 call stack 
49. 執行 () => console.log('i')
50. 執行 console.log('i')
51. 印出 i: 5
52. 把 console.log('i') 移出 call stack
53. 目前 callback queue 有四個東西，依序是 () => console.log(i)  跟 () => console.log(i)  跟 () => console.log(i)   跟 () => console.log(i)
54. call stack 是空的，把 callback queue 裡的 () => console.log(i) 放進去 call stack 
55. 執行 () => console.log('i')
56. 執行 console.log('i')
57. 印出 i: 5
58. 把 console.log('i') 移出 call stack
59. 目前 callback queue 有三個東西，依序是 () => console.log(i)  跟 () => console.log(i)  跟 () => console.log(i) 
60. call stack 是空的，把 callback queue 裡的 () => console.log(i) 放進去 call stack 
61. 執行 () => console.log('i')
62. 執行 console.log('i')
63. 印出 i: 5
64. 把 console.log('i') 移出 call stack
65. 目前 callback queue 有兩個東西，依序是 () => console.log(i)  跟 () => console.log(i)  
66. call stack 是空的，把 callback queue 裡的 () => console.log(i) 放進去 call stack 
67. 執行 () => console.log('i')
68. 執行 console.log('i')
69. 印出 i: 5
70. 把 console.log('4') 移出 call stack
71. 目前 callback queue 有一個東西，依序是 () => console.log(i)  
72. call stack 是空的，把 callback queue 裡的 () => console.log(i) 放進去 call stack 
73. 執行 () => console.log('i')
74. 執行 console.log('i')
75. 印出 i: 5
76. 把 console.log('i') 移出 call stack
