<html>
    <head>
        <title>board_save</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body>
    <?php 

include ("./include.inc");      // include.inc 파일을 가져와서 이 위치에 붙임
// Insert, Reply, Update, Delete 작업 구분을 위한 변수로 $mode를 사용함.
$mode = $_POST['mode'] ? $_POST['mode']:$_GET['mode'];
if(! isset($_POST['page'])) $page=1;
else $page = $_POST['page'];

date_default_timezone_set('Asia/Seoul');
$date = date("Y-m-d h:i:s", time());
$ip = getenv("REMOTE_ADDR");

if($mode=='Insert') {
    $query = "select max(num) as tnum from board";  
    $result = mysqli_query($conn, $query);           
    $list = mysqli_fetch_array($result);             
    $num=$list["tnum"]+1;    // $list 배열에서 tnum 필드값을 가져와서 1 증가 시킴

    $query = "select max(root) as troot from board";
	$result = mysqli_query($conn, $query);
	$list = mysqli_fetch_array($result);
	$root=$list["troot"]+1;  

    $addfile = $_FILES["files"];        // 첨부파일 처리를 위한 파일 이름 정보 추출
    $addfile_name= $addfile['name'];
    $addfile_name=str_replace(" ","_",$addfile_name);

    if($addfile_name!="") {  // 첨부 파일이 있을 때
		if(upload_file($file_save_dir, $addfile, $addfile_name, $num))	{
            $content=$_POST['content'];
            $query = "insert into board values (".$num.", ".$root.", 0, '".$_POST['title']."', '"
                .$_POST['name']."','".$_POST['email']."','".$_POST['pw']."','".$content."','"
                .$addfile_name."',0,'".$date."','".$ip."');";     // 정의된 테이블의 필드 순서대로 값을 적어야 함
        }
    }
    else {      // 첨부 파일이 없을 때
        $query = "insert into board values (".$num.", ".$root.", 0, '".$_POST['title']."', '"
            .$_POST['name']."','".$_POST['email']."','".$_POST['pw']."','".$_POST['content']."','',0,'"
            .$date."','".$ip."');";
    }
    mysqli_query($conn, $query);
}
else if($mode=='Reply') {
    $qnum= $_POST["num"];    // 기존 번호를 qnum에 저장 => 기존 원글에 대한 정보를 유지하기 위함

    $query = "select max(num) as tnum from board";  
    $result = mysqli_query($conn, $query);           
    $list = mysqli_fetch_array($result);             
    $num=$list["tnum"]+1;    // 가장 큰 num 값에 1증가 => 새로 작성하는 댓글의 순차 번호 부여
		
    $query = "select num, root, reply from board where num=".$qnum;
    $result = mysqli_query($conn, $query);
    $list = mysqli_fetch_array($result);
    $root = $list["root"];      //댓글 처리를 위한 num, root, reply 값 가져오기

    if ($list["reply"]==0) {    // 원글의 reply 값이 0이면, 댓글을 위한 $reply 변수에 기존 num을 저장하여 어느 글의 댓글인가를 표기
        $reply=$list["num"];
    }
    else {    // reply 값이 0이 아니면, 댓글을 위한 $reply 변수값을 음수로 바꿈 => 이는 원글이 최초의 원글이 아닌 댓글이라는 뜻
        $reply_value = abs($list["reply"])*(-1);    // 댓글에 대한 댓글이 다시 있는 경우 위의 댓글 정보를 음수화
        $query="update board set reply=".$reply_value." where num=".$qnum;   // 기존의 상위 댓글에 다시 댓글이 달린다는 의미로 음수화된 값으로 갱신
        mysqli_query($conn, $query);

        $reply=$list["num"];
    }

    $addfile = $_FILES["files"];        // 첨부파일 처리를 위한 파일 이름 정보 추출
    $addfile_name= $addfile['name'];
    $addfile_name=str_replace(" ","_",$addfile_name);
    $title = str_replace("'","\'",$_POST['title']);

    if($addfile_name!="") {
		if(upload_file($file_save_dir, $addfile, $addfile_name, $num))	{
            $query = "insert into board values (".$num.", ".$root.",".$reply.",'".$title."','"
                .$_POST['name']."','".$_POST['email']."','".$_POST['pw']."','".$_POST['content']."','"
                .$addfile_name."',0,'".$date."','".$ip."');";     
        }
    }
    else {
        $query = "insert into board values (".$num.",".$root.",".$reply.",'".$title."','"
            .$_POST['name']."','".$_POST['email']."','".$_POST['pw']."','".$_POST['content']."','',0,'"
            .$date."','".$ip."');";
    }  
    print $query."<br>";
    mysqli_query($conn, $query);
}
else if($mode=='Update') {
    $num = $_POST["num"];
    $query = "select * from board where num = ".$num.";";
    $result = mysqli_query($conn, $query);
    $list = mysqli_fetch_array($result);

    // 비밀번호 일치 여부 Check
    $dbpwd = $list['password'];
    $pw = $_POST['pw'];

    if($dbpwd != $pw) {
        print "<script> 
                  alert('비밀번호가 맞지 않습니다.  확인하십시오!!!');   
                  history.back(-1); 
               </script>";
		exit;
    }

    $addfile = $_FILES["files"];        // 첨부파일 처리를 위한 파일 이름 정보 추출
    $addfile_name= $addfile['name'];
    $addfile_name=str_replace(" ","_",$addfile_name);

    if($addfile_name!="") {
		if(upload_file($file_save_dir, $addfile, $addfile_name, $num))	{
            $query = "update board set num=".$num.", root=".$list['root'].", reply=".$list['reply'].", title='"
                .$_POST['title']."', writer='".$_POST['name']."', email='".$_POST['email']."', password='"
                .$_POST['pw']."', content='".$_POST['content']."', filename='".$addfile_name.
                "', count=0, wdate='".$date."', connect_ip='".getenv('REMOTE_ADDR')."' where num=".$num.";";
        }
    }
    else {
        $query = "update board set num=".$num.", root=".$list['root'].", reply=".$list['reply'].", title='"
                .$_POST['title']."', writer='".$_POST['name']."', email='".$_POST['email']."', password='"
                .$_POST['pw']."', content='".$_POST['content']."', filename='', count=0, wdate='"
                .$date."', connect_ip='".getenv('REMOTE_ADDR')."' where num=".$num.";";
    }
    mysqli_query($conn, $query);
}
else if($mode='Delete') {
    $num = $_POST['num'];  
    $pwd = $_POST['pwd'];
    $query = "select num, root, reply, password from board where num=".$num.";";
    $result = mysqli_query($conn, $query);
    $list = mysqli_fetch_array($result) ;
    $root = $list['root'];
    $DB_pwd = $list['password'];
    $reply = $list['reply'];
    $onum = $num;  // original Number backup

    if ($DB_pwd != $pwd) {  // 비밀번호 일치 여부 Check
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

mysqli_close($conn);

print "<meta http-equiv='refresh' content='0; url=board_list.php?page=".$page."'>";
?> 



    </body>
</html>