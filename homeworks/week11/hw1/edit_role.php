<?php


  require_once('conn.php');
  require_once('utils.php');

  $username = NULL;
  $users = NULL;
  $roleid = NULL;

  if(!empty($_SESSION['username']) ) {
    $username = $_SESSION['username'];
    $users = getUserFromUsername($_SESSION['username']);
    $roleid = $users['roleid'];
  }


  if ($roleid != 1) {
    header("location: index.php");
  }


  $page = 1;
  if(!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  } 
  $item_per_page = 5;
  $offset = ($page - 1) * $item_per_page;


  $stmt = $conn->prepare(
     "SELECT U.id AS id, U.username AS username, U.nickname AS nickname, U.password AS password, U.created_at AS created_at, R.roleid AS roleid FROM Boison_board_roles as R Left JOIN Boison_board_users AS U ON R.username = U.username order by U.id DESC LIMIT ? OFFSET ?" 
    );

  $stmt->bind_param('ii', $item_per_page, $offset);
  $result = $stmt->execute();



  if(!$result) {
    die("ERROR:" . $conn->error);
  }

  $result = $stmt->get_result();
  $page = 1;
  if(!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  } 
  $item_per_page = 5;
  $offset = ($page - 1) * $item_per_page;



?>

<!DOCOTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>留言板後台</title>
  <meta name ="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="wrapper">
    <a class="board__btn board__admin-btn" href="index.php">回到留言板</a>

    <h1>留言板管理員介面</h1>


  <form method="POST" action="handle_edit_role.php">
    <table>
      <tr>
        <th>#</th>
        <th>帳號</th>
        <th>暱稱</th>
        <th>現在帳號權限</th>
        <th>編輯帳號權限</th>
      </tr>
      <?php

        $status = array();
        $num = 0;
        while($row = $result->fetch_assoc()){
          $id = $row['id'];
          $username = $row['username'];
          $nickname = $row['nickname'];
          $roleid = $row['roleid'];

      ?>

      <tr>
        <td><?php echo escape($id) ?></td>
        <td><?php echo escape($username) ?></td>
        <td><?php echo escape($nickname) ?></td>
        <td><?php echo escape(displayrolestatus($roleid)) ?></td>
        <td>
            <?php 
              if ($_SESSION['username'] == $username) {
            ?>
              管理員
            <?php } else { ?>
              <select name="status<?php echo intval($num);?>">
                <option value="0_<?php echo $username;?>" <?php if($roleid == 0){echo "selected";}?>>
                  一般使用者
                </option>
                <option value="1_<?php echo $username;?>"<?php if($roleid == 1){echo "selected";}?>>
                  管理員
                </option>
                <option value="2_<?php echo $username;?>"<?php if($roleid == 2){echo "selected";}?>>
                  遭停權使用者
                </option>
              </select>
            <?php $num+=1; }?>
          </td>
        </tr>
      <?php } ?>
    </table>

    <input class="board__btn board__admin-btn board__admin-btn2" type="submit" value="更新帳號權限">
  </form>

    <?php
       $stmt = $conn->prepare(
         'SELECT count(username) AS count FROM Boison_board_users'
        );
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $item_per_page);
    ?>


    <div class="page__info page__info-admin">
      <span>總共有 <?php echo $count ?> 個註冊用戶 ｜ </span>
      <span>頁數 <?php echo $page ?> / <?php echo $total_page ?> </span>
    </div>

    <?php if($count != 0) { ?>
      <div class="paginator">
        <?php if($page != 1) {?>
          <a href="edit_role.php?page=1">首頁</a>
          <a href="edit_role.php?page=<?php echo $page-1 ?>">上一頁</a>
        <?php }?>
        <?php if($page != $total_page) {?>
          <a href="edit_role.php?page=<?php echo $page+1 ?>">下一頁</a>
          <a href="edit_role.php?page=<?php echo $total_page ?>">最後一頁</a>
        <?php }?>
      </div>
    <?php }?>

  </div>
  <footer>
    <div class="footer__bottom">
      Copyright © 2020 Just A Bite All Rights Reserved. 咬一口股份有限公司版權所有
    </div>
  </footer>
	<script src="./index.js"></script>
</body>
</html>