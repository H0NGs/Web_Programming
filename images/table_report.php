<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<form action="table_report_2.php" method="POST" enctype="multipart/form-data">
    <table  width=1200 border="1" cellspacing="0" cellpadding="0" bordercolor=#000000 style="font-size:20px">
        <tr height=100 align=center bgcolor=#d7fdd0>
            <td colspan=6>
                <p style="font-size:40px;">학생 명부 <span style="font-size:30px">(컴퓨터공학과)</span></p>
            </td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5 >학 번</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="studentID" maxlength=10 placeholder="1234567890"></td>
            <td width=150 bgcolor=#fdffa5 >성 별</td>
            <td width=250 >
                <input style="width:20px;height:20px;" type="radio" name="sex" value="남" checked>남
                <input style="width:20px;height:20px;" type="radio" name="sex" value="여">여
            </td>
            <td width=150 bgcolor=#fdffa5 >사 진</td>
            <td width=250 style="color:#0000ff;"><input type="file" name="img_upload"></td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5 >성별(한글)</td>
            <td width=250 style="color:#0000ff;"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;letter-spacing:10px;" name="namekor" placeholder="홍길동"></td>
            <td width=150 bgcolor=#fdffa5 >성명(한자)</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;letter-spacing:10px;" name="namehieroglyph" placeholder="洪吉童"></td>
            <td width=150 bgcolor=#fdffa5 >성명(영문)</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="nameeng" placeholder="Gil-Dong Hong"></td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5>주 소</td>
            <td width=250 colspan=3 style="color:#0000ff"><input type="text" style="border:none;width:650px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="address" placeholder="제주도 제주시 제주대학로 102 공과대학 컴퓨터공학과"></td>
            <td width=150 bgcolor=#fdffa5>우편번호</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="zipCode" placeholder="63243"></td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5>연락처(Home)</td>
            <td width=250 colspan=2 style="color:#0000ff"><input type="text" style="border:none;width:400px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="homeNumber" placeholder="064-123-1234"></td>
            <td width=150 bgcolor=#fdffa5>연락처(H.P)</td>
            <td width=250 colspan=2 style="color:#0000ff"><input type="text" style="border:none;width:400px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="phoneNumber" placeholder="010-000-0000"></td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5>ID</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="ids" placeholder="abcde"></td>
            <td width=150 bgcolor=#fdffa5>Password</td>
            <td width=250 style="color:#0000ff"><input type="password" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="pass" placeholder="******"></td>
            <td width=150 bgcolor=#fdffa5>E-Mail</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="email" placeholder="abc@cheju.ac.kr"></td>
        </tr>
        <tr height=80 align=center >
            <td width=150 bgcolor=#fdffa5>학 년</td>
            <td width=250 style="color:#0000ff"><input type="text" style="border:none;width:250px;
            height:80px;font-size:20px;color:#0000ff;text-align:center;" name="grade" placeholder="2"></td>
            <td width=150 bgcolor=#fdffa5>등록상태</td>
            <td width=250>
                <input style="width:20px; height:20px;" type="radio" name="unv" value="재학" checked/>재학
                <input style="width:20px; height:20px;" type="radio" name="unv" value="휴학"/>휴학
            </td>
            <td width=150 bgcolor=#fdffa5>병 역</td>
            <td width=250>
                <input style="width:20px; height:20px;" type="radio" name="ful" value="미필" checked/>미필
                <input style="width:20px; height:20px;" type="radio" name="ful" value="필"/>필
            </td>
        </tr>
        <tr height=80 align=center>
            <td width=150 bgcolor=#fdffa5>기타</td>
            <td colspan=5 style="color:#0000ff">
                <p><textarea name="etc" style="border:none;width:1050px;height:80px;font-size:20px;color:#0000ff;text-align:center;vertical-align:middle;"></textarea></p>
            </td>
        </tr>
    </table>
    <input style="width:1200px;height:80px;font-size:23px" type='submit' value='전송'>
</form>
</body>
</html>