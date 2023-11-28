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
                <td><input style="height:45;width:400px;" type="text" name="writer"></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">email</td>
                <td><input style="height:45;width:400px;" type="text" name="email"></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Title</td>
                <td><input style="height:45;width:999px;" type="text" name="title"></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Content</td>
                <td><textarea name="content" style="border:0;width:999px;height:300px;"></textarea></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">File</td>
                <td><input style="height:45;width:999px;" type="file" name="filename"/></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Password</td>
                <td><input style="height:45;width:200px;" type="password" name="password"></td>
            </tr>
        </table>
        <a style="font-size:25;text-decoration:none;color:inherit;" href="board_view.php">[목록]</a>
        <input style="height:80px;font-size:23;border:none;background-color:#ffffff;" type='submit' value='[저장]'>
        </form>
    </body>
</html>
