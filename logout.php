<?php
session_start();
unset($_Session['user_name']);
unset($_Session['user_id']);
unset($_Session['email']);
session_destroy();
header('Location: index.php');
?>
<!--  -->
