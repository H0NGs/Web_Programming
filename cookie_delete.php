<?php
    setcookie("userid","", time() - 3600);
    setcookie("username","", time() - 3600);
    {
        echo "userid와 username 쿠키가 삭제되었다!";
    }
?>