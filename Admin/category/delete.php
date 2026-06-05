<?php


require_once "../../models/Category.php";

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

    $delete_cat = new category_model();
    $result = $delete_cat->delete($id);
   if($result){
           header("location:index.php");

   }
}


?>