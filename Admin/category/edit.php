<?php
require_once "../../models/Category.php";




// first get id from url/ query paramerte  and send to back for get daata 

if (isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];

    $get_sigle = new category_model();
    $result = $get_sigle->get_signle_cat($id);

    if ($result) {
        $name = $result['name'];
        $descrption = $result['descrption'];
        $status = $result['status'];
        $ids = $result['id'];
    }
}

if(isset($_POST['update'])){

   $name = $_POST['cate_name'];
   $description = $_POST['description'];
   $status = $_POST['status'];
   $id = $_POST['cate_id'];

   $catgory = new category_model();
   $result =$catgory->update($name,$description,$status,$id); 
   if($result){
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

                        <form action="edit.php" method="POST">

                        <input type="hidden" name="cate_id" value="<?php echo isset($ids)? $ids:''; ?>">

                            <!-- Category Name -->
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input
                                    type="text"
                                    name="cate_name"
                                    value="<?php echo isset($name) ? $name : '' ?>"
                                    class="form-control"
                                    placeholder="Enter category name"
                                    required>
                            </div>



                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter category description"><?php echo isset($descrption) ? $descrption : ''; ?></textarea>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="form-label">Status</label>

                                <select name="status" class="form-select" required>
                                    <option value="">Select Status</option>

                                    <option value="1" <?php echo (isset($status) && $status == '1') ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo (isset($status) && $status == '0') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    name="update"
                                    class="btn btn-primary">
                                    update Category
                                </button>


                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>