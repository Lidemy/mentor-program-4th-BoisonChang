請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)

---
- 先講結論，輸出結果為：
  - undefined
  - 7
  - 8
  - 20
  - 1
  - 70
  - 100


---
1. 進去這個檔案，會先進去 Global Execution Context，再展開 Global Execution Context 的 Global Variable Object
GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: undefined
    }
  }
}

---
2. function fn(){} 在進去時就會被初始化成為一個 function，找到第一行的變數宣告 var a = 1; 所以 a 被初始化為 undefined


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: undefined
    }
  }
}

---
3. 開始執行程式碼，找到第一行的變數宣告 var a = 1，然後 function fn(){} 宣告先跳過


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
4. 開始執行程式碼，進去 fn() 這個 function，然後呼叫這個 function，開始初始化，先找參數沒找到，第二件事情找 function 找到 fn2()，把其初始化為一個 function，再來找變數宣告 var a = 5，然後初始化為 undefined

fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: undefined
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
5. 開始執行程式碼，找到 console.log(a)，此時 a 為 undefined，輸出 undefined

fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: undefined
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
6. 執行程式碼，找到 var a = 5，但因為初始化時變數 a 宣告已經決定好了，可以視為 a = 5，把 a 賦值 7

fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 7
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
7. 執行程式碼，找到 console.log(a)，此時 a 為 7，輸出 7


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 7
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
8. 執行程式碼，找到 a++ ，所以 a 的值從 7 變成 8 


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 8
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---
9. 執行程式碼，找到 var a ，但已經有宣告 a 了，所以 a 的值不變還是 8 


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 8
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}


---
10. 執行程式碼，進去 fn2() 這個 function，然後呼叫這個 function，開始初始化，先找參數沒找到，第二件事情找 function 沒找到，再來找變數宣告沒找到。


fn2ExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 }
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {

    }
  }
}


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 8
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~undefined~~ 1
    }
  }
}

---

11. 執行程式碼，找到 console.log(a)，但 VO 是空的，所以往上找會找到 fn() 中 VO 的 a，值為 8，所以輸出 8

fn2ExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 }
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {

    }
  }
}


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 8
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
    }
  }
}

---
12. 執行程式碼，找到 a = 30，因為此處 EC 中 VO 中沒有 a，往上找 fn() 中 VO 的 a，將值從 8 改為 20

fn2ExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 }
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {

    }
  }
}


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~8~~ 20
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
    }
  }
}

---
13. 執行程式碼，找到 b = 100，因為此處 EC 中 VO 中沒有 a，往上找 fn() 中 VO 的也發現沒有 b，在往上找到 Global VO 也沒有 b，所以就把 b 放到 Global VO 中， b = 100。（如果都找不到就會在 Global VO 新增一個值，變成全域變數。）

fn2ExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 }
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {

    }
  }
}


fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 20
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
      b: 100
    }
  }
}

---
14. fn2 都執行完了，所以就清空，不見了。

fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 20
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
      b: 100
    }
  }
}

---
15. 執行程式碼，回到 fn，找到 console.log(a)，此處 a 的值為 20 ，所以輸出 20

fnExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      Arguments: { length: 0 },
      fn2: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 20
    }
  }
}


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
      b: 100
    }
  }
}

---
16. fn 都執行完了，所以就清空，不見了。


GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
      b: 100
    }
  }
}

---
17. 執行程式碼，回到 Global，找到 console.log(a)，此時 a 為 1，輸出 1

GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 1
      b: 100
    }
  }
}

---
18. 執行程式碼，找到 a = 70 ，所以 a 從 1 變成 70

GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: ~~1~~ 70
      b: 100
    }
  }
}

---
19. 執行程式碼，找到 console.log(a)，此處 a 的值為 70 ，所以輸出 70

GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 70
      b: 100
    }
  }
}

---
20. 執行程式碼，找到 console.log(b)，此處 b 的值為 100 ，所以輸出 100

GlobalExectionContext = {
  LexicalEnvironment: {
    EnvironmentRecord: {
      fn: function
    }
  },
  VariableEnvironment: {
    EnvironmentRecord: {
      a: 70
      b: 100
    }
  }
}

21. Global 都執行完了，所以就清空，不見了。


---
- 輸出結果為：
  - undefined
  - 7
  - 8
  - 20
  - 1
  - 70
  - 100


