<?php

require_once "../../models/Post.php";

$get_users = new post_model();
$result = $get_users->authanticated();
$categories =  $get_users->categories();


// get id from url

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sigle_post = new post_model();
    $single_Result =  $sigle_post->get_single_post($id);

    if ($single_Result) {
        $user_id = $single_Result['user_id'];
        $catergory_id = $single_Result['category_id'];
        $title = $single_Result['title'];
        $content = $single_Result['content'];
        $feature_image = $single_Result['feature_image'];
        $published_at_id = $single_Result['published_at'];
        $post_id = $single_Result['id'];
    }
}


// updated operraiton

if (isset($_POST['update_post'])) {
    $user_id = $_POST['user_id'];
    $catergory_id = $_POST['category_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at']; 
    $post_id = $_POST['post_id'];      



$feature_image = isset($_POST['old_image']) ? $_POST['old_image'] : '';

    if (isset($_FILES['feature_image']) && is_array($_FILES['feature_image']) && $_FILES['feature_image']['error'] == 0) {
        $feature_image = $_FILES['feature_image']['name'];
        move_uploaded_file($_FILES['feature_image']['tmp_name'], "../../uploads/" . $feature_image);
    }

        $update_post = new post_model();
        $results = $update_post->update($user_id,$catergory_id,$title,$content, $feature_image,$published_at,$post_id);

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

                        <form action="edit.php" method="POST" enctype="multipart/form-data">


                            <input type="hidden" name="post_id" value="<?php echo isset($post_id) ? $post_id : '' ?>">
                            <!-- Author -->
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">Select Author</option>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>" <?php echo ($user_id == $row['id']) ? 'selected' : ''; ?>>
                                            <?php echo $row['name']; ?>

                                        </option>
                                    <?php }  ?>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($categories)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>" <?php echo ($catergory_id == $data['id']) ? 'selected' : ''; ?>>
                                            <?php echo $data['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label">Post Title</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="<?php echo isset($title) ? $title : '' ?>"
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
                                    required><?php echo isset($content) ? $content : '' ?></textarea>
                            </div>

                            <!-- Featured Image -->
                            <div class="space-y-1.5">
                                <label for="feature_image" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Image Upload
                                </label>

                                <div class="relative group">
                                    <img src="../../uploads/<?php echo isset($feature_image) ? $feature_image : ''; ?>"
                                        alt="feature imagee"
                                        style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">

                                    <input type="hidden" name="old_image" value="<?php echo isset($feature_image) ? $feature_image : ''; ?>">


                                    <input type="file" id="feature_image" name="feature_image" accept="image/*"
                                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl px-4 py-3 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer">
                                </div>
                            </div>


                            <!-- published_at -->
                            <div class="mb-3">
                                <label class="form-label">published_at</label>
                                <select name="published_at" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="0" <?php echo (isset($published_at_id) && $published_at_id == '0') ? 'selected' : ''; ?>>Draft</option>

                                    <option value="1" <?php echo (isset($published_at_id) && $published_at_id == '1') ? 'selected' : ''; ?>>Published</option>
                                </select>
                            </div>


                            <button
                                type="submit"
                                name="update_post"
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