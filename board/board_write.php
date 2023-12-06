<html>
    <head>
        <title>board_write</title>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    </head>
    <body align="center">
    <?php
        include('./include.inc');
        $mode = $_POST['mode'] ? $_POST['mode'] : $_GET['mode'];
        $page = $_POST['page'] ? $_POST['page'] : $_GET['page'];

        if ($mode=="Reply") {
            $num = $_GET['num'];
            $query = "SELECT * FROM BOARD WHERE num=".$num.";";
            $result = mysqli_query($conn, $query);
            $list = mysqli_fetch_array($result);

            $writer = $list["writer"]="";
            $email = $list["email"]="";
            $title = "[Re]&nbsp;".$list["title"];
            $content = $list["content"]="";
            $filename = $list["filename"]="";
        }
        elseif ($mode=="Update") {
            $num = $_GET['num'];
            $query = "SELECT * FROM BOARD WHERE num=".$num.";";
            $result = mysqli_query($conn, $query);
            $list = mysqli_fetch_array($result);

            $writer = $list["writer"];
            $email = $list["email"];
            $title = $list["title"];
            $content = $list["content"];
            $filename = $list["filename"];
        }
        else {
            $writer = $list["writer"]="";
            $email = $list["email"]="";
            $title = $list["title"]="";
            $content = $list["content"]="";
            $filename = $list["filename"]="";
        }
    ?>
        <form action="board_save.php" method="POST" enctype="multipart/form-data">
        <p style="font-size:40px;" align="center">게시판 글쓰기</p>
        <table align="center" width="1200" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="font-size:20px;">
            <tr height=50>
                <td align="center" width="200">Name</td>
                <td><input style="height:45;width:400px;" type="text" name="writer" value=<?php echo $writer; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">email</td>
                <td><input style="height:45;width:400px;" type="text" name="email" value=<?php echo $email; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Title</td>
                <td><input style="height:45;width:999px;" type="text" name="title" value=<?php echo $title; ?>></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Content</td>
                <td><textarea name="content" style="border:0;width:999px;height:300px;"><?php echo str_replace(chr(13), "<br>", $content); ?></textarea></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">File</td>
                <td><input style="height:45;" type="file" name="filename">Uploaded file: <?php echo $filename; ?></td>
            </tr>
            <tr height=50>
                <td align="center" width="200">Password</td>
                <td><input style="height:45;width:200px;" type="password" name="password"></td>
            </tr>
        </table>
        <?php 
            if($mode=="Update" || $mode=="Reply"){
                ?>
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                    <input type="hidden" name="page" value="<?php echo $page; ?>">
                    <input type="hidden" name="num" value="<?php echo isset($num) ? $num : ''; ?>">
                <?php
            }
        ?>
        <br><br>
        <?php echo "<button style='font-size:25;' type='button' onclick=location.href='board.php'>목록</button>&nbsp;&nbsp;&nbsp;" ?>
        <input style="font-size:25;" type='submit' value='저장'>
        </form>
    </body>
</html>
