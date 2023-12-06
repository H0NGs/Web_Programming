<html>
    <head>
        <title>board_write</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
        <?php
            include('./include.inc');
            if(! isset($_GET["num"])) $num=0;
            else $num = $_GET["num"];
            $page = $_GET["page"];
            
            $query = "SELECT * FROM BOARD WHERE num=".$num.";";
            $result = mysqli_query($conn, $query);
            $list = mysqli_fetch_array($result);

            $writer = $list['writer'];
            $email = $list['email'];
            $title = $list['title'];
            $filename = $list['filename'];
            $wdate = $list['wdate'];

            $count = $list['count'] + 1;
            $uquery = "UPDATE BOARD SET count=".$count." WHERE num=".$num.";";
            mysqli_query($conn, $uquery);

            $connect_ip = $list['connect_ip'];
        ?>
    </head>
    <body align="center">
        <p style="font-size:40px;" align="center">게시판 글쓰기</p>
        <table align="center" width="1200" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="font-size:20px;">
            <tr height=50>
                <td align="center" width="200">Name</td>
                <td style="height:45;width:400px;padding:0 20 0 20px;"><?php echo $writer; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">email</td>
                <td style="height:45;width:400px;padding:0 20 0 20px;"><?php echo $email; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Title</td>
                <td style="height:45;width:1000px;padding:0 20 0 20px;"><?php echo $title; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Content</td>
                <td style="height:300px;width:1000px;padding:0 20 0 20px;"><?php echo str_replace(chr(13), "<br>", $list['content']); ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">File Name</td>
                <td style="height:45width:1000px;;padding:0 20 0 20px;"><?php echo $filename; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Date</td>
                <td style="height:45;width:1000px;padding:0 20 0 20px;"><?php echo $wdate; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Count</td>
                <td style="height:45;width:1000px;padding:0 20 0 20px;"><?php echo $count; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">IP Address</td>
                <td style="height:45;width:1000px;padding:0 20 0 20px;"><?php echo $connect_ip; ?></td>
            </tr>
        </table>
        <br><br>
        <?php echo "<button style='font-size:25;' type='button' onclick=location.href='board.php?page=$page'>목록</button>&nbsp;&nbsp;&nbsp;" ?>
        <button style="font-size:25;" type="button" onclick=location.href='board_write.php?page=<?php echo $page."&num=".$num."&mode=Update"; ?>'>수정</button>&nbsp;&nbsp;&nbsp;
        <button style="font-size:25;" type="button" onclick=location.href='board_write.php?page=<?php echo $page."&num=".$num."&mode=Reply"; ?>'>댓글 쓰기</button>&nbsp;&nbsp;&nbsp;
        <button style="font-size:25;" type="button" onclick=location.href='board_delete.php?page=<?php echo $page."&num=".$num."&mode=Delete"; ?>'>삭제</button>
    </body>
</html>
