<html style="display:flex;justify-content:center;align-items:center;">
<head>
      <title>board</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link href="style.css" rel="stylesheet">
</head>
<body>
   <table width="500" border=0 cellspacing="0" cellpadding="0">
      <tr><td width=100% height=20 align=center><B>게 시 판</B></td></tr>	    
      <tr><td width=100%>

 <?php    // Main 시작 ===========================================
   include ("./include.inc");

   if (! isset($_GET['page'])) $page = 1;
   else  $page = $_GET['page'];
   
   $pg_view_cnt=10;   // 한 페이지에 보여줄 게시물 개수
   
   $query="select num, root, reply, title, writer, wdate, count from board where reply=0 order by root desc";
   $list_result=mysqli_query($conn, $query);
   $totalCount=mysqli_num_rows($list_result);  // 게시물의 총 개수 구하기
   
   if ($totalCount>(floor($totalCount/$pg_view_cnt))*$pg_view_cnt)    // 얻어온 게시물로 전체 페이지 수를 계산
       $totalCount=floor($totalCount/$pg_view_cnt)+1;
   else
       $totalCount=$totalCount/$pg_view_cnt;
   
 ?>  
     <table border=0 cellpadding=0 cellspacing=0 width=500>
         <tr  height=40 align=center  bgcolor=f0f8ff> <td width=50>번호</td> <td width=200>제목</td> 
            <td width=100>글쓴이</td><td width=100>날짜</td><td width=50>조회수</td> </tr> 

<?php 

   $i=0;   // 읽어온 모든 게시물에 대해 반복 처리
   $j=0;   // 한 페이지에 보여줄 최대 게시물 수에 도달했는지를 판단하기 위한 반복 변수
   while($list=mysqli_fetch_array($list_result))  {  // 게시물 목록 출력 부분
      $i=$i+1;
	   if (($page-1)*$pg_view_cnt < $i)  {  // 출력할 해당 페이지를 찾아 레코드 출력
         $j=$j+1;
	      print "<tr height=15 valign=bottom>   <td align=center>".$list["root"]."</td>";
	      print "<td><a href=board_view.php?page=".$page."&num=".$list["num"] . ">" . $list["title"]."</a></td>";
	      print "<td align=center>".$list["writer"]."</td>";      
         print "<td align=center>".$list["wdate"]."</td>";
	      print "<td align=center>".$list["count"]."</td></tr>";
         print "<tr><td colspan=5>---------------------------------------------------------------------------------------</td></tr>";
         
         Sub_List($list["num"], 1, $list["num"], $page, $conn);  // 현재 출력한 게시물에 대한 댓글이 있으면 출력하기 위해 함수 호출
      }
      if ($j==$pg_view_cnt) break;
   }

   if ($j<$pg_view_cnt && $j!=0) {
		for ($k=$j; $k<$pg_view_cnt; $k++)	{
         if ($k+1<$pg_view_cnt)	{
            print "<tr height=20><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            print "<tr><td colspan=5>---------------------------------------------------------------------------------------</td></tr>";
         }
         else {
            print "<tr height=20><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            print "<tr><td colspan=5>===================================================</td></tr>";				
         }
      }
   }

   if ($j==0) {
      print "<tr height=300><td colspan=5 align=center>.......... 등록된 내용이 없습니다 ..........</td></tr>";
      print "<tr><td colspan=5 align=center>===================================================</td></tr>";
   }
   
 ?>
      </table> <br>

      <table border=0 cellpadding=0 cellspacing=0 width=400>
      <tr valign=center><td width=80>
       <?php  if ($page>$pg_view_cnt)  print "<a href=board.php?page=".(floor(($page-1)/$pg_view_cnt)*$pg_view_cnt).">◀</a>";  ?>
         </td>
         <td width=300>
       <?php   // 페이지 번호 목록 출력 부분
         if ($i==($page*$pg_view_cnt) || $page>1) {
            for ($i=(floor(($page-1)/$pg_view_cnt)*$pg_view_cnt+1); $i<=((floor(($page-1)/$pg_view_cnt))+1)*$pg_view_cnt; $i++) {
               if ($i==$totalCount)  {
                  if ($i==$page)  print "<B>".$i."</B>";    else  print "<a href=board.php?&page=".$i.">".$i."</a>";
                  $i=$i+1;
                  break;
               }
               else if ($i==$page)  print  "<B>".$i."</B> | ";   else  print "<a href=board.php?page=".$i.">".$i."</a>  | ";
            } 
         }  
             else if($i>0) print "<B>1 </B> ";
      ?>
          </td>	
          <td width=80>
            <?php  // 다음 페이지목록 링크
               $i=$i-1;
               if ($i<$totalCount && $i>0)  print "<a href=board.php?page=".($i+1).">▶</a>";
            ?>
         </td>
       </tr>
      <tr><td colspan=4 align=right><a href=board_write.php?mode='Insert'>글 쓰기</a></td></tr>
    </table>			
 </td>
</tr>
</table>

</body>
</html>

