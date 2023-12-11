<html style="transform-origin:top; transform:scale(1.5); -webkit-transform:scale(1.5); -moz-transform:scale(1.5); -o-transform:scale(1.5);" >
<head>
    <title>board_view</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
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

    // count 증가 routine 추가 + session 처리
    $cnt = $list['count'] + 1;
    $uquery = "update board set count=".$cnt." where num=".$num.";";
    mysqli_query($conn, $uquery);
?>
	<link href="mystyle.css" rel="stylesheet">

    <center><img src=images/board_title.gif><br><br>

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
            <td width=700 valign=top><?php print str_replace(chr(13), "<br>", $list["content"]); ?></td>
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
            <td><?php print $cnt; ?></td>
        </tr>   
        <tr height=20>
            <td align=center width=100 bgcolor=lightblue>IP Address</td>
            <td><?php print $list['connect_ip']; ?></td>
        </tr>
    </table> 

    <center><br>
    <?php
        print "<a href=board_list.php?page=".$page."><img src=images/board_list.gif width=80 height=29>&nbsp;&nbsp;&nbsp;";
        print "<a href=board_write.php?page=".$page."&num=".$num."&mode=Update><img src=./images/board_modify.gif width=80 height=29>&nbsp;&nbsp;&nbsp;";
        print "<a href=board_write.php?page=".$page."&num=".$num."&mode=Reply><img src=./images/board_reply.gif width=80 height=29>&nbsp;&nbsp;&nbsp;";
        print "<a href=board_delete.php?page=".$page."&num=".$num."&mode=Delete><img src=./images/board_delete.gif width=80 height=29>";
    ?>
    
</body>
</html>