<!-- <?php

    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "./data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'board_list.php?page=$page';
	     </script>
	   ";
?> -->
<?php

    $num   = $_GET["num"];
    $page   = $_GET["page"];
    $mode = "delete";

    $con = mysqli_connect("localhost", "root", "123456", "sample");
    //전역변수

    function board_delete($con,$num, $page)
    {
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $copied_name = $row["file_copied"];

        if ($copied_name) {
            $file_path = "./data/".$copied_name;
            unlink($file_path);
        }

        $sql = "delete from board where num = $num";
        //해당된 레코드를 없애버린다
        mysqli_query($con, $sql);
        mysqli_close($con);
    }

    switch ($mode) {
      case 'delete':
        board_delete($con,$num, $page);
        //넘버와 페이지를 넘겨 준다
        echo "
           <script>
               location.href = 'board_list.php?page=$page';
           </script>
         ";
        break;
      default:
        break;
    }

?>
