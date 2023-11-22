<?php
    $sum = 0;
    $i = 100;
    do {
        if ($i % 3 == 0) {
            print $i." ";
            $sum = $sum + $i;
        }  
        $i++;
    } while ($i <= 300);
    
    print "100 ~ 300까지의 정수 중 3의 배수의 합 : ".$sum;
?>