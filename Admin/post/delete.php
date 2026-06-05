<?php
require_once "../../models/Post.php";

if(isset($_REQUEST['id'])){
    $id  = $_REQUEST['id'];

    $delete_post = new post_model();
    $result = $delete_post->delete($id);
    if($result){
        header("location:index.php");
    }
}


?>