<html>
    <head>
        <title>board_write</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body align="center">
        <form action="board_save.php" method="post" enctype="multipart/form-data">
        <p style="font-size:40px;" align="center">게시판 글쓰기</p>
        <table align="center" width="1200" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="font-size:20px;">
            <tr height=50>
                <td align="center" width="200">Name</td>
                <td><input style="height:45;width:400px;" type="text" name="writer" value=<?php echo $list["writer"]; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">email</td>
                <td><input style="height:45;width:400px;" type="text" name="email" value=<?php echo $list["email"]; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Title</td>
                <td><input style="height:45;width:999px;" type="text" name="title" value=<?php echo $list["title"]; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Content</td>
                <td><textarea name="content" style="border:0;width:999px;height:300px;"><?php echo str_replace(chr(13), "<br>", $list["content"]); ?></textarea></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">File</td>
                <td><input style="height:45;width:999px;" type="file" name="filename" value=<?php echo $list["filename"]; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Password</td>
                <td><input style="height:45;width:200px;" type="password" name="password" ?>></td>
            </tr>
        </table>
        <br><br>
        <?php echo "<button style='font-size:25;' type='button' onclick=location.href='board.php'>목록</button>&nbsp;&nbsp;&nbsp;" ?>
        <input style="font-size:25;" type='submit' value='저장'>
        </form>
    </body>
</html>
