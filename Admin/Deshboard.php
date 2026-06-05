<?php 


require_once "../models/Post.php";

$user = new post_model();
$user_data  = $user->get_users_deshboard();


$post = new post_model();
$post__catgory  = $post->get_category_deshboard();




?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blog Management System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom Premium CSS Styling -->
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-light: #f8fafc;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0f172a;
            color: #94a3b8;
            transition: all 0.3s ease;
            z-index: 1000;
            border-right: 1px solid #1e293b;
        }

        .sidebar-brand {
            padding: 24px;
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-menu-item {
            padding: 2px 20px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            font-size: 1.2rem;
            margin-right: 12px;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #1e293b;
            color: #ffffff;
        }

        .sidebar-link.active {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .sidebar-link.active i {
            color: #ffffff;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 15px 30px;
            box-shadow: var(--card-shadow);
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
        }

        /* Quick Stats Cards */
        .stats-card {
            background: #ffffff;
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
            position: relative;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .stats-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Icon Colors & Backgrounds */
        .bg-users { background-color: rgba(79, 70, 229, 0.1); color: #4f46e5; }
        .bg-posts { background-color: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
        .bg-categories { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }
        .bg-comments { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }

        /* Dashboard Tables */
        .custom-card {
            background: #ffffff;
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow);
            padding: 24px;
            margin-bottom: 30px;
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px;
        }

        .table-custom tbody td {
            padding: 14px;
            vertical-align: middle;
            color: #334155;
            font-size: 0.9rem;
        }

        /* Action Buttons */
        .action-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .main-content.active {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR NAVIGATION -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-rocket-takeoff-fill me-2 text-primary"></i>
            <span>Admin Control Panel</span>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="Deshboard.php" class="sidebar-link active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="user/index.php" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="role/index.php" class="sidebar-link">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>User Roles</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="category/index.php" class="sidebar-link">
                    <i class="bi bi-tags-fill"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="post/index.php" class="sidebar-link">
                    <i class="bi bi-file-earmark-post"></i>
                    <span>Manage Posts</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="comments/index.php" class="sidebar-link">
                    <i class="bi bi-chat-left-quote-fill"></i>
                    <span>Comments</span>
                </a>
            </li>
            <hr class="border-secondary my-3 mx-3">
            <li class="sidebar-menu-item">
                <a href="../index.php" class="sidebar-link text-danger">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Exit to Blog</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN DASHBOARD CONTENT AREA -->
    <div class="main-content" id="main-content">
        
        <!-- Top Navbar Row -->
        <div class="top-navbar">
            <button class="btn btn-light d-lg-none" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="d-none d-md-block">
                <h4 class="mb-0 fw-bold">System Dashboard Overview</h4>
                <p class="text-muted small mb-0">Manage everything about your website from here.</p>
            </div>
            
            <!-- Admin User Details Dropdown -->
            <div class="dropdown">
                <a href="#" class="user-profile-btn dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../uploads/default_admin.png" alt="Admin" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;" class="border">
                    <span class="d-none d-sm-inline">System Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="user/edit.php"><i class="bi bi-person me-2"></i>My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-power me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- STATS OVERVIEW CARD ROW -->
        <!-- <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fw-semibold small mb-1 text-uppercase tracking-wider">Total Active Users</p>
                            <h3 class="fw-bold mb-0 text-slate-800">128</h3>
                        </div>
                        <div class="stats-icon-box bg-users">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fw-semibold small mb-1 text-uppercase tracking-wider">Published Posts</p>
                            <h3 class="fw-bold mb-0 text-slate-800">1,245</h3>
                        </div>
                        <div class="stats-icon-box bg-posts">
                            <i class="bi bi-file-earmark-post-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fw-semibold small mb-1 text-uppercase tracking-wider">Post Categories</p>
                            <h3 class="fw-bold mb-0 text-slate-800">14</h3>
                        </div>
                        <div class="stats-icon-box bg-categories">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted fw-semibold small mb-1 text-uppercase tracking-wider">New Comments</p>
                            <h3 class="fw-bold mb-0 text-slate-800">482</h3>
                        </div>
                        <div class="stats-icon-box bg-comments">
                            <i class="bi bi-chat-left-quote-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- QUICK ACTIONS BAR -->
        <div class="custom-card mb-4">
            <h5 class="fw-bold mb-3 text-secondary"><i class="bi bi-lightning-charge-fill text-warning me-1"></i> Quick Action Tools</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="post/create.php" class="btn btn-outline-primary rounded-pill px-3 py-2"><i class="bi bi-plus-lg me-1"></i> Write New Post</a>
                <a href="user/create.php" class="btn btn-outline-primary rounded-pill px-3 py-2"><i class="bi bi-person-plus me-1"></i> Add System User</a>
                <a href="category/create.php" class="btn btn-outline-primary rounded-pill px-3 py-2"><i class="bi bi-folder-plus me-1"></i> Add Category</a>
                <a href="role/create.php" class="btn btn-outline-primary rounded-pill px-3 py-2"><i class="bi bi-shield-plus me-1"></i> Add New Role</a>
            </div>
        </div>

        <!-- RECENT POSTS AND RECENT USERS ROW -->
        <div class="row g-4">
            
            <!-- Left Side: Recent Active Users -->
            <div class="col-lg-6">
                <div class="custom-card h-100">
                    <div class="card-header-flex">
                        <h5 class="fw-bold mb-0 text-slate-800"><i class="bi bi-people-fill text-indigo-500 me-2"></i>Recent Users Activity</h5>
                        <a href="user/index.php" class="btn btn-sm btn-link text-decoration-none">View All</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email ID</th>
                                    <th>Assigned Role</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                            
                            while($result = mysqli_fetch_assoc($user_data)){
                            ?>
                                <!-- Mock Data Template - Use PHP while-loop here -->
                                <tr>
                                    <td class="d-flex align-items-center gap-3">
                                        <img src="../uploads/<?php echo $result['profile_image']?>" alt="" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                        <span class="fw-semibold"><?php echo $result['name']?></span>
                                    </td>
                                    <td><?php echo $result['email']?></td>
                                    <td><span class="badge bg-danger rounded-pill px-2.5 py-1.5 text-uppercase"><?php echo $result['user_role']?></span></td>
                                </tr>
                                <?php }   ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Side: Recent Published Posts -->
            <div class="col-lg-6">
                <div class="custom-card h-100">
                    <div class="card-header-flex">
                        <h5 class="fw-bold mb-0 text-slate-800"><i class="bi bi-file-earmark-post-fill text-info me-2"></i>Recent Published Articles</h5>
                        <a href="post/index.php" class="btn btn-sm btn-link text-decoration-none">View All</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Mock Data Template - Use PHP while-loop here -->

                                <?php 
                            
                            while($result = mysqli_fetch_assoc($post__catgory)){
                            ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo $result['title'];?></td>
                                    <td><span class="text-primary font-bold"><?php echo $result['category_name'];?></span></td>
                                    <td><?php echo $result['create_at'];?></td>
                                </tr>
<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- /.row -->

    </div> <!-- /.main-content -->

    <!-- Bootstrap 5 Bundle JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Mobile Toggle JavaScript -->
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('active');
            });
        }
    </script>
</body>

</html>