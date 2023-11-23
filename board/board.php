<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="style.css" rel="stylesheet" />
        <style type="text/css">
            .{
                font-family:Arial;
                font-size:14px;
                color:black;
                line-height:120%
            }

            td{
                font-family:Arial;
                font-size:14px;
                color:black;
                line-height:120%
            }

            a{
                font-family:Arial;
                font-size:14px;
                color:#006699;
                text-decoration:none
            }

            a:active{
                font-family:Arial;
                font-size:14px;
                color:#FF3333;
                text-decoration:none
            }

            A:hover{
                text-decoration;
                color:#ff9999
            } 
        </style>
    </head>
    <body>
        <table width="400" border=0 cellspacing="0" cellpadding="0">
            <tr>
                <td width=100% align=center><B>게 시 판</B></td>
            </tr>
            <tr>
                <td width=100%>
                    <?php
                        //function Sub_List($num, $depth, $now_num, $table)
                        $con = mysqli_connect("localhost:3306", "root", "", "webpl");
                        $pg_view_cnt = 10;
                        $sql = "select num, root, reply, title, writer, wdate, count from board where reply=0 order by root desc";
                        $list_result = mysqli_query($con, $sql);

                        $totalCount = mysqli_num_rows($list_result);

                        if ($totalCount > (floor($totalCount/$pg_view_cnt)) * $pg_view_cnt)
                            $totalCount = floor($totalCount/$pg_view_cnt) + 1;
                        else
                            $totalCount = $totalCount / $pg_view_cnt;

                        if ($page > 0)
                            $page = $page;
                        else
                            $page = 1;
                    ?>
                    <table border=0 cellpadding=0 cellspacing=0 width=400>
                        <tr align=center bgcolor=f0f8ff>
                            <td width=30>번호</td>
                            <td width=170>제목</td>
                            <td width=50>글쓴이</td>
                            <td width=100>날짜</td>
                            <td width=50>조회수</td>
                        </tr>
                        <?php
                            $i = 0; $j = 0;
                            while ($list = mysqli_fetch_array($list_result))
                            {
                                $i = $i + 1;
                                if (($page - 1) * $pg_view_cnt < $i) 
                                {
                                    $j = $j + 1;
                                    echo "<tr height=20 valign=bottom> <td align=center>".$list["root"]."</td>";
                                    echo "<td><a href=board_view.html?page=".$page."&num=".$list["num"] . ">".$list["title"]."</a></td>";
                                    echo "<td align=center>".$list["writer"]."</td>";
                                    echo "<td align=center>".$list["wdate"]."</td>";
                                    echo "<td align=center>".$list["count"]."</td></tr>";
                                    echo "<tr><td colspan=5>------------------------------------------------------------------</td></tr>";
                                }
                                //Sub_List($list["num"], 1, $list["num"], board);
                                echo "<tr><td colspan=5>------------------------------------------------------------------</td></tr>";
                                if ($j == $pg_view_cnt)
                                    break;
                            }
                        ?>
                    </table><br>
                </td>
        </table>
    </body>
</html>
