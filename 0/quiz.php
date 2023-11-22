<?php
    $dis = 0.72*($_POST["temp"]+$_POST["wet"])+40.6;
    print "<h1>".$dis."</h1><br>";
    if($dis > 80) {
        print "대부분의 사람들이 불쾌감을 느낌";
    } elseif($dis > 74) {
        print "약 50% 사람들이 불쾌감을 느낌";
    } elseif($dis > 69) {
        print "약 10% 사람들이 불쾌감을 느낌";
    } else {
        print "쾌적";
    }
?>