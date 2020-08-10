## 什麼是 DOM？

DOM 全名為 Document Object Model，簡單來說就是把一份 HTML 文件內的各個標籤，包括文字、圖片等等都定義成「物件」，而這些物件最終會形成一個樹狀結構，提供瀏覽器跟 JS 溝通的橋樑，在 JS 上可以運用各種 DOM API 去操作 DOM 實現網頁功能。

在 DOM 中，每個 element 、 文字(text) 等等都是一個節點，而節點通常分成以下四種：

1. Document: Document 就是指這份文件，也就是這份 HTML 檔的開端，所有的一切都會從 Document 開始往下進行。
2. Element: Element 就是指文件內的各個標籤，如 <div>、<p>、...等。
3. Text: Text 就是指被各個標籤包起來的文字。
4. Attribute: Attribute 就是指各個標籤內的相關屬性。


## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

當你對網頁做了一些動作 (ex: 點擊，可理解為一事件），才會觸發執行的動作。然而假使當你「點擊」 DOM 的內層時，實際上你連包覆內層的外層也點到了，你的動作實際上可以視為也是點擊外層的一事件，而這個事件為根據「事件傳遞機制」的概念一層一層往內傳到你實際上點擊的內層，在說明這個過程中的概念有 DOM 事件傳遞機制中的「捕獲」與「冒泡」。

事件傳遞機制總共分為三大階段：


1. 捕獲階段 (Capture Phase)：在捕獲階段，DOM 的事件會從祖先層 (window) 開始往下尋找目標 (target)，這個過稱稱為捕獲階段 (CAPTURING_PHASE)。
2. 目標階段 (Target Phase)：這時候在目標 (target) 身上所加的事件監聽器 (eventListenr) 會是 AT_TARGET 這一個階段 (Phase)。
3. 冒泡階段 (Bubbling Phase)：循著原路回去的過程，就是冒泡階段 (BUBBLING_PHASE)。


同樣一個 eventListenr 的三個參數(Parameter) 設 true 則將 eventListenr 設置在捕獲階段 (Capture Phase)，若是設置 false 則設置在冒泡階段 (Bubbling Phase)，預設為 false。

## 什麼是 event delegation，為什麼我們需要它？

事件代理 (event delagation) 是運用事件傳遞機制的特性，將事件監聽器 (eventListenr) 加在目標元件的上層元素，若是你同時有多個元件都希望裝上同樣的事件監聽器 (eventListenr) ，也就是功能類似的話，透過事件代理可以大幅將程式碼簡化，有點像是統一把一樣的任務委託給上層的一個元素執行的概念。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

1. event.preventDefault: 有些元素會有屬於他的預設行為，透過 event.preventDefault 可以取消元素的預設行為，比如說點擊超連結會自動帶你到另一個網頁，若加上 event.preventDefault 可以取消此預設行為。

2. event.stopPropagation: DOM 在進行捕獲及冒泡行為時，若在某個元素監聽事件加上 event.stopPropagation 後，會停止捕獲 /冒泡行為，若你希望不要觸發點擊內層之外的外層 eventListenr，可用此處理。