|



<?php
// Top par model call karein
require_once "../../models/User.php";
require_once "../../models/Role.php";


$role = new model_role();
$results = $role->get_all_roles();



// $query = "SELECT * FROM role";
//     $result = mysqli_query($this->db, $query);

//     var_dump($result);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['profile_dropdown'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number = $_POST['phone_number'];
    $profile_image = "default.png"; // Default image agar user select na kare
    if (isset($_FILES['profile_image']) && is_array($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = $_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "../../uploads/" . $profile_image);
    }

    $userObj = new User();
    if ($userObj->create($name, $email, $password, $phone_number, $profile_image,$role_id)) {
        echo "<script>alert('User Created Successfully!');</script>";
    } else {
        echo "<script>alert('Database Error: Data could not be saved.');</script>";
    }
}
?>














<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogify - Create User Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons for Beautiful Visuals -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-y-auto">

    <!-- Ambient background glows -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

    <!-- Main Interactive Card -->
    <div class="w-full max-w-lg bg-white rounded-3xl border border-slate-100 shadow-2xl shadow-indigo-100/40 p-6 sm:p-10 relative z-10">

        

        <!-- Form -->
        <form method="POST" id="createUserForm" class="space-y-5" enctype="multipart/form-data">

            <!-- Full Name Input Group -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Full Name</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                        <i class="fa-regular fa-user text-sm"></i>
                    </span>
                    <input type="text" id="name" name="name" placeholder=""
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl pl-11 pr-4 py-3.5 text-sm text-slate-800 placeholder-slate-400 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                </div>
            </div>

            <!-- Email Input Group -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Email Address</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                        <i class="fa-regular fa-envelope text-sm"></i>
                    </span>
                    <input type="email" id="userEmail" name="email" placeholder="ahmad@blogify.com"
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl pl-11 pr-4 py-3.5 text-sm text-slate-800 placeholder-slate-400 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                </div>
            </div>

            <!-- Password Input Group -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Security Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input type="password" id="userPassword" name="password" placeholder="••••••••"
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl pl-11 pr-12 py-3.5 text-sm text-slate-800 placeholder-slate-400 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                    <!-- Toggle Visibility Eye Button -->
                    <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-all duration-200">
                        <i id="passwordEye" class="fa-regular fa-eye text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- phone number -->
            <div class="space-y-1.5">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">phone number </label>
                <div class="relative group">
                    <input type="text" id="phone_number" name="phone_number" placeholder="9203124547845"
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl pl-11 pr-4 py-3.5 text-sm text-slate-800 placeholder-slate-400 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="profile_image" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    Image Upload
                </label>
                <div class="relative group">
                    <input type="file" id="profile_image" name="profile_image" accept="image/*"
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl px-4 py-3 text-sm text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="profile_dropdown" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    Assign User Role
                </label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                        <i class="fa-solid fa-user-shield text-sm"></i>
                    </span>

                    <select id="profile_dropdown" name="profile_dropdown" 
                        class="w-full bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:bg-white rounded-2xl pl-11 pr-10 py-3.5 text-sm text-slate-600 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 cursor-pointer appearance-none">
                        <option value="" disabled selected>Ek option select karein</option>
                        <?php while ($roles = mysqli_fetch_assoc($results)) { ?>
                            <option value="<?php echo $roles['id']; ?>">
                                <?php echo ucfirst($roles['role_name']); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>

            


            <!-- Action buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit" name="submit"
                    class="w-2/3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm py-3.5 rounded-2xl transition duration-200 shadow-xl shadow-indigo-600/20 hover:shadow-indigo-500/30 active:scale-[0.98]">
                    Register Profile
                </button>
            </div>

        </form>
    </div>
</body>

</html>