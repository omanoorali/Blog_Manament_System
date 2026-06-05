<?php

require_once "../../models/Post.php";

$get_users = new post_model();
$result = $get_users->authanticated();
$categories =  $get_users->categories();



// insert operraiton

if (isset($_POST['create_post'])) {
    $user_id = $_POST['user_id'];
    $catergory_id = $_POST['category_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];    
    
    
    
   $feature_image = null; 

    if (isset($_FILES['feature_image']) && is_array($_FILES['feature_image']) && $_FILES['feature_image']['error'] == 0) {
        $feature_image = $_FILES['feature_image']['name'];
        move_uploaded_file($_FILES['feature_image']['tmp_name'], "../../uploads/" . $feature_image);
    }

        $insert_post = new post_model();
        $results = $insert_post->create($user_id,$catergory_id,$title,$content, $feature_image,$published_at);

        if($results){
             header("location:index.php");
        }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Create Category</h3>
                    </div>

                    <div class="card-body">

                        <form action="create.php" method="POST" enctype="multipart/form-data">

                            <!-- Author -->
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">Select Author</option>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?> </option>
                                    <?php }  ?>

                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php

                                    while ($data = mysqli_fetch_assoc($categories)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name'] ?></option>

                                    <?php  } ?>
                                </select>
                            </div>

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">Post Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    placeholder="Enter post title"
                                    required>
                            </div>


                            <!-- Content -->
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea
                                    name="content"
                                    rows="8"
                                    class="form-control"
                                    placeholder="Write your post content..."
                                    required></textarea>
                            </div>

                            <!-- Featured Image -->
                            <div class="mb-3">
                                <label class="form-label">Featured Image</label>
                                <input
                                    type="file"
                                    name="feature_image"
                                    class="form-control"
                                    accept="image/*">
                            </div>

                            <!-- published_at -->
                            <div class="mb-3">
                                <label class="form-label">published_at</label>
                                <select name="published_at" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="0">Draft</option>
                                    <option value="1">Published</option>
                                </select>
                            </div>


                            <button
                                type="submit"
                                name="create_post"
                                class="btn btn-primary">
                                Create Post
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>