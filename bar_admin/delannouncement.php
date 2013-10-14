<?php
session_start();
require_once('connectvars.php');
require_once('connectdatabase.php');
$id  = -1;
if(isset($_SESSION['user_id'])){
    if( isset($_GET['id']) && $_SESSION['user_id'] == 'sunny' ){
      $id = $_GET['id'];
    }
}

$query = "DELETE FROM announcement WHERE id = '$id '";
mysqli_query($dbc, $query);
header('Location: ../index.php');

?>