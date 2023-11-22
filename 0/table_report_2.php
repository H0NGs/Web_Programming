<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php
    $studentID=$_POST["studentID"];
    $sex=$_POST["sex"];
    $namekor=$_POST["namekor"];
    $namehieroglyph=$_POST["namehieroglyph"];
    $nameeng=$_POST["nameeng"];
    $address=$_POST["address"];
    $zipCode=$_POST["zipCode"];
    $homeNumber=$_POST["homeNumber"];
    $phoneNumber=$_POST["phoneNumber"];
    $ids=$_POST["ids"];
    $pass=$_POST["pass"];
    $email=$_POST["email"];
    $grade=$_POST["grade"];
    $unv=$_POST["unv"];
    $ful=$_POST["ful"];
    $etc=$_POST["etc"];
?>
<table width="1200" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="font-size:20px;">
    <tr height="100" align="center" bgcolor="#d7fdd0">
        <td colspan="6"><p style="font-size:40px;">학생 명부 <span style="font-size:30px;">(컴퓨터공학과)</span></p></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">학 번</td>
        <td width="250" style="color:#0000ff;"><?php echo $studentID; ?></td>
        <td width="150" bgcolor="#fdffa5">성 별</td>
        <td width="250" style="color:#0000ff;"><?php echo $sex; ?></td>
        <td width="150" bgcolor="#fdffa5">사 진</td>
        <td width="250" style="color:#0000ff;">
            <?php
                $file_dir = "/Applications/XAMPP/xamppfiles/htdocs/images/";
                $file_path = $file_dir.$_FILES["img_upload"]["name"];
                if (move_uploaded_file($_FILES["img_upload"]["tmp_name"], $file_path)) {
                    $img_path = "images/".$_FILES["img_upload"]["name"];
            ?>
            <img height="80" width="250" src="<?= $img_path?>">
            <?php
                }
                else {
                    echo "파일 업로드 오류가 발생했습니다!!!";
                }
            ?>
        </td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">성별(한글)</td>
        <td width="250" style="color:#0000ff;"><?php echo $namekor; ?></td>
        <td width="150" bgcolor="#fdffa5">성명(한자)</td>
        <td width="250" style="color:#0000ff;"><?php echo $namehieroglyph; ?></td>
        <td width="150" bgcolor="#fdffa5">성명(영문)</td>
        <td width="250" style="color:#0000ff;"><?php echo $nameeng; ?></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">주 소</td>
        <td colspan="3" style="color:#0000ff;"><?php echo $address; ?></td>
        <td width="150" bgcolor="#fdffa5">우편번호</td>
        <td width="250" style="color:#0000ff;"><?php echo $zipCode; ?></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">연락처(Home)</td>
        <td colspan="2" style="color:#0000ff;"><?php echo $homeNumber; ?></td>
        <td width="150" bgcolor="#fdffa5">연락처(H.P)</td>
        <td colspan="2" style="color:#0000ff;"><?php echo $phoneNumber; ?></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">ID</td>
        <td width="250" style="color:#0000ff;"><?php echo $ids; ?></td>
        <td width="150" bgcolor="#fdffa5">Password</td>
        <td width="250" style="color:#0000ff;"><?php echo $pass; ?></td>
        <td width="150" bgcolor="#fdffa5">E-Mail</td>
        <td width="250" style="color:#0000ff;"><?php echo $email; ?></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">학 년</td>
        <td width="250" style="color:#0000ff;"><?php echo $grade; ?></td>
        <td width="150" bgcolor="#fdffa5">등록상태</td>
        <td width="250" style="color:#0000ff;"><?php echo $unv; ?></td>
        <td width="150" bgcolor="#fdffa5">병 역</td>
        <td width="250" style="color:#0000ff;"><?php echo $ful; ?></td>
    </tr>
    <tr height="80" align="center">
        <td width="150" bgcolor="#fdffa5">기타</td>
        <td colspan="5" style="color:#0000ff;"><?php echo "<pre>".$etc."</pre>"; ?></td>
    </tr>
</table>
<?php
    $con = mysqli_connect("localhost", "root", "", "webpl");
    $sql = "INSERT INTO STUDENT VALUES('".$studentID."', '".$sex."', '".$namekor."', '".$namehieroglyph."'
    , '".$nameeng."', '".$address."', '".$zipCode."', '".$homeNumber."', '".$phoneNumber."', '".$ids."', '".$pass."'
    , '".$email."', ".$grade.", '".$unv."', '".$ful."', '".$etc."');";
    echo "<p style='font-size:30px;'>".$sql."</p>";

    mysqli_query($con, $sql);
    mysqli_close($con);
?>
</body>
</html>