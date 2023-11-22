<?php
    $grade = $_POST["grade"];

    switch ($grade)
    {
        case 1 : 
            print $grade."학년 급식비 : 3만원";
            break;
        case 2 : 
            print $grade."학년 급식비 : 3만5천원";
            break;
        case 3 : 
            print $grade."학년 급식비 : 4만원";
            break;
        case 4 : 
            print $grade."학년 급식비 : 4만5천원";
            break;
        case 5 : 
            print $grade."학년 급식비 : 5만원";
            break;
        case 6 : 
            print $grade."학년 급식비 : 5만5천원";
            break;
        default: 
            print $grade."학년이 잘못입력되었어요!";
            break;
    }
?>