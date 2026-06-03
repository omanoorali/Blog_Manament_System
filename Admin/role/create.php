<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Role - Blogify Admin</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons for Beautiful UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-hidden bg-slate-900">

    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md z-10">
        <!-- Back Link / Breadcrumb -->
        <a href="../Dashboard.php" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-all duration-200 mb-6 group">
            <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i> Back to Dashboard
        </a>

        <!-- Main Form Container -->
        <div class="bg-slate-800/80 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 sm:p-8 shadow-2xl relative">

            <!-- Header Brand & Title -->
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white mx-auto mb-4 shadow-lg shadow-indigo-500/20">
                    <i class="fa-solid fa-user-shield text-xl animate-pulse"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-white tracking-tight">Create New Role</h2>
                <p class="text-slate-400 text-xs mt-1.5">Define user access permissions for your application</p>
            </div>

            <!-- Error and Success Notifications (PHP Integrated) -->
            <?php if (!empty($message)): ?>
                <div class="mb-5 flex items-start gap-3 bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-400 animate-fade-in text-sm">
                    <i class="fa-solid fa-circle-check text-base mt-0.5"></i>
                    <div>
                        <span class="font-bold">Success!</span>
                        <p class="text-xs text-emerald-400/80 mt-0.5"><?php echo $message; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="mb-5 flex items-start gap-3 bg-rose-500/10 border border-rose-500/20 rounded-xl p-4 text-rose-400 animate-fade-in text-sm">
                    <i class="fa-solid fa-triangle-exclamation text-base mt-0.5"></i>
                    <div>
                        <span class="font-bold">Error Occurred!</span>
                        <p class="text-xs text-rose-400/80 mt-0.5"><?php echo $error; ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="create.php" method="POST" class="space-y-6">

                <!-- Input Group -->
                <div class="space-y-2">
                    <label for="role_name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">
                        Role Name
                    </label>
                    <div class="relative">
                        <!-- Icon Inside Input -->
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                            <i class="fa-solid fa-id-card-clip text-sm"></i>
                        </span>
                        <input
                            type="text"
                            id="role_name"
                            name="role_name"
                            placeholder="e.g., Admin, Author, Editor"
                            class="w-full bg-slate-900/50 border border-slate-700 text-white placeholder-slate-500 text-sm rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all duration-300"
                            required>
                    </div>
                    <span class="block text-[10px] text-slate-500 leading-normal">
                        Use descriptive singular nouns. Best practice is capitalized letters.
                    </span>
                </div>

                <!-- Action Button -->
                <button
                    type="submit"
                    name="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm py-3.5 rounded-xl transition duration-300 shadow-lg shadow-indigo-600/20 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i> Save New Role
                </button>
            </form>

            <!-- Card Footer / Tip -->
            <div class="mt-6 pt-5 border-t border-slate-700/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-slate-700/30 flex items-center justify-center text-indigo-400">
                    <i class="fa-regular fa-lightbulb text-sm"></i>
                </div>
                <p class="text-[11px] text-slate-400 leading-normal">
                    Roles defined here will immediately become available inside the <span class="text-indigo-400">User Management</span> panel.
                </p>
            </div>

        </div>

        <!-- Copyright / Logo Footer -->
        <p class="text-center text-[10px] text-slate-500 mt-6">
            © 2026 Blog  Admin Panel. Protected by ACL.
        </p>
    </div>

</body>

</html>

<?php
 
 require_once  "../../models/Role.php";
 
if (isset($_POST['submit'])) {
    $role_name = $_POST['role_name'];
    // echo $role;
    $role = new model_role();
    if ($role->create($role_name)) {
        echo "user create";
    }
}


?>