<?php
require_once "../../models/Category.php";



if(isset($_POST['create'])){

   $name = $_POST['cate_name'];
   $description = $_POST['description'];
   $status = $_POST['status'];

   $catgory = new category_model();
   $result =$catgory->create($name,$description,$status); 
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

                    <form action="create.php" method="POST">

                        <!-- Category Name -->
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input
                                type="text"
                                name="cate_name"
                                class="form-control"
                                placeholder="Enter category name"
                                required
                            >
                        </div>

                       

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Enter category description"
                            ></textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label">Status</label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button
                                type="submit"
                                name="create"
                                class="btn btn-primary"
                            >
                                Create Category
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