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

            if ($mode=="Insert") { // ==================== 새글 ====================
                $query = "SELECT MAX(num) AS tnum FROM BOARD";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_assoc($result);
                $num = $list["tnum"] + 1;
    
                $query = "SELECT MAX(root) AS troot FROM BOARD";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_assoc($result);
                $root = $list["troot"] + 1;
    
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
                        echo " ";
                    } 
                    else {
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
            } elseif ($mode=="Reply") { // ==================== 댓글 ====================
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
                        echo " ";
                    } 
                    else {
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
            } elseif ($mode=="Update") { // ==================== 수정 ====================
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
                            echo " ";
                        } 
                        else {
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
            } else if($mode='Delete') {
                $num = $_POST['num'];  
                $password = $_POST['password'];
                $query = "select num, root, reply, password from board where num=".$num.";";
                $result = mysqli_query($conn, $query);
                $list = mysqli_fetch_array($result) ;
                $root = $list['root'];
                $DB_password = $list['password'];
                $reply = $list['reply'];
                $onum = $num;  // original Number backup
            
                if ($DB_password != $password) {  // 비밀번호 일치 여부 Check
                    print "<script> alert('비밀번호가 맞지 않습니다.  확인하십시오!!!');
                                history.back(-1); </script>";
                    exit;
                }
            
                if ($reply==0) {    // 최초 원글이므로 모든 하위 게시물 동시에 삭제
                    $query = "delete from board where root=".$root.";";
                    mysqli_query($conn, $query);
                }
                else if ($reply<0) {  // 자신 글과 이하 댓글 삭제
                    $query = "delete from board where num=".$num.";";
                    mysqli_query($conn, $query);
            
                    static $num_array;
                    static $ptr = 0;    // $ptr=num_array의 위치 
                    $num_array[0] = $num;
                    
                    Sub_Delete($conn);    // 하위 댓글을 모두 찾아 $num_array에 저장
            
                    // num_array에 있는 번호 게시물 모두 삭제 
                    for($i=1; $i<=$ptr; $i++) {
                        $query = "delete from board where num=".$num_array[$i].";";
                        mysqli_query($conn, $query);
                        print $query."<br>";
                    }
            
                    $ptr = 0; // $ptr은 전역 변수이므로 삭제 작업이 끝나면 초기화해야 함
                    
            
                } 
                else {  // reply 값이 양수일 때, 그 댓글만 삭제하면 됨
                    $query = "delete from board where num=".$num.";";
                    mysqli_query($conn, $query);
                }
                
            }
        ?>
        <meta http-equiv='refresh' content='0; url=board_list.php'>
    </body>
</html>