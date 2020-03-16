<?php
@session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
} else {
    $userid = "";
}
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "";
}
if (isset($_SESSION["userlevel"])) {
    $userlevel = $_SESSION["userlevel"];
} else {
    $userlevel = "";
}
if (isset($_SESSION["userpoint"])) {
    $userpoint = $_SESSION["userpoint"];
} else {
    $userpoint="";
}
?>
<div id="top">
  <h2>
  <a href="index.php"><img src="./img/dog15.gif" style="width:200px; height : 150px;"></a><span>Step With Buddy</span>
</h2>
  <ul id=top_menu>
    <?php
if (!$userid) {
  ?>
  <li><a href="member_form.php">JOIN</a> </li>
  <li> | </li>
    <li><a href="login_form.php">LOGIN</a></li>
    <?php
}else{
  $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]"; ?>
          <li><?=$logged?> </li>
            <li> | </li>
            <li><a href="logout.php">LOG OUT</a></li>
            <li> | </li>
            <li><a href="#">MYPAGE</a></li>
          <?php
        }
?>
<?php
    if ($userlevel==1) {
        ?>
                <li> | </li>
                <li><a href="admin.php">ADMIN</a></li>
                <?php
                    }
                ?>
</ul>




</div>
<div id="menu_bar">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="message_form.php">MESSAGE</a></li>
        <li><a href="board_form.php">BOARDER</a></li>
        <li><a href="qna_list.php">COMMENT</a></li>
    </ul>
</div>
