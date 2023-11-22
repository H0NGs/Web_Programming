<?php
    $number=$_POST["num"];
    $name=$_POST["name"];
    print $number."===".$name."<br>";
    
    $con = mysqli_connect("localhost", "root", "", "webpl");
    $sql = "insert into test(num, name) values(".$number.", '".$name."')";
    print $sql;

    mysqli_query($con, $sql);
    mysqli_close($con);
?>