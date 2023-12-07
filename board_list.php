<html>
<head>
      <title>게시판</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link href=mystyle.css rel="stylesheet" type="text/css">
</head>

<body>
   <table width=630 border=0 cellspacing=0 cellpadding=0>
      <tr><td width=100% height=50 align=center><img src=images/board_title.gif></td></tr>	    
      <tr><td width=100%>

 <?php    // Main 시작 ===========================================

   include ("./include.inc");

   if (! isset($_GET['page'])) $page = 1;
   else  $page = $_GET['page'];

   $pg_view_cnt=5;   // 한 페이지에 보여줄 게시물 개수
   
   $query="select num, root, reply, title, writer, wdate, count from board where reply=0 order by root desc";
   $list_result=mysqli_query($conn, $query);
   $totalCount=mysqli_num_rows($list_result);  // 게시물의 총 개수 구하기

   if ($totalCount>(floor($totalCount/$pg_view_cnt))*$pg_view_cnt)    // 얻어온 게시물로 전체 페이지 수를 계산
       $totalCount=floor($totalCount/$pg_view_cnt)+1;
   else
       $totalCount=$totalCount/$pg_view_cnt;
 ?>  
     <table border=0 cellpadding=0 cellspacing=0 width=630>
         <tr  height=30 align=center> 
            <td width=57><img src=./images/board_g01.gif></td> 
            <td width=335><img src=./images/board_g02.gif></td> 
            <td width=110><img src=./images/board_g03.gif></td>
            <td width=69><img src=./images/board_g04.gif></td>
            <td width=59><img src=./images/board_g05.gif></td> 
         </tr> 

<?php 
   $i=0;   // 읽어온 모든 게시물에 대해 반복 처리
   $j=0;   // 한 페이지에 보여줄 최대 게시물 수에 도달했는지를 판단하기 위한 반복 변수
   while($list=mysqli_fetch_array($list_result))  {  // 게시물 목록 출력 부분
      $i=$i+1;
	   if (($page-1)*$pg_view_cnt < $i)  {  // 출력할 해당 페이지를 찾아 레코드 출력
         $j=$j+1;
	      print "<tr height=15 valign=bottom> <td align=center>".$list["root"]."</td>";
	      print "<td><a href=board_view.php?page=".$page."&num=".$list["num"] . ">" . $list["title"]."</a></td>";
	      print "<td align=center>".$list["writer"]."</td>";      
         print "<td align=center>".$list["wdate"]."</td>";
	      print "<td align=center>".$list["count"]."</td></tr>";

         Sub_List($list["num"], 1, $list["num"], $page, $conn);  // 현재 출력한 게시물에 대한 댓글이 있으면 출력하기 위해 함수 호출
         
         if ($j == $pg_view_cnt && ($page-1)*$pg_view_cnt<=$i) {
				print "<tr><td colspan=5><img src=./images/board_g07.gif border=0></td></tr>";				
			} elseif ($j <= $pg_view_cnt && ($page-1)*$pg_view_cnt<=$i) {
            print "<tr><td colspan=5><img src=./images/board_g06.gif border=0></td></tr>";
         }
         else {
            print "<tr><td colspan=5><img src=./images/board_g07.gif border=0></td></tr>";				
         }
      }
      if ($j==$pg_view_cnt) break;
   }

   if ($j<$pg_view_cnt && $j!=0) {   // 목록의 마지막 페이지 게시물 갯수가 적을 때 빈 줄 출력하기 위한 Routine
		for ($k=$j; $k<$pg_view_cnt; $k++)	{
         if ($k+1<$pg_view_cnt)	{
            print "<tr height=20><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            print "<tr><td colspan=5><img src=./images/board_g06.gif></td></tr>";
         }
         else {
            print "<tr height=20><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            print "<tr><td colspan=5><img src=./images/board_g07.gif></td></tr>";				
         }
      }
   }

   if ($j==0) {
      print "<tr height=300><td colspan=5 align=center>.......... 등록된 내용이 없습니다 ..........</td></tr>";
      print "<tr><td colspan=5 align=center><img src=./images/board_g07.gif></td></tr>";
   }

 ?>
      </table> <br>

      <table border=0 cellpadding=0 cellspacing=0 width=500>
      <tr valign=center><td width=120 align=right>
         <?php  
           if($page>$pg_view_cnt) print "<a href=board_list.php?page=".(floor(($page-1)/$pg_view_cnt)*$pg_view_cnt)."><img src=images/before.gif></a>&nbsp;&nbsp;&nbsp;";  
         ?>
         </td>
         <td width=300>
       <?php   // 페이지 번호 목록 출력 부분
         if ($i==($page*$pg_view_cnt) || $page>1) {
            for ($i=(floor(($page-1)/$pg_view_cnt)*$pg_view_cnt+1); $i<=((floor(($page-1)/$pg_view_cnt))+1)*$pg_view_cnt; $i++) {
               if ($i==$totalCount)  {
                  if ($i==$page)  print "<B>".$i."</B>";    
                  else  print "<a href=board_list.php?&page=".$i.">".$i."</a>";
                  $i=$i+1;
                  break;
               }
               else if ($i==$page)  print  "<B>".$i."</B> | ";   
               else  print "<a href=board_list.php?page=".$i.">".$i."</a>  | ";
            } 
         }  
             else if($i>0) print "<B>1 </B> ";
      ?>
          </td>	
          <td width=80 align=left>
            <?php  // 다음 페이지목록 링크
               $i=$i-1;
               if ($i<$totalCount && $i>0)  print "<a href=board_list.php?page=".($i+1)."><img src=./images/next.gif></a>";
            ?>
         </td>
       </tr>
      <tr>
         <td colspan=4 align=right>
            <a href=board_write.php?page=0&mode=Insert><img src=./images/board_write.gif border=0 width=80 height=29></a>
         </td>
      </tr>
    </table>			
 </td>
</tr>
</table>

</body>
</html>

