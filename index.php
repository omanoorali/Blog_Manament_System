<?php

require_once __DIR__ . '/models/Category.php';
require_once __DIR__ . '/models/Post.php';
// require_once __DIR__ . '/../models/User.php';
$catgory = new category_model();
$all_category = $catgory->get_all_cat();


// posts
// 1. Post Model ka object banayein
$post = new post_model();

// 2. Define karein ke ek page par kitni posts chahiye
$posts_per_page = 3;

// 3. URL se current page number lein (e.g., index.php?page=2), default 1 rakhein
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// 4. Object ($post) se sirf is page ki posts fetch karein
$all_posts = $post->get_all_home_post($current_page, $posts_per_page);

// 5. Object ($post) se total posts ka count lein
$total_posts = $post->get_total_posts_count();

// 6. Total pages calculate karein
$total_pages = ceil($total_posts / $posts_per_page)
?>








<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Modern Blog Management System</title>
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

        /* Custom scrollbar for premium feel */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

    <!-- HEADER / NAVIGATION -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <i class="fa-solid fa-feather-pointed text-lg"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent tracking-tight">Blog</span>
                </div>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden md:flex space-x-8 text-sm font-medium items-center">
                    <a href="#" class="text-indigo-600 hover:text-indigo-700 transition duration-150">Home</a>
                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition duration-150">About</a>

                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button id="categoryDropdownBtn" class="text-slate-600 hover:text-indigo-600 transition duration-150 flex items-center gap-1.5 focus:outline-none">
                            Categories
                            <i class="fa-solid fa-chevron-down text-[10px] group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-3 w-56 rounded-2xl bg-white border border-slate-100 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-2">
                            <a href="#" onclick="filterCategory('All')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> All Categories
                            </a>

                            <?php
                            while ($row = mysqli_fetch_assoc($all_category)) {
                            ?>
                                <a href="#" onclick="filterCategory()" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 rounded-xl transition">
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span> <?php echo htmlspecialchars($row['name']); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition duration-150">Contact Us</a>
                </nav>

                <!-- Search & Action Button -->
                <div class="hidden md:flex items-center gap-4">
                    
                    <a href="public/login.php">
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-5 py-2.5 rounded-full transition shadow-md shadow-indigo-100 flex items-center gap-2">
                            <i class="fa-solid fa-user-tie"></i> Login
                        </button>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-4">
                    <button id="mobileMenuBtn" class="text-slate-600 hover:text-indigo-600 focus:outline-none text-2xl">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-100 bg-white px-4 py-4 space-y-3 shadow-lg">
            <div class="relative mb-3">
                <input type="text" id="mobileSearchInput" placeholder="Search articles..." class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl py-2.5 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                <span class="absolute right-3 top-3.5 text-slate-400"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
            <a href="#" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-indigo-600">Home</a>
            <div class="px-3 py-2 font-medium text-slate-400 text-xs tracking-wider uppercase">Categories</div>
            <div class="grid grid-cols-2 gap-2 pl-3">
                <a href="#" onclick="filterCategory('Politics & Government')" class="py-1 text-sm text-slate-600 hover:text-indigo-600"><i class="fa-solid fa-circle text-[6px] text-red-500 mr-1"></i> Politics</a>
                <a href="#" onclick="filterCategory('Business & Finance')" class="py-1 text-sm text-slate-600 hover:text-indigo-600"><i class="fa-solid fa-circle text-[6px] text-emerald-500 mr-1"></i> Business</a>
                <a href="#" onclick="filterCategory('Technology')" class="py-1 text-sm text-slate-600 hover:text-indigo-600"><i class="fa-solid fa-circle text-[6px] text-blue-500 mr-1"></i> Tech</a>
                <a href="#" onclick="filterCategory('Sports')" class="py-1 text-sm text-slate-600 hover:text-indigo-600"><i class="fa-solid fa-circle text-[6px] text-orange-500 mr-1"></i> Sports</a>
                <a href="#" onclick="filterCategory('Entertainment')" class="py-1 text-sm text-slate-600 hover:text-indigo-600"><i class="fa-solid fa-circle text-[6px] text-purple-500 mr-1"></i> Showbiz</a>
            </div>
            <hr class="border-slate-100 my-2">
            <a href="#" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-50">About</a>
            <a href="#" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-slate-50">Contact</a>
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-xl transition flex items-center justify-center gap-2 mt-4">
                <i class="fa-solid fa-user-tie"></i> Login to Dashboard
            </button>
        </div>
    </header>





    <!-- MAIN BODY SECTION -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

        <!-- HERO / FEATURED NEWS CARD -->

        <!-- HERO / FEATURED NEWS CARD -->



        <?php
        // 1. Agar database mein posts hain, toh sirf SABSE PEHLA (bilkul current) post fetch karein
        if ($all_posts && mysqli_num_rows($all_posts) > 0) {
            $featured_post = mysqli_fetch_assoc($all_posts);
        ?>

            <div id="featuredSection" class="relative bg-slate-900 rounded-3xl overflow-hidden shadow-2xl mb-12 min-h-[400px] sm:min-h-[480px] flex items-end">

                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105"
                    style="background-image: url('uploads/<?php echo $featured_post['feature_image']; ?>');">
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>

                <div class="relative z-10 p-6 sm:p-10 md:p-12 max-w-3xl">

                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                        <?php echo htmlspecialchars($featured_post['title']); ?>
                    </h1>

                    <p class="text-slate-300 text-sm sm:text-base mb-6 line-clamp-2">
                        <?php echo htmlspecialchars($featured_post['content']); ?>
                    </p>

                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-400">

                        <div class="flex items-center gap-2">
                            <img src="uploads/<?php echo $featured_post['author_image']; ?>" alt="Author" class="w-8 h-8 rounded-full border border-indigo-500/30">
                            <span class="font-medium text-white"><?php echo htmlspecialchars($featured_post['author_name']); ?></span>
                        </div>

                        <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                        <span><i class="fa-regular fa-calendar-alt mr-1"></i> <?php echo $featured_post['create_at']; ?></span>

                    </div>
                </div>
            </div>

        <?php
        } // If condition ka end yahan ho raha hai
        ?>






        <!-- ACTIVE FILTER STATUS BAR -->
        <div id="filterStatus" class="hidden mb-6 flex items-center justify-between bg-indigo-50 border border-indigo-100 rounded-2xl px-5 py-3.5">
            <span class="text-indigo-800 text-sm font-medium">
                Showing articles for category: <span id="activeCategoryName" class="font-bold underline">None</span>
            </span>
            <button onclick="filterCategory('All')" class="text-xs bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-3 py-1.5 rounded-lg transition">
                Clear Filter <i class="fa-solid fa-xmark ml-1"></i>
            </button>
        </div>

        <!-- MAIN LAYOUT: POSTS GRID & SIDEBAR -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- LEFT AREA: BLOG POSTS LIST -->



            <div class="lg:col-span-2 space-y-8" id="postsContainer">
                <div class="lg:col-span-2 space-y-8" id="postsContainer">
                    <?php
                    // Check karein ke database se koi post mili bhi hai ya nahi
                    if (mysqli_num_rows($all_posts) > 0) {
                        while ($row = mysqli_fetch_assoc($all_posts)) {
                    ?>
                            <article class="post-card bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden" data-category="Technology">
                                <div class="relative">
                                    <img src="uploads/<?php echo $row['feature_image']; ?>" alt="Web Dev" class="w-full h-56 object-cover hover:scale-102 transition duration-500">
                                    <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                        <?php echo $row['category_name']; ?>
                                    </span>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                                        <span><i class="fa-solid fa-user-circle mr-1"></i> <?php echo $row['author_name']; ?></span>
                                        <span>•</span>
                                        <span><i class="fa-regular fa-calendar mr-1"></i><?php echo $row['create_at']; ?></span>
                                    </div>
                                    <h2 class="text-xl font-bold text-slate-900 mb-3 hover:text-indigo-600 transition">
                                        <a href="public/post_innerpage.php?id=<?php echo $row['id']; ?>">
                                            <?php echo $row['title']; ?>
                                        </a>
                                    </h2>
                                    <p class="text-slate-600 text-sm mb-5 leading-relaxed">
                                        <?php echo substr($row['content'], 0, 150) . '...'; ?>
                                    </p>
                                </div>
                            </article>
                    <?php
                        }
                    } else {
                        // Agar koi post na mile
                        echo "<p class='text-slate-500 text-center py-8'>No posts found.</p>";
                    }
                    ?>

                    <?php if ($total_pages > 1): ?>
                        <div class="flex items-center justify-between border-t border-slate-200 pt-6 mt-8">

                            <div>
                                <?php if ($current_page > 1): ?>
                                    <a href="?page=<?php echo $current_page - 1; ?>" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition shadow-sm">
                                        <i class="fa-solid fa-arrow-left"></i> Previous
                                    </a>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-300 bg-slate-50 cursor-not-allowed">
                                        <i class="fa-solid fa-arrow-left"></i> Previous
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="text-sm text-slate-500 font-medium">
                                Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
                            </div>

                            <div>
                                <?php if ($current_page < $total_pages): ?>
                                    <a href="?page=<?php echo $current_page + 1; ?>" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition shadow-sm">
                                        Next <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-300 bg-slate-50 cursor-not-allowed">
                                        Next <i class="fa-solid fa-arrow-right"></i>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>



            <!-- RIGHT AREA: PREMIUM SIDEBAR -->
            <aside class="space-y-8">

                <!-- Quick Search Widget -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-indigo-600"></i> Search Blog
                    </h3>
                    <div class="relative">
                        <input type="text" id="sidebarSearch" placeholder="Type keywords..." class="w-full bg-slate-50 border border-slate-200 text-sm rounded-xl py-2.5 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300">
                        <button class="absolute right-3 top-3 text-slate-400 hover:text-indigo-600">
                            <i class="fa-solid fa-search text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Trending / Current News Widget -->
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-fire text-orange-500"></i> Current Trending
                    </h3>
                    <div class="space-y-4">

                        <?php
                        // IMPORTANT: Agar $all_posts pehle use ho chuka hai, toh pointer reset karein
                        if ($all_posts && mysqli_num_rows($all_posts) > 0) {
                            mysqli_data_seek($all_posts, 0);

                            $count = 0;

                            while ($data = mysqli_fetch_assoc($all_posts)) {
                                $count++;
                        ?>

                                <div class="group flex items-start gap-3 cursor-pointer">
                                    <span class="w-6 h-6 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <?php echo str_pad($count, 2, "0", STR_PAD_LEFT); // Yeh 1 ko 01, 2 ko 02 bana dega 
                                        ?>
                                    </span>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition line-clamp-2">
                                            <a href="public/post_innerpage.php?id=<?php echo $data['id']; ?>">
                                            <?php echo $data['title']; ?>
                                        </a>
                                        </h4>
                                        <span class="text-[10px] text-slate-400">
                                            <i class="fa-regular fa-clock mr-1"></i> <?php echo $data['create_at']; ?>
                                        </span>
                                    </div>
                                </div>

                        <?php
                                // Condition ko HTML render hone ke BAAD lagayein, taake 3rd item print hone ke baad break ho
                                if ($count == 3) {
                                    break;
                                }
                            }
                        } else {
                            echo "<p class='text-xs text-slate-400'>No trending posts found.</p>";
                        }
                        ?>

                    </div>
                </div>

                <!-- Custom Tag Cloud / Categories Widget -->




            </aside>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-8 border-t border-slate-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Branding -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </div>
                        <span class="text-lg font-bold text-white tracking-tight">Blogify</span>
                    </div>
                    <p class="text-xs leading-relaxed text-slate-400">
                        Providing first-class technical blogging templates and management UI tools to creators worldwide. Build fast, communicate beautifully.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-indigo-500 transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="hover:text-indigo-500 transition"><i class="fa-brands fa-github"></i></a>
                        <a href="#" class="hover:text-indigo-500 transition"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>

                <!-- Fast Navigation -->
                <div>
                    <h4 class="text-xs font-bold uppercase text-slate-200 tracking-widest mb-4">Navigations</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="hover:text-white transition">About Our Project</a></li>
                        <li><a href="#" class="hover:text-white transition">Contributors</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Guidelines</a></li>
                    </ul>
                </div>

                <!-- Categories Quick Links -->
                <div>
                    <h4 class="text-xs font-bold uppercase text-slate-200 tracking-widest mb-4">Categories</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" onclick="filterCategory('Politics & Government')" class="hover:text-white transition">Politics & Government</a></li>
                        <li><a href="#" onclick="filterCategory('Business & Finance')" class="hover:text-white transition">Business & Finance</a></li>
                        <li><a href="#" onclick="filterCategory('Technology')" class="hover:text-white transition">Technology & AI</a></li>
                        <li><a href="#" onclick="filterCategory('Sports')" class="hover:text-white transition">Sports & Outings</a></li>
                    </ul>
                </div>

                <!-- Contact & Location -->
                <div>
                    <h4 class="text-xs font-bold uppercase text-slate-200 tracking-widest mb-4">Support Contact</h4>
                    <p class="text-xs text-slate-400 leading-relaxed mb-3">
                        Have queries or want to report bugs in our Blog Management Dashboard? Get in touch immediately!
                    </p>
                    <div class="text-xs text-slate-300 font-medium">
                        <i class="fa-regular fa-envelope text-indigo-500 mr-2"></i> support@blogify.com
                    </div>
                </div>
            </div>

            <!-- Toast alert inside frame -->
            <div id="toastMessage" class="fixed bottom-6 right-6 bg-slate-800 text-white text-xs px-4 py-3 rounded-xl shadow-2xl transition-all duration-300 opacity-0 invisible translate-y-2 z-50 flex items-center gap-2 border border-slate-700">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span id="toastText">Action completed successfully!</span>
            </div>

            <hr class="border-slate-800 my-8">
            <div class="flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500">
                <span>© 2026 Blogify Inc. All rights reserved.</span>
                <span class="mt-2 sm:mt-0">Designed elegantly using Tailwind CSS</span>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE JAVASCRIPT FUNCTIONS -->
    <!-- <script>
        // Hamburger mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Sticky header styling on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.classList.add('shadow-md', 'bg-white/95');
            } else {
                header.classList.remove('shadow-md', 'bg-white/80');
            }
        });

        // Real-Time Comments Box toggling
        function toggleComments(postId) {
            const commentBox = document.getElementById(`commentBox-${postId}`);
            if (commentBox.classList.contains('hidden')) {
                commentBox.classList.remove('hidden');
                commentBox.classList.add('animate-fade-in');
            } else {
                commentBox.classList.add('hidden');
            }
        }

        // Like buttons toggle
        function toggleLike(btn) {
            const heartIcon = btn.querySelector('i');
            const likeCountSpan = btn.querySelector('.like-count');
            let likes = parseInt(likeCountSpan.innerText);

            if (heartIcon.classList.contains('fa-regular')) {
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid', 'text-red-500', 'scale-110');
                likeCountSpan.innerText = likes + 1;
                showToast("Post Liked! ❤️");
            } else {
                heartIcon.classList.remove('fa-solid', 'text-red-500', 'scale-110');
                heartIcon.classList.add('fa-regular');
                likeCountSpan.innerText = likes - 1;
                showToast("Like removed.");
            }
        }

        // Real-time Comment post
        function postComment(event, postId) {
            event.preventDefault();
            const form = event.target;
            const textarea = form.querySelector('textarea');
            const feed = document.getElementById(`commentsFeed-${postId}`);
            const commentCountSpan = document.getElementById(`comment-count-${postId}`);

            // Remove empty messages
            const noCommentsMsg = feed.querySelector('.no-comments-message');
            if (noCommentsMsg) {
                noCommentsMsg.remove();
            }

            const newCommentText = textarea.value.trim();
            if (!newCommentText) return;

            // Generate elements dynamically with beautiful UI
            const commentWrapper = document.createElement('div');
            commentWrapper.className = "flex gap-3 animate-fade-in-up duration-300";

            // Random Avatar index
            const randomAvatarId = Math.floor(Math.random() * 50) + 10;
            commentWrapper.innerHTML = `
                <img src="https://images.unsplash.com/photo-${1500000000000 + randomAvatarId * 100}?auto=format&fit=crop&q=80&w=60" class="w-8 h-8 rounded-full border border-slate-200">
                <div class="bg-white p-3 rounded-xl border border-slate-100 flex-grow shadow-sm">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs font-bold text-slate-800">You (Guest)</span>
                        <span class="text-[10px] text-indigo-500 font-semibold">Just now</span>
                    </div>
                    <p class="text-xs text-slate-600">${escapeHTML(newCommentText)}</p>
                </div>
            `;

            feed.prepend(commentWrapper);
            
            // Update comments counter
            let currentCount = parseInt(commentCountSpan.innerText);
            commentCountSpan.innerText = currentCount + 1 + " Comment" + (currentCount + 1 !== 1 ? 's' : '');

            textarea.value = ""; // clear textarea
            showToast("Comment published! 💬");
        }

        // Safe characters escape helper
        function escapeHTML(str) {
            return str.replace(/[&<>'"]/g, 
                tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
            );
        }

        // Subscribing Newsletter Toast and clear
        function subscribeNewsletter(event) {
            event.preventDefault();
            const emailInput = document.getElementById('newsletterEmail');
            showToast(`Success! ${emailInput.value} has been subscribed. ✉️`);
            emailInput.value = '';
        }

        // Toast messages handler
        function showToast(text) {
            const toast = document.getElementById('toastMessage');
            const toastText = document.getElementById('toastText');
            toastText.innerText = text;
            
            toast.classList.remove('opacity-0', 'invisible', 'translate-y-2');
            toast.classList.add('opacity-100', 'visible', 'translate-y-0');

            setTimeout(() => {
                toast.classList.remove('opacity-100', 'visible', 'translate-y-0');
                toast.classList.add('opacity-0', 'invisible', 'translate-y-2');
            }, 3000);
        }

        // Category Filtering System
        function filterCategory(categoryName) {
            const postCards = document.querySelectorAll('.post-card');
            const featuredSection = document.getElementById('featuredSection');
            const filterStatusBar = document.getElementById('filterStatus');
            const activeCategoryName = document.getElementById('activeCategoryName');

            // Toggle category UI active state
            if (categoryName === 'All') {
                postCards.forEach(card => card.classList.remove('hidden'));
                featuredSection.classList.remove('hidden');
                filterStatusBar.classList.add('hidden');
            } else {
                let matches = 0;
                postCards.forEach(card => {
                    const postCategory = card.getAttribute('data-category');
                    if (postCategory === categoryName) {
                        card.classList.remove('hidden');
                        matches++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                // Hide Featured Post if category is filtered to make it cleaner
                featuredSection.classList.add('hidden');
                
                // Show Filter Status
                filterStatusBar.classList.remove('hidden');
                activeCategoryName.innerText = categoryName;

                // Close mobile menu if open
                mobileMenu.classList.add('hidden');
                
                showToast(`Filtered: ${categoryName}`);
            }
        }

        // Double Search Input Sync (Header and Sidebar)
        const headerSearch = document.getElementById('searchInput');
        const sidebarSearch = document.getElementById('sidebarSearch');
        const mobileSearchInput = document.getElementById('mobileSearchInput');

        [headerSearch, sidebarSearch, mobileSearchInput].forEach(input => {
            if (input) {
                input.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase().trim();
                    const postCards = document.querySelectorAll('.post-card');

                    postCards.forEach(card => {
                        const title = card.querySelector('h2').innerText.toLowerCase();
                        const excerpt = card.querySelector('p').innerText.toLowerCase();
                        
                        if (title.includes(query) || excerpt.includes(query)) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    });
                });
            }
        });

    </script> -->
</body>

</html>