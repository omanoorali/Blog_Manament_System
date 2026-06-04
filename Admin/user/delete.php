<?php
require_once "../../models/User.php";

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $user_delete = new User();
    $result = $user_delete->delete($id);
    
    if($result){
        // Data delete hone ke baad automatic users list (index.php) par bhejne ke liye:
        header("Location: index.php");
        exit();
    } else {
        echo "Data delete karne mein koi masla aaya.";
    }
}
?>