<?php require_once("../include/initialize.php"); ?>
<?php if($session->is_logged_in() === "false") { redirect_to("login.php"); } ?>
<?php $session->logout(); ?>
<?php redirect_to("login.php"); ?>