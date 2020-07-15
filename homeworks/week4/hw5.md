## 請以自己的話解釋 API 是什麼

取用資料庫資料的一套「溝通介面」，API 需要有 API 網址和 API 規範。通常前端工程師通過 API 去取用資料庫中的資料，同時也必須遵守 API 自有的一套規範，這套規範通常是由撰寫 API 的後端工程師所規範，之所以要有 API 是為了讓取用資料庫資料的流程可以透過標準化所簡化，也是為了讓外部人士要取用資料庫資料的時候，能夠保障資料庫中原始資料的資訊安全。



## 請找出三個課程沒教的 HTTP status code 並簡單介紹


### 504 Gateway Timeout

就是不知為何伺服器上沒有回應，超過正常的時間。

### 401 Unauthorized

未認證，可能需要先登入或者傳送 token。

### 303 See Other

通知 Clients 去另一個網址查看上傳表單後的結果。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。


先設定 Base URL (網址純粹舉例，無法實際連上)

Base URL: https://platform-restaurant.herokuapp.com


1.說明           2.Method  3. path             4.參數                     5.範例
回傳所有餐廳資料 ； GET      ； /restaurants     ； ?_limit=N 限制回傳資料數量 ；https://platform-restaurant.herokuapp.com/restaurants?_limit=5
回傳單一餐廳資料 ； GET      ； /restaurants/:id ； 無                       ； https://platform-restaurant.herokuapp.com/restaurants/1
刪除餐廳        ； DELETE   ； /restaurants/:id ； 無                      ； https://platform-restaurant.herokuapp.com/restaurants/1
新增餐廳        ； POST     ； /restaurants     ； name: 餐廳名稱           ； https://platform-restaurant.herokuapp.com/restaurants
更改餐廳        ； PATCH    ； /restaurants/:id ； name: 餐廳名稱           ； https://platform-restaurant.herokuapp.com/restaurants/1D