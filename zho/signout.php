<?php
SetCookie('user', null, -1, '/');
SetCookie('lang', 'zho', time()+3600, '/');
header("Location: index.php");
die();
?>
