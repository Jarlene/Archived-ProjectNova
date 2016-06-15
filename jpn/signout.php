<?php
SetCookie('user', null, -1, '/');
SetCookie('lang', 'jpn', time()+3600, '/');
header("Location: index.php");
die();
?>
