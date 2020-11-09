大部分都是參考同學的這篇 [紀錄部屬 AWS EC2 雲端主機](https://mtr04-note.coderbridge.io/2020/09/15/-紀錄-%08-部屬-aws-ec2-雲端主機-/)

不過裝完後打不開 phpmyadmin，卡了滿久
上網查了一下輸入這幾行
重新開啟 apache 後好像就解決了（？

   15  sudo ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-available/phpmyadmin.conf
   16  sudo a2enconf phpmyadmin
   17  sudo service apache2 reload

老實說我也不知道為何...?

後面基本上都沒什麼大問題
嘗試用 GitHub 和 FileZilla 去上傳部署檔案。
唯一有問題的地方是 FileZilla 無法更改 root 檔案，

   39  sudo chown -R ubuntu:ubuntu /var/www/html
   40  sudo chmod -R 755 /var/www/html
   41  chmod -R 755 /var/www/html

上網查一下輸入這幾行程式碼，就可以更改了。
大致上就是這兩個問題，事後來看好像沒有很難，
但是一開始安裝 VPS 進不了 phpmyadmin
試過用這篇[一小時完成 VPS (Virtual Private Server) 部署](https://github.com/Lidemy/mentor-program-2nd-futianshen/issues/21)的方法輸入程式碼去更動環境，造成防火牆的問題連不上虛擬主機，這個問題卡了兩天無法解決，後來只好重新終止 VPS，然後創建新的才能開啟，然後按造上面的去查到了去重啟 apacheh 才解決，說起來容易但是過程中很多步驟都一知半解的所以只要出現一個環境問題就會卡很久試各種方式土法煉鋼，還需要增進對每個步驟的了解程度才行。 
