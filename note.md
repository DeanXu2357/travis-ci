# 單元測試驗證方式

1. 驗證回傳值
2 . 驗證狀態
3. 驗證互動


# Code Coverage
要導入用數字評估，但是不要針對錯誤的數字目標

1. > 0%
2. No Cover
    1. 已知產品代碼無測試，但不補
    2. 發現涵蓋度不夠，漏了測試
    3. 需求不存在
3. 要寫測試
    1. 有風險的(跟錢有關的，跟人命有關的))
    2. 曾經出錯過得（保證不會重複出錯，有回歸的好處）
    3. 主要流程
    4. 最常被改到的（可以用版本控管看熱點）
4. 相對的趨勢 > 絕對數字
    1. why? 證明當下那次 commit 是對的
    2. 鼓勵頻繁的 commit 
    3. 要每次都有進步


洋蔥式/六角架構
外部依賴要被 Adapter 隔開
所以外部依賴的 Api 要寫監控，不是單元測試

外部 api 要冊的是整合測試，而非單元，因為只要冊雙方電文格式是否轉換正確

debug  先從 service -> data access -> view

談需求時，定義驗收情境，可以加，但是要先定義

Impact Map (影響地圖) -> User Story Mapping -> Product Back Log
-> Refinement Metting 需求梳理 -> Specification by Example 實例化需求
-> ATDD -> TDD -> test -> red -> green -> refactor -> back to TDD

核心觀念，再做之前，團隊的每個人都要知道要怎樣驗收，決定要怎樣驗收之後，剩下的就是誰做的問題

用情境收斂需求問題