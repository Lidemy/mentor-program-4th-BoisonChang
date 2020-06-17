## 跟你朋友介紹 Git


#GIT是什麼

簡單來說我的理解， Git 就是可以控制專案的版本的存檔工具，而且可以在多人協作下控制專案的版本，有點像是多人一起破一個開放世界的 rpg 遊戲，大家分工合作去解不同的支線，過程中可以各自存檔互不干擾 / 或者接力破關，等到確定解完支線再開啟合併（merge）功能，合併破的支線任務和拿到的道具到主線劇情中。

>Git 是一種「分散式版本控制系統」，可記錄每一個版本的所有變化。

#GIT的架構

Git 有三個區域如下。採兩段式更新，使用 git add 陸續將檔案更新狀態由「工作區」移入「暫存區」，檔案由 untracked 加入版本控制 staged ，告一段落後再 git commit 將其由「暫存區」提交到「儲存庫」。

1.工作區 (Working Directory)：就是你在本端程式儲存的資料夾。
2.暫存區 (Staging Area)：儲存庫就是每次提交 commit 版本前放置的區域。檔案都要透過 git add 的方式新增到索引區，Git 才能追蹤這個檔案。
3.儲存庫 (Repository)：工作區有一個隱藏目錄 .git，這個不算工作區，而是Git 的版本庫。也就是每次 commit 版本放置的區域。當程式在工作目錄(Working Directory) 修改到一個階段，也把更改的檔案放到暫存區(Stage)，此時便可以將資料提交 commit 到儲存庫建立新的版本。

#GIT基本指令

git init          git 專案初始化（生成隱藏檔案 .git）
git status        檢視目前狀態
git add           決定檔案是否加入「版本控制 staged」
git -rm cached    將加入版本控制的檔案移除
git commit        新建一個版本
git commit -am    合併 add 跟 commit 兩個指令
git log           歷史紀錄
git mv            請 git 幫你變更檔名
git diff          比對工作區與暫存區全部檔案的差異
git reset         將暫存區恢復到工作區
git commit –amend 改寫最後一次 commit 的 訊息
.gitignore        不想被控制的檔案課就寫進去

#Git之Branch相關指令

git branch        開新分支
git branch -v     檢視現有分支
git branch -d     刪除分支
git checkout      回到某個指定版本
git merge         將分支合併回 master

#Git從本地連上遠端

Github 則是一個支援 Git 程式碼存取和遠端管理的平台服務，有許多的開放原始碼的專案都是使用 Github 進行程式碼的管理。

Git 可以分為 Local (本地)和 Remote (遠端)兩個環境，由於 Git 屬於分散式的版本控制系統，所以開發者可以在離線 local 環境下開發，等到有網路時再將自己的程式推到 Remote 環境或 pull 下其他開發者程式碼進行整合。

#Git從本地連上遠端常用指令

git remote        與遠端檔案庫操作有關的指令
git push          把本地端檔案庫推上遠端檔案庫
git pull          將遠端分支資料拉回並合併本地分支
git clone         複製其他人 GitHub 上的專案


#Git操作實例

教蔡哥 Git 的基本概念以及基礎的使用，例如說 add 跟 commit，若是還有時間的話可以連 push 或是 pull 都講，菜哥能不能順利成為電視笑話冠軍，就靠你了！

step1 – 創建資料夾 HW4joke：mkdir HW4joke
step2 – 跳到資料夾 HW4joke： cd HW4jokei
step3 – 版本化控制資料夾 HW4joke：git init
step4 – 創建初始文件 joke：touch joke
step5 – 編輯 joke：vim joke
step6 – 將 joke 加入暫存區：git add joke
step7 – 將 joke commit，建立 master 分支：git commit -m “firstversion”
step8 – 創建第一個分支：git branch week1hw4
step9 – 創建文件 joke2：touch joke2
step10 – 編輯 joke2：vim joke2
step11 – 將 joke2 加入暫存區：git add joke2
step12 – 將 joke2 commit：git commit -m “兩個笑話笑呵呵”
step13 – 切換回 master：git branch master
step14 – 將 branch week1hw4 合併到 master：git merge week1hw4
step15 – 在 GitHub 上按右上角 + 新增 Repositories （記得不要勾 read.me
step16 – 在 GitHub Clone with HTTPS 複製網址
step17 – 本地加入一個遠端 Repositories：git remote add origin https://github.com/BoisonChang/WEEK1HW4.git
step18 – 把本地版本推上遠端 Repositories：git push -u origin master
step19 – 遠端做些小更動： create new file “attention”
step20 – 遠端同步回本地端：git pull origin master



好讀版：https://tripxbook.com/100days-learn-to-do/frontend-developer-day6/