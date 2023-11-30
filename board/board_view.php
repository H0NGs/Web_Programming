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
        ?>
    </head>
    <body align="center">
        <form action="board_save.php" method="post" enctype="multipart/form-data">
        <p style="font-size:40px;" align="center">게시판 글쓰기</p>
        <table align="center" width="1200" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="font-size:20px;">
            <tr height=50>
                <td align="center" width="200">Name</td>
                <td align="center" style="height:45;width:400px;"><?php echo $list['writer']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">email</td>
                <td align="center" style="height:45;width:400px;"><?php echo $list['email']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Title</td>
                <td align="center" style="height:45;width:999px;"><?php echo $list['title']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Content</td>
                <td align="center" style="width:999px;height:300px;"><?php echo $list['content']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">File</td>
                <td align="center" style="height:45;width:999px;"><?php echo $list['filename']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">wdate</td>
                <td align="center" style="height:45;width:999px;"><?php echo $list['wdate']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">count</td>
                <td align="center" style="height:45;width:999px;"><?php echo $list['count']; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">connect_ip</td>
                <td align="center" style="height:45;width:999px;"><?php echo $list['connect_ip']; ?></td>
            </tr>
        </table>
        <a style="font-size:25;text-decoration:none;color:inherit;" href="board.php">[목록]</a>
        <a style="font-size:25;text-decoration:none;color:inherit;" href="board_write.php">[수정]</a>
        <a style="font-size:25;text-decoration:none;color:inherit;" href="board_write.php">[댓글 쓰기]</a>
        <a style="font-size:25;text-decoration:none;color:inherit;" href="board_delete.php">[삭제]</a>
        </form>
    </body>
</html>
