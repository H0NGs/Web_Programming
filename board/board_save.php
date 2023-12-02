<html>
    <head>
        <title>board_save</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body>
        <?php     
            include('./include.inc');
            $mode = $_POST['mode'];
            $page = $_POST['page'];

            if ($mode=="Reply") {
    
            }
            elseif ($mode=="Update") {
                $num = $_POST['num']; 
                $title = $_POST["title"];
                $writer = $_POST["writer"];
                $email = $_POST["email"];
                $content = $_POST["content"];

                if (!empty($_FILES['filename']['name'])) {
                    $filename = $_FILES["filename"]["name"];
                    $file_path = $file_save_dir.$filename;
                    if (upload_file($file_save_dir, $_FILES["filename"], $filename, $num)) {
                        echo "파일 업로드 성공!";
                    } 
                    else {
                        echo "파일 업로드 실패";
                        exit();
                    }
                } 
                else {
                    $query = "SELECT * FROM BOARD WHERE num=".$num.";";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $filename = $row['filename'];
                }
                
                $uquery = "UPDATE BOARD SET title='".$title."', writer='".$writer."', email='".$email."', content='".$content."', filename='".$filename ."' WHERE num=".$num.";";
                mysqli_query($conn, $uquery);
                mysqli_close($conn);
            }
            else {
                $query = "SELECT MAX(num) AS maxNum FROM BOARD";
                $result = mysqli_query($conn, $query);
                $mNum = mysqli_fetch_assoc($result);
                $num = $mNum["maxNum"] + 1;
    
                $query = "SELECT MAX(root) AS maxRoot FROM BOARD";
                $result = mysqli_query($conn, $query);
                $mRoot = mysqli_fetch_assoc($result);
                $root = $mRoot["maxRoot"] + 1;
    
                $reply=0;
    
                $title = $_POST["title"];
    
                $writer = $_POST["writer"];
    
                $email = $_POST["email"];
    
                $password = $_POST["password"];
    
                $content = $_POST["content"];
    
                if (!empty($_FILES["filename"]["name"])) {
                    $filename = $_FILES["filename"]["name"];
                    $file_path = $file_save_dir.$filename;
                    if (upload_file($file_save_dir, $_FILES["filename"], $filename, $num)) {
                        echo "파일 업로드 성공!";
                    } 
                    else {
                        echo "파일 업로드 실패!";
                        exit();
                    }
                } 
                else {
                    $filename = "";
                }
    
                date_default_timezone_set('Asia/Seoul');
                $wdate = date("H:i:s");
                
                $count=0;
    
                $connect_ip = GETENV("REMOTE_ADDR");
    
                $sql = "INSERT INTO BOARD VALUES(".$num.", ".$root.", ".$reply.", '".$title."', '".$writer."', '".$email."',
                 '".$password."', '".$content."', '".$filename."', '".$wdate."', ".$count.", '".$connect_ip."');";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
            }
        ?>
        <meta http-equiv='refresh' content='0; url=board.php'>
    </body>
</html>
