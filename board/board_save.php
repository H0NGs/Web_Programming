<html>
    <head>
        <title>board_save</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body>
        <?php     
            include('./include.inc');
            $mode = $_POST['mode'] ? $_POST['mode'] : $_GET['mode'];
            $page = $_POST['page'] ? $_POST['page'] : $_GET['page'];

            if ($mode=="Reply") { // ==================== 댓글 ====================
                $qnum = $_POST['num'];

                $query = "SELECT MAX(num) AS maxNum FROM BOARD";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_array($result);
                $num = $list["maxNum"] + 1;
            
                $query = "SELECT num, root, reply FROM BOARD where num=".$qnum;
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_array($result);
                $root = $list["root"];
            
                if ($list["reply"] == 0) {
                    $reply = $list["num"];
                } else {
                    $reply_value = abs($list["reply"]) * (-1);
                    $query = "UPDATE BOARD SET reply=" . $reply_value . " where num=" . $qnum;
                    mysqli_query($conn, $query);
            
                    $reply = $list["num"];
                }

                $title = $_POST["title"];
                $writer = $_POST["writer"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $content = $_POST["content"];
    
                if (!empty($_FILES["filename"]["name"])) {
                    $filename = $_FILES["filename"]["name"];
                    $file_path = $file_save_dir.$filename;
                    if (upload_file($file_save_dir, $_FILES["filename"], $filename, $num)) {
                    } else {
                        echo "<script>history.back(-1);</script>";
                        exit();
                    }
                } 
                else {
                    $filename = "";
                }
    
                date_default_timezone_set('Asia/Seoul');
                $wdate = date("Y-m-d", time());
                $count=0;
                $connect_ip = GETENV("REMOTE_ADDR");

                $sql = "INSERT INTO BOARD VALUES(".$num.", ".$root.", ".$reply.", '".$title."', '".$writer."', '".$email."',
                '".$password."', '".$content."', '".$filename."', '".$wdate."', ".$count.", '".$connect_ip."');";
               mysqli_query($conn, $sql);
               mysqli_close($conn);
            }
            elseif ($mode=="Update") { // ==================== 수정 ====================
                $num = $_POST['num']; 

                $query = "SELECT * FROM BOARD WHERE num=".$num.";";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_assoc($result);

                $list_password = $list["password"];
                $post_password = $_POST["password"];

                if($post_password != $list_password) {
                    //뒤로 돌아가기
                    echo "<script>alert('비밀번호가 틀립니다. 확인하세요!'); history.back(-1);</script>";
                    exit();
                } else {
                    $num = $_POST['num'];
                    $title = $_POST["title"];
                    $writer = $_POST["writer"];
                    $email = $_POST["email"];
                    $content = $_POST["content"];

                    if (!empty($_FILES['filename']['name'])) {
                        $filename = $_FILES["filename"]["name"];
                        $file_path = $file_save_dir.$filename;
                        if (upload_file($file_save_dir, $_FILES["filename"], $filename, $num)) {
                        } else {
                            echo "<script>history.back(-1);</script>";
                            exit();
                        }
                    } 
                    else {
                        $query = "SELECT * FROM BOARD WHERE num=".$num.";";
                        $result = mysqli_query($conn, $query);
                        $list = mysqli_fetch_assoc($result);
                        $filename = $list['filename'];
                    } 
                     
                    $uquery = "UPDATE BOARD SET title='".$title."', writer='".$writer."', email='".$email."',
                    content='".$content."', filename='".$filename ."' WHERE num=".$num.";";
                    mysqli_query($conn, $uquery);
                    mysqli_close($conn);
                }
            }
            else { // ==================== 새글 ====================
                $query = "SELECT MAX(num) AS tnum FROM BOARD";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_assoc($result);
                $num = $list["tnum"] + 1;
    
                $query = "SELECT MAX(root) AS tnum FROM BOARD";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_assoc($result);
                $root = $list["tnum"] + 1;
    
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
                    } else {
                        echo "<script>history.back(-1);</script>";
                        exit();
                    }
                } 
                else {
                    $filename = "";
                }
    
                date_default_timezone_set('Asia/Seoul');
                $wdate = date("Y-m-d", time());
                $count=0;
                $connect_ip = GETENV("REMOTE_ADDR");
    
                $sql = "INSERT INTO BOARD VALUES(".$num.", ".$root.", ".$reply.", '".$title."', '".$writer."', '".$email."',
                 '".$password."', '".$content."', '".$filename."', '".$wdate."', ".$count.", '".$connect_ip."');";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
            }
        ?>
        <meta http-equiv='refresh' content='0; url=board_list.php'>
    </body>
</html>