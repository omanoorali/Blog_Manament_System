<?php

require_once  "../../models/Post.php";


$show_all_posts =  new post_model();
$post_result = $show_all_posts->get_all_posts();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Roles Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }

        .table-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 50px;
        }

        .table-title {
            color: #212529;
            font-weight: 600;
            margin-bottom: 0;
            /* Flex alignment ke liye margin 0 kiya */
        }

        /* Customizing the table header */
        .table thead th {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #dee2e6;
            padding: 15px;
        }

        /* Aligning items vertically in cells */
        .table tbody td,
        .table tbody th {
            vertical-align: middle;
            padding: 15px;
            color: #495057;
        }

        /* Hover effect on rows */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        /* Custom Badges for Roles */
        .badge-admin {
            background-color: #ea580c;
            color: #fff;
        }

        .badge-editor {
            background-color: #0284c7;
            color: #fff;
        }

        .badge-viewer {
            background-color: #64748b;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="table-container">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="table-title">
                            <i class="bi bi-shield-lock-fill me-2 text-primary"></i>Post Management
                        </h3>
                        <a href="create.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="bi bi-person-plus-fill me-2"></i>Add New Post
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 12%;">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Feature Image</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">created by</th>

                                    <th scope="col" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>



                                <?php
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($post_result)) {
                                ?>
                                    <tr>
                                        <th scope="row"> <?php echo $count++;?></th>
                                        <td class="fw-semibold"><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['content']; ?></td>
                                        <td>
                                            <img src="../../uploads/<?php echo $row['feature_image']; ?>"
                                                alt="feature_image "
                                                style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;" class="border shadow-sm">
                                        </td>


                                        <td><?php echo ($row['published_at']==1)? "published":'draft' ; ?></td>

                                        <td class="fw-semibold"><?php echo $row['user_name']; ?></td>

                                        <td class="text-end">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');">
                                                <i class="bi bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>