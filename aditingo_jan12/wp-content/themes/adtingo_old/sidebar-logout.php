<?php
session_start();
session_destroy();
header("location:".get_page_link(12)."?mes=log");
exit;
?>