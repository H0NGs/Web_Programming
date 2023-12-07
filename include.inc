<?php

   	$conn=mysqli_connect("localhost", "root", "", "webpl");

   	function Sub_List ($num, $depth, $now_num, $page, $conn)  { 
      if ($depth!=0)
			$squery="select num, root, reply, title, writer, wdate, count from board where abs(reply)=".$num;
		else
			$squery="select num, root, reply, title, writer, wdate, count from board where num=".$num;

      $result=mysqli_query($conn, $squery);

      while($list=mysqli_fetch_array($result))  {
		 print "<tr><td colspan=5><img src=./images/board_g06.gif></td></tr>";
         print "<tr><td height=15 align=center>&nbsp;</td> <td>";
         for($i=0; $i<$depth; $i++) 
            print "&nbsp;&nbsp;"; 
         print "<font color=GREEN>[Re]</font> <a href=board_view.php?page=".$page."&num=".$list["num"].">". $list["title"]."</a></td>";
         print "<td align=center>".$list["writer"]."</td>";        
         print "<td align=center>".$list["wdate"]."</td>";	
         print "<td align=center>".$list["count"]."</td></tr>";
         
         if ($num==abs($list["reply"]))  // 댓글이 있을 때	
            Sub_List ($list["num"], $depth+1, $now_num, $page, $conn);
      }
   	}

	function Sub_Delete($conn) {
		global $num_array, $ptr;    // $ptr=num_array의 위치 
		$query = "select num, root, reply from board where reply=".$num_array[$ptr]." OR reply=".$num_array[$ptr]*(-1).";";
		$result = mysqli_query($conn, $query);
		$rows = mysqli_num_rows($result);
		
		for($k=1; $k<=$rows; $k++) {
			$list = mysqli_fetch_array($result); 
			$num = $list['num'];    $root = $list['root'];    $reply = $list['reply'];
			$ptr++;
			$num_array[$ptr] = $num;
			print $ptr."--".$num_array[$ptr]."<br>";

			if ($reply<0) Sub_Delete($conn);
		}
	}

   $file_save_dir="./board/";
   // file 업로드 관련 합수
	function upload_file($saveDir,$addfile, $addfile_name, $num) {

		$dotpos=strpos($addfile_name,".");
		$full_filename=substr($addfile_name,0,$dotpos);
		$extension=substr($addfile_name,$dotpos+1,strlen($addfile_name)-$dotpos);
	
		if(!strcmp($extension,"html")||!strcmp($extension,"htm")||!strcmp($extension,"php")
            ||!strcmp($extension,"php3")||!strcmp($extension,"inc")||!strcmp($extension,"exe")
		    ||!strcmp($extension,"pl")||!strcmp($extension,"cgi")||!strcmp($extension,"asp")
            ||!strcmp($extension,""))  {
			echo "<script language='javascript'> ";
			echo "alert('업로드가 금지된 첨부파일명입니다!'); ";
			echo "</script>";
			echo "<meta http-equiv='refresh' content='0; url=javascript:history.back(-1)'>";
			echo "</head>";
			echo "</html>";
			return false;
		}

		$exist=file_exists($saveDir."/".$num."_".$full_filename.".".$extension);
		if($exist) {
			echo "<script language='javascript'> ";
		  	echo "alert('업로드할 첨부파일의 파일명이 이미 존재합니다!'); ";
		  	echo "</script>";
		  	echo "<meta http-equiv='refresh' content='0; url=javascript:history.back(-1)'>";
		  	echo "</head>";
		  	echo "</html>";
		  	return false;
		}

		if(!copy($addfile["tmp_name"],$saveDir."/".$num."_".$full_filename.".".$extension))	{
		  	echo "<script language='javascript'> ";
		  	echo "alert('첨부파일을 업로드하는데 실패하였습니다!'); ";
		  	echo "</script>";
		  	echo "<meta http-equiv='refresh' content='0; url=javascript:history.back(-1)'>";
		  	echo "</head>";
		  	echo "</html>";
		  	return false;
		}
		return 1; //(true)
	}
      


   
      