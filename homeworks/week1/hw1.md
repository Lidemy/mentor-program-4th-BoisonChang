## 交作業流程


# 第一步

打開 Terminal

# 第二步

cd /Users/zhangbaisong/Desktop/lidemy/test/mentor-program-4th-BoisonChang

# 第三步：創建一個 Branch

git branch week1

# 第四步：切換到這個 Branch

git checkout week1

# 第五步：打開 Hw 編輯文字檔寫作業

git open .

# 第六步：加入暫存工作區

git add .

# 第七步：真正存取 commit 新的 branch 版本 week1

git commit -m "week1 完成囉"

# 第八步：PUCH 第一週作業 week1 上 Github

git push origin week1

# 第九步：上 Github 上面 merge week1 到 master 的 branch

找到 compare & pull rewuest / 或者自己案 new pull request 然後按 create pull request，標題可以寫第一週作業完成，內容寫想要問的問題，然後按 create pull request 送出

# 第十步：到 Github 複製 PR 連結 貼到 Learning 區

點 Github 的 Pull request 複製網址到 Learning 區的作業列表按新增作業選 week1 並貼上 url


# 第十步：回到主機端切回 master

git checkout master

# 第十一步：等助教批准刪除以後，同步遠端 master 到本機的 master

git pull origin master

# 第十二步：刪除本機的 branch week1

git branch -d week1


