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

            $email = $_POST["email"];

            $password = $_POST["password"];

            $content = $_POST["content"];

            $filename = $_FILES["filename"]["name"];
            //$file_dir = "C:\\xampp\\htdocs\\board\\files\\"; // Windows 전용
            $file_dir = "/Applications/XAMPP/xamppfiles/htdocs/board/files/"; // Unix 기반 전용
            $file_path = $file_dir.$filename;
            if (move_uploaded_file($_FILES["filename"]["tmp_name"], $file_path)) {
                //$img_path = "files\\".$filename; // Windows 전용
                $img_path = "files/".$filename; // Unix 기반 전용
            }

            date_default_timezone_set('Asia/Seoul');
            $wdate = date("H:i:s");
            
            $count=0;

            $connect_ip = GETENV("REMOTE_ADDR");

            $sql = "INSERT INTO BOARD VALUES(".$num.", ".$root.", ".$reply.", '".$title."', '".$writer."', '".$email."',
             '".$password."', '".$content."', '".$filename."', '".$wdate."', ".$count.", '".$connect_ip."');";
            mysqli_query($con, $sql);
            mysqli_close($con);
        ?>
        <meta http-equiv='refresh' content='0; url=board.php'>
    </body>
</html>
