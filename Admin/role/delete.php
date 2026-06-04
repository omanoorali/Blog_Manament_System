<?php

require_once "../../models/Role.php";

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

    $delete = new model_role();
    $result =$delete->delete($id);

    if($result){
        header("location:index.php");
    }

}


?>
