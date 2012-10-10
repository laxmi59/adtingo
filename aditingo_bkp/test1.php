<?php
session_start();
echo "testval".$_SESSION['testval'];
print_r($_SESSION);
?>