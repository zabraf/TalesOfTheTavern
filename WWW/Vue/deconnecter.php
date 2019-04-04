<?php
session_start();
if(isset($_SESSION["utilisateur"]))
{
    session_destroy();
}
header("Location: index.php");
exit();