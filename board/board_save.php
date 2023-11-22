<html>
    <head>
        <title>board_save.html</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body>
        <?php     
            $con = mysqli_connect("localhost:3306", "root", "", "WEBPL");
            $sql = "SELECT MAX(num) AS maxNum FROM BOARD";
            $result = mysqli_query($con, $sql);
            $list = mysqli_fetch_assoc($result);
            $num = $list["maxNum"] + 1;

            $sql = "SELECT MAX(root) AS maxRoot FROM BOARD";
            $result = mysqli_query($con, $sql);
            $list = mysqli_fetch_assoc($result);
            $root = $list["maxRoot"] + 1;

            $reply=0;

            $title = $_POST["title"];

            $writer = $_POST["writer"];

            $password = $_POST["password"];

            $content = $_POST["content"];

            $filename = $_FILES["filename"]["name"];

            date_default_timezone_set('Asia/Seoul');
            $wdate = date("H:i:s");
            
            $count=0;

            $connect_ip = GETENV("REMOTE_ADDR");

            $sql = "INSERT INTO BOARD VALUES(".$num.", ".$root.", ".$reply.", '".$title."', '".$writer."',
             '".$password."', '".$content."', '".$filename."', '".$wdate."', ".$count.", '".$connect_ip."');";
            mysqli_query($con, $sql);
            mysqli_close($con);
            
            echo "<meta http-equiv='refresh' content='0; url=board.html'>";
        ?>
    </body>
</html>
