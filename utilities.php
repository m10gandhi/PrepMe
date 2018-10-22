<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function logout_from_app()
{
    // remove all session variables
    session_unset();
    session_destroy();
    header("Location: index.php");
}
?>

<!--  -->
