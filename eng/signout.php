<?php
SetCookie('user', null, -1, '/');
SetCookie('lang', 'eng', time()+3600, '/');
header("Location: index.php");
die();
?>
