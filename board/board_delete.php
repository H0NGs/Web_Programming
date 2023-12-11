<html style="transform-origin:top; transform:scale(1.5); -webkit-transform:scale(1.5); -moz-transform:scale(1.5); -o-transform:scale(1.5);" >
    <head>
        <meta charset="utf-8" />
        <link href="mystyle.css" rel="stylesheet" />
    </head>
    <body>

    <?php
	include ('./include.inc');

	if(! isset($_GET["num"])) $num = 0;
    else $num = $_GET["num"];
    $page=$_GET["page"];

    $query = "select * from board where num = ".$num.";";
    $result = mysqli_query($conn, $query);
    $list = mysqli_fetch_array($result);

    ?>
    <script language="JavaScript"> 
    function check_input(doc) {
	    if (doc.password.value=="") {
		    alert("Password를 입력해 주십시오.");
		    return;
	    }
	    doc.submit();
    } 
    </script>
    <center><img src=./images/board_title.gif><br><br>
<form name=board_form action=board_save.php method=POST enctype="multipart/form-data">
    <table border=1 align=center cellspacing=0 cellpadding=10 width=450>
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>Name</td>
            <td width=700><?php print $list['writer']; ?></td>
        </tr>
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>E-mail</td>
            <td width=700><?php print $list['email']; ?></td>
        </tr>
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>Title</td>
            <td width=700><?php print $list['title']; ?></td>
        </tr>
        <tr height=100>
            <td align=center width=100 bgcolor=lightblue>Content</td>
            <td width=700 valign=top><?php print $list['content']; ?></td>
        </tr>
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>File</td>
            <td><?php print $list['filename']; ?></td>
        </tr>
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>Date</td>
            <td><?php print $list['wdate']; ?></td>
        </tr>   
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>Count</td>
            <td><?php print $list['count']; ?></td>
        </tr>   
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>Password</td>
            <td><input type=password name=password></td>
        </tr>
    </table> 
    <?php
        print "<input type=hidden name=num value=".$num.">";
        print "<input type=hidden name=page value=".$page.">";
        print "<input type=hidden name=mode value=Delete>";
    ?>
</form>
    <center><br>
    <a href="board_view.php?page=<?php echo $page ?>&num=<?php echo $num ?>"><img src="./images/board_cancel.gif" width="80" height="29"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:check_input(document.board_form)"><img src="./images/board_delete.gif" width="80" height="29"></a>
</body>
</html>
