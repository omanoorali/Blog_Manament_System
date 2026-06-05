<?php
require_once __DIR__ . '/../models/Post.php';


if (isset($_REQUEST['id'])) {
    
    $id = $_REQUEST['id'];

    // Model ka object banayein
    $inner_data = new post_model();
    
    $inner_post_data = $inner_data->inner_page($id);

    if ($inner_post_data && mysqli_num_rows($inner_post_data) > 0) {
        $post_detail = mysqli_fetch_assoc($inner_post_data);

        $author_name = $post_detail['author_name'];
        $category_name = $post_detail['category_name'];
        $feature_image = $post_detail['feature_image'];
        $create_at = $post_detail['create_at'];
        $title = $post_detail['title'];
        $content = $post_detail['content'];
       
        
    } else {
        $post_detail = null;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Blog Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f8fafc;
    font-family:Arial,sans-serif;
}

.blog-wrapper{
    max-width:900px;
    margin:60px auto;
}

.featured-image{
    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:16px;
}

.category-badge{
    display:inline-block;
    background:#2563eb;
    color:#fff;
    padding:8px 16px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
    margin-top:25px;
}

.post-title{
    font-size:42px;
    font-weight:700;
    line-height:1.2;
    margin:20px 0;
}

.post-meta{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    color:#64748b;
    margin-bottom:30px;
}

.post-content{
    background:#fff;
    padding:40px;
    border-radius:16px;
    box-shadow:0 5px 25px rgba(0,0,0,.05);
}

.post-content p{
    line-height:1.9;
    color:#475569;
    margin-bottom:20px;
}

.post-content h2{
    margin:35px 0 15px;
    font-weight:700;
}

.tags{
    margin-top:30px;
}

.tags a{
    text-decoration:none;
    background:#eef2ff;
    color:#2563eb;
    padding:8px 14px;
    border-radius:30px;
    margin-right:10px;
}

.post-navigation{
    margin-top:40px;
    display:flex;
    justify-content:space-between;
    gap:20px;
}

.nav-box{
    flex:1;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

.comments{
    margin-top:50px;
}

.comment-box{
    background:#fff;
    padding:20px;
    border-radius:12px;
    margin-bottom:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

</style>
</head>
<body>

<div class="container">




    <div class="blog-wrapper">

        <!-- Featured Image -->
        <img
            src="../uploads/<?php echo $feature_image?>"
            class="featured-image"
            alt="Blog Image"
        >

        <!-- Category -->
        <span class="category-badge">
            <?php echo $category_name;?>
        </span>

        <!-- Title -->
        <h1 class="post-title">
            <?php echo $title;?>
        </h1>

        <!-- Meta -->
        <div class="post-meta">
            <span><?php echo $author_name;?></span>
            <span><?php echo $create_at; ?></span>
        </div>

        <!-- Content -->
        <div class="post-content">

            <p>
            <?php echo $content;?>
            </p>

            

            

        </div>

 <a href="../index.php"><span class="category-badge">
            Back
        </span></a>

    </div>


</div>

</body>
</html>