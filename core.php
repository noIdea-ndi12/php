<?php
    define('USER_DB','nuitinfo');
    define('PASS_BD','75urp7f8cpmmnzC3');
    define('SERVER','88.191.117.164');   
    define('DATABASE','nuitinfo');
    
    mysql_connect(SERVER, USER_DB, PASS_BD) or die ('creve1');
    mysql_select_db(DATABASE) or die('creve2');
?>

