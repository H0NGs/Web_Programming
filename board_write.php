<html>
<head>
    <title>게시판 글쓰기</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="mystyle.css" rel="stylesheet">

    <script language="JavaScript"> 
    function check_input(doc) {
        if (doc.writer.value=="") {
            alert ("글쓴이를 입력해 주십시오.");
            return;
        }
        if (doc.title.value=="") {
            alert ("제목을 입력해 주십시오.");
            return;
        }
        if (doc.password.value=="") {
            alert("Password를 입력해 주십시오.");
            return;
        }
        doc.submit();
    } 
    </script>
</head>

<body>
<?php
    include ('./include.inc');

    $mode = $_GET["mode"];

    if(! isset($_GET["num"])) $num = 0;
    else $num = $_GET["num"];
    if(! isset($_GET["page"])) $page = 1;
    else $page = $_GET["page"];

    if ($mode=="Reply") {
        $query = "select title, content from board where num=".$num;
        $result = mysqli_query($conn, $query);
        $list=mysqli_fetch_assoc($result);
        $list['title'] = "(Re) ".$list['title'];
        $list["writer"]="";   $list["email"]="";  $list["content"]="[댓글 쓰기]";   $list["filename"]="";
    }
    else if ($mode=="Update") {
        $query="select * from board where num=".$num;
        $result = mysqli_query($conn, $query);
        $list=mysqli_fetch_assoc($result);
    }
    else {   // Insert인 경우 DB에 데이터가 없으므로 표시할 데이터를 Null로 채움
        $list["writer"]="";   $list["email"]="";   $list["title"]="";   $list["content"]="";   $list["filename"]="";
    }
?>

<form name="board_form" action="board_save.php" method="POST" enctype="multipart/form-data">
    <center><img src="images/board_title.gif" alt="게시판 글쓰기"><br><br>
    <table border="1" align="center" cellspacing="0" width="450">
        <tr height="30">
            <td align="center" width="100" bgcolor="lightblue">Name</td>
            <td width="700"><input type="text" name="writer" maxlength="50" size="35" value='<?php print $list['writer']; ?>'></td>
        </tr>
        <tr>
            <td align="center" width="100" bgcolor="lightblue">E-mail</td>
            <td width="700"><input type="text" name="email" maxlength="30" size="35" value='<?php print $list['email']; ?>'></td>
        </tr>
        <tr>
            <td align="center" width="100" bgcolor="lightblue">Title</td>
            <td width="700"><input type="text" name="title" maxlength="255" size="100" value='<?php print $list['title']; ?>'></td>
        </tr>
        <tr>
            <td align="center" width="100" bgcolor="lightblue">Content</td>
            <td width="700"><textarea name="content" cols="100" rows="10"><?php print $list['content']; ?></textarea></td>
        </tr>
        <tr>
            <td align="center" width="100" bgcolor="lightblue">File</td>
            <td><input type="file" name="filename"><font color="BLUE">Uploaded File: </font><?php print $list['filename']; ?></td>
        </tr>
        <tr>
            <td align="center" width="100" bgcolor="lightblue">Password</td>
            <td><input type='password' name="password" maxlength="20"></td>
        </tr>         
    </table> 
    <?php 
        if ($mode=="Reply" || $mode=="Update") {
            print "<input type='hidden' name='num' value=".$num.">";
            print "<input type='hidden' name='page' value=".$page.">";
        }
        print "<input type='hidden' name='mode' value=".$mode.">";
    ?>
    </form> 
    <center><br>
    <?php
        print "<a href='board_list.php?page=".$page."'><img src='images/board_list.gif' width='80' height='29' alt='목록으로 이동'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        print "<a href='javascript:history.back(-1)'><img src='images/board_cancel.gif' width='80' height='29' alt='취소'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        print "<a href='javascript:check_input(document.board_form)'><img src='images/board_submit.gif' width='80' height='29' alt='저장'>";
    ?>

</body>
</html>
