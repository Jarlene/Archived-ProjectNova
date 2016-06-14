<?php
  // in this var you will get the absolute file path of the current file
  $ROOT_DIR = dirname(__FILE__);
  // with the next line we will include the 'somefile.php'
  // which based in the upper directory to the current path
  // include(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'somefile.php');
  $HEADFILES_DIR = ROOT_DIR.DIRECTORY_SEPARATOR.'.'.DIRECTORY_SEPARATOR.'headfiles'.DIRECTORY_SEPARATOR;
  echo $HEADFILES_DIR;

?>
