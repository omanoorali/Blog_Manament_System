<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogify - Premium Admin Portal</title>
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
        /* Glassmorphism custom effects */
        .glass-panel {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        /* Custom floating glow animations */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }
        .animate-float-1 {
            animation: float-slow 8s ease-in-out infinite;
        }
        .animate-float-2 {
            animation: float-slow 12s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
</head>
<body class="h-full overflow-hidden text-slate-100 flex items-center justify-center relative p-4 sm:p-6 lg:p-8">

    <!-- Ambient Backdrop Glow Shapes -->
    <div class="absolute top-1/4 left-1/4 w-72 sm:w-96 h-72 sm:h-96 bg-indigo-600/20 rounded-full blur-[100px] animate-float-1 pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 sm:w-[450px] h-80 sm:h-[450px] bg-violet-600/15 rounded-full blur-[120px] animate-float-2 pointer-events-none"></div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

    <!-- Main Interactive Wrapper -->
    <div class="w-full max-w-5xl h-full max-h-[640px] rounded-3xl overflow-hidden shadow-2xl shadow-indigo-950/40 grid grid-cols-1 md:grid-cols-12 glass-panel z-10 animate-fade-in relative">
        
        <!-- BACK TO HOME UTILITY BUTTON -->
        <a href="index.php" class="absolute top-6 left-6 z-30 flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white bg-slate-900/60 hover:bg-slate-900 border border-slate-800 hover:border-slate-700 px-4 py-2.5 rounded-full transition-all duration-200">
            <i class="fa-solid fa-arrow-left"></i> Back to Feed
        </a>

        <!-- LEFT SIDE: Aesthetic Info Section (Hidden on Mobile) -->
        <div class="hidden md:flex md:col-span-5 bg-gradient-to-br from-indigo-950 via-slate-950 to-slate-900 p-10 flex-col justify-between relative overflow-hidden border-r border-white/5">
            <!-- Background Mesh Details -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-30"></div>
            
            <div></div> <!-- Space placeholder -->

            <!-- Branding Core -->
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-xl shadow-indigo-500/25">
                    <i class="fa-solid fa-feather-pointed text-2xl animate-pulse"></i>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-extrabold tracking-tight bg-gradient-to-r from-white via-slate-100 to-indigo-200 bg-clip-text text-transparent">
                        Empowering Creators
                    </h2>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Access Blogify Studio to draft technical masterpieces, monitor live reader metrics, and curate the visual homepage.
                    </p>
                </div>
            </div>

            <!-- Footer Meta or Quote -->
            <div class="relative z-10 glass-card p-4 rounded-2xl">
                <p class="text-xs text-slate-300 italic leading-relaxed">
                    "This dashboard manages real-time caching and dynamic rendering optimization pipelines automatically."
                </p>
                <span class="block text-[10px] font-bold uppercase tracking-wider text-indigo-400 mt-2">— Blogify Dev Engine</span>
            </div>
        </div>

        <!-- RIGHT SIDE: Login Core form -->
        <div class="col-span-1 md:col-span-7 p-6 sm:p-12 lg:p-16 flex flex-col justify-center relative">
            <div class="max-w-md w-full mx-auto space-y-8">
                <!-- Header -->
                <div class="space-y-2">
                    <div class="md:hidden flex items-center gap-2.5 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white"><i class="fa-solid fa-feather-pointed"></i></div>
                        <span class="text-lg font-bold tracking-tight text-white">Blogify Portal</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Welcome Back</h1>
                    <p class="text-xs sm:text-sm text-slate-400">Enter your authorized administrative credentials to begin edit sessions.</p>
                </div>

                <!-- Form -->
                <form id="standaloneLoginForm" onsubmit="handlePortalSubmit(event)" class="space-y-5">
                    <!-- Email input group -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-slate-400">Security Email Address</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                                <i class="fa-regular fa-envelope text-sm"></i>
                            </span>
                            <input type="email" id="loginEmail" required placeholder="admin@blogify.com" 
                                class="w-full bg-slate-900/60 border border-slate-800 focus:border-indigo-500 rounded-2xl pl-11 pr-4 py-3.5 text-sm text-white placeholder-slate-500 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                        </div>
                    </div>

                    <!-- Password input group -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center">
                            <label class="block text-xs font-semibold text-slate-400">Secret Password</label>
                            <a href="#" onclick="createToast('Password recovery options are restricted to on-premise admin consoles.', 'warning')" class="text-xs text-indigo-400 hover:text-indigo-300 transition">Forgot?</a>
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                                <i class="fa-solid fa-lock text-sm"></i>
                            </span>
                            <input type="password" id="loginPassword" required placeholder="••••••••" 
                                class="w-full bg-slate-900/60 border border-slate-800 focus:border-indigo-500 rounded-2xl pl-11 pr-12 py-3.5 text-sm text-white placeholder-slate-500 outline-none focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200">
                            <!-- Show Hide Button -->
                            <button type="button" onclick="togglePasswordInput()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-slate-300 transition">
                                <i id="passwordEye" class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Credentials Helper Widget -->
                    <div class="glass-card p-3 rounded-2xl border border-indigo-500/10 flex gap-3 items-start text-xs text-slate-300 leading-relaxed">
                        <i class="fa-solid fa-circle-info text-indigo-400 mt-0.5 text-base flex-shrink-0"></i>
                        <div>
                            <span class="font-bold text-white block mb-0.5">Quick Demo Credentials:</span>
                            <div class="space-y-0.5 text-[11px] text-slate-400">
                                <div>Email: <span class="text-slate-200 font-mono select-all font-semibold">admin@blogify.com</span></div>
                                <div>Password: <span class="text-slate-200 font-mono select-all font-semibold">admin123</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Remember me / Actions -->
                    <div class="flex items-center justify-between text-xs text-slate-400">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" checked class="rounded border-slate-800 bg-slate-950 text-indigo-600 focus:ring-0 w-4 h-4">
                            <span>Keep me signed in</span>
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold text-sm py-3.5 rounded-2xl transition duration-300 shadow-xl shadow-indigo-600/10 hover:shadow-indigo-500/20 active:scale-[0.98]">
                        Verify Identity
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT SYSTEM LOGIC -->
    <script>
        // Form submission handling
        function handlePortalSubmit(event) {
            event.preventDefault();
            
            const emailInput = document.getElementById('loginEmail').value.trim();
            const passwordInput = document.getElementById('loginPassword').value;

            // Validate against administrative credentials
            if (emailInput === "admin@blogify.com" && passwordInput === "admin123") {
                // Set authenticated admin status in storage
                localStorage.setItem('blogify_isAdmin', JSON.stringify(true));
                createToast("Access Granted! Redirecting to Blogify feed...", "success");

                // Simulate processing delays for authentication
                setTimeout(() => {
                    window.location.href = "index.html";
                }, 1500);
            } else {
                createToast("Access Denied! Check input values or see Demo helper block.", "warning");
            }
        }

        // Toggle password visibility functionality
        function togglePasswordInput() {
            const passwordField = document.getElementById('loginPassword');
            const eyeIcon = document.getElementById('passwordEye');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.className = "fa-regular fa-eye-slash text-sm";
            } else {
                passwordField.type = "password";
                eyeIcon.className = "fa-regular fa-eye text-sm";
            }
        }

        // Custom Toast system replacing generic alerts
        function createToast(message, type = "info") {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            
            // Build dynamic classes
            toast.className = "flex items-center gap-3 px-4 py-3.5 rounded-2xl shadow-2xl border text-xs font-semibold transform translate-y-4 opacity-0 transition duration-300 pointer-events-auto w-full max-w-sm bg-slate-900/90 backdrop-blur-md";
            
            let icon = '<i class="fa-solid fa-circle-info text-blue-400"></i>';
            let border = "border-slate-800/80 text-slate-200";
            
            if (type === "success") {
                icon = '<i class="fa-solid fa-circle-check text-emerald-400"></i>';
                border = "border-emerald-500/20 text-slate-100";
            } else if (type === "warning") {
                icon = '<i class="fa-solid fa-circle-exclamation text-amber-400"></i>';
                border = "border-amber-500/20 text-slate-100";
            }

            toast.innerHTML = `
                <div class="flex-shrink-0 text-base">${icon}</div>
                <div class="flex-grow">${message}</div>
                <button class="text-slate-400 hover:text-white ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            
            toast.className += ` ${border}`;
            container.appendChild(toast);

            // Animate entrance
            setTimeout(() => {
                toast.classList.replace('translate-y-4', 'translate-y-0');
                toast.classList.replace('opacity-0', 'opacity-100');
            }, 10);

            // Automated sliding exit
            setTimeout(() => {
                toast.classList.replace('translate-y-0', 'translate-y-4');
                toast.classList.replace('opacity-100', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    </script>
</body>
</html>


