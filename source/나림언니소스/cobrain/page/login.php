<?php
  $id = $_POST["inputId"];
  $pw = $_POST["inputPw"];

  $con = mysqli_connect("localhost", "root", "123456", "cobrain");
  $sql = "select * from members where id='$id'";
  $result = mysqli_query($con, $sql);

  $num_match = mysqli_num_rows($result);

  if(!$num_match)
  {
    echo("
          <script>
            window.alert('회원정보를 찾을 수 없습니다.')
            history.go(-1)
          </script>
        ");
   } else
   {
       $row = mysqli_fetch_array($result);
       $db_pw = $row["pw"];

       mysqli_close($con);

       if($pw != $db_pw)
       {
          echo("
             <script>
               window.alert('비밀번호가 틀립니다!')
               location.href = '/cobrain/page/login_form.php';
             </script>
             ");
         exit;
       } else
       {
           session_start();
           $_SESSION["userid"] = $row["id"];
           $_SESSION["username"] = $row["name"];
           $_SESSION["userlevel"] = $row["level"];
           $_SESSION["userpoint"] = $row["point"];

           echo("
             <script>
               location.href = '/cobrain/index.php';
             </script>
           ");
       }
    }

 ?>
