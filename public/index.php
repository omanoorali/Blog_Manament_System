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
                            <a href="#" onclick="filterCategory('Politics & Government')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Politics & Government
                            </a>
                            <a href="#" onclick="filterCategory('Business & Finance')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Business & Finance
                            </a>
                            <a href="#" onclick="filterCategory('Technology')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Technology
                            </a>
                            <a href="#" onclick="filterCategory('Sports')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span> Sports
                            </a>
                            <a href="#" onclick="filterCategory('Entertainment')" class="category-filter-btn flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-purple-50 hover:text-purple-600 rounded-xl transition">
                                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span> Entertainment
                            </a>
                        </div>
                    </div>

                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition duration-150">Contact Us</a>
                </nav>

                <!-- Search & Action Button -->
                <div class="hidden md:flex items-center gap-4">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search articles..." class="bg-slate-50 border border-slate-200 text-sm rounded-full py-2 pl-4 pr-10 w-48 focus:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300">
                        <button class="absolute right-3 top-2.5 text-slate-400 hover:text-indigo-600">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </button>
                    </div>
                    <a href="login.php">
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
        <div id="featuredSection" class="relative bg-slate-900 rounded-3xl overflow-hidden shadow-2xl mb-12 min-h-[400px] sm:min-h-[480px] flex items-end">
            <!-- Background Image with Gradient Overlay -->
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=1200');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
            
            <!-- Hero Content -->
            <div class="relative z-10 p-6 sm:p-10 md:p-12 max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-indigo-600 text-white uppercase tracking-wider mb-4 shadow-lg shadow-indigo-600/30">
                    <i class="fa-solid fa-bolt animate-pulse"></i> Featured Tech Post
                </span>
                <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                    The Next Wave of AI: How Gemini 2.5 is Shaping the Future of Code Integration
                </h1>
                <p class="text-slate-300 text-sm sm:text-base mb-6 line-clamp-2">
                    Discover how the newest developments in generative models are transforming daily developer operations, making web-designing instantaneous and intuitive.
                </p>
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-400">
                    <div class="flex items-center gap-2">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Author" class="w-8 h-8 rounded-full border border-indigo-500/30">
                        <span class="font-medium text-white">Zoya Malik</span>
                    </div>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                    <span><i class="fa-regular fa-calendar-alt mr-1"></i> June 3, 2026</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                    <span><i class="fa-regular fa-clock mr-1"></i> 5 mins read</span>
                </div>
            </div>
        </div>

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
                
                <!-- Blog Card 1 -->
                <article class="post-card bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden" data-category="Technology">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800" alt="Web Dev" class="w-full h-56 object-cover hover:scale-102 transition duration-500">
                        <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Technology
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                            <span><i class="fa-solid fa-user-circle mr-1"></i> Daniyal Ali</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> June 2, 2026</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-3 hover:text-indigo-600 transition">
                            <a href="#">Building lightning-fast web apps with modern Tailwind CSS layouts</a>
                        </h2>
                        <p class="text-slate-600 text-sm mb-5 leading-relaxed">
                            CSS layouts do not have to be hard. With Tailwind CSS utility classes, you can craft beautiful designs that adapt immediately to smartphones, tablets, and wide monitors.
                        </p>
                        
                        <!-- Actions & Interaction bar -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-4">
                                <!-- Like Button -->
                                <button onclick="toggleLike(this)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-500 transition group">
                                    <i class="fa-regular fa-heart text-base group-hover:scale-125 transition"></i>
                                    <span class="like-count">24</span> Likes
                                </button>
                                <!-- Comment Button -->
                                <button onclick="toggleComments(1)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 transition">
                                    <i class="fa-regular fa-comment text-base"></i>
                                    <span id="comment-count-1">2</span> Comments
                                </button>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-800 text-xs font-bold flex items-center gap-1">
                                Read More <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Real-Time Interactive Comments Box (Post 1) -->
                        <div id="commentBox-1" class="hidden mt-6 bg-slate-50 rounded-xl p-4 sm:p-5 border border-slate-100 transition-all duration-300">
                            <h4 class="text-sm font-bold text-slate-800 mb-4"><i class="fa-regular fa-comments text-indigo-500 mr-1.5"></i> Discussion</h4>
                            
                            <!-- Comments Feed -->
                            <div id="commentsFeed-1" class="space-y-4 max-h-60 overflow-y-auto mb-4 pr-1">
                                <div class="flex gap-3">
                                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=60" class="w-8 h-8 rounded-full border border-slate-200">
                                    <div class="bg-white p-3 rounded-xl border border-slate-100 flex-grow shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs font-bold text-slate-800">Sara Khan</span>
                                            <span class="text-[10px] text-slate-400">2 hours ago</span>
                                        </div>
                                        <p class="text-xs text-slate-600">This was incredibly helpful! The grid explanation is so clear.</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=60" class="w-8 h-8 rounded-full border border-slate-200">
                                    <div class="bg-white p-3 rounded-xl border border-slate-100 flex-grow shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs font-bold text-slate-800">Usman Sheikh</span>
                                            <span class="text-[10px] text-slate-400">1 day ago</span>
                                        </div>
                                        <p class="text-xs text-slate-600">Will you be posting about Tailwind v4 upgrades as well?</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment Form -->
                            <form onsubmit="postComment(event, 1)" class="flex flex-col gap-2">
                                <textarea placeholder="Write a comment..." class="w-full text-xs bg-white border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none h-20" required></textarea>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] text-slate-400">Logged in as Guest</span>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition flex items-center gap-1.5 self-end">
                                        Send <i class="fa-solid fa-paper-plane text-[10px]"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </article>

                <!-- Blog Card 2 -->
                <article class="post-card bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden" data-category="Business & Finance">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&q=80&w=800" alt="Finance" class="w-full h-56 object-cover hover:scale-102 transition duration-500">
                        <span class="absolute top-4 left-4 bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Business & Finance
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                            <span><i class="fa-solid fa-user-circle mr-1"></i> Ayesha Khan</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> May 29, 2026</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-3 hover:text-indigo-600 transition">
                            <a href="#">Strategic Investment Strategies for Startups in 2026</a>
                        </h2>
                        <p class="text-slate-600 text-sm mb-5 leading-relaxed">
                            Securing venture funding is changing. Discover the modern methods of non-dilutive funding, crowd-investing and global micro-loans shaping startup growth.
                        </p>
                        
                        <!-- Actions & Interaction bar -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-4">
                                <button onclick="toggleLike(this)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-500 transition group">
                                    <i class="fa-regular fa-heart text-base group-hover:scale-125 transition"></i>
                                    <span class="like-count">42</span> Likes
                                </button>
                                <button onclick="toggleComments(2)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 transition">
                                    <i class="fa-regular fa-comment text-base"></i>
                                    <span id="comment-count-2">1</span> Comment
                                </button>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-800 text-xs font-bold flex items-center gap-1">
                                Read More <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Real-Time Interactive Comments Box (Post 2) -->
                        <div id="commentBox-2" class="hidden mt-6 bg-slate-50 rounded-xl p-4 sm:p-5 border border-slate-100 transition-all duration-300">
                            <h4 class="text-sm font-bold text-slate-800 mb-4"><i class="fa-regular fa-comments text-indigo-500 mr-1.5"></i> Discussion</h4>
                            
                            <!-- Comments Feed -->
                            <div id="commentsFeed-2" class="space-y-4 max-h-60 overflow-y-auto mb-4 pr-1">
                                <div class="flex gap-3">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=60" class="w-8 h-8 rounded-full border border-slate-200">
                                    <div class="bg-white p-3 rounded-xl border border-slate-100 flex-grow shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs font-bold text-slate-800">Amina Jameel</span>
                                            <span class="text-[10px] text-slate-400">3 days ago</span>
                                        </div>
                                        <p class="text-xs text-slate-600">Extremely valuable insight for small entrepreneurs.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment Form -->
                            <form onsubmit="postComment(event, 2)" class="flex flex-col gap-2">
                                <textarea placeholder="Write a comment..." class="w-full text-xs bg-white border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none h-20" required></textarea>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] text-slate-400">Logged in as Guest</span>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition flex items-center gap-1.5 self-end">
                                        Send <i class="fa-solid fa-paper-plane text-[10px]"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </article>

                <!-- Blog Card 3 -->
                <article class="post-card bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden" data-category="Sports">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&q=80&w=800" alt="Sports" class="w-full h-56 object-cover hover:scale-102 transition duration-500">
                        <span class="absolute top-4 left-4 bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            Sports
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                            <span><i class="fa-solid fa-user-circle mr-1"></i> Bilal Khan</span>
                            <span>•</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> May 25, 2026</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-3 hover:text-indigo-600 transition">
                            <a href="#">The Global Cricket Evolution: What to Expect Next Season</a>
                        </h2>
                        <p class="text-slate-600 text-sm mb-5 leading-relaxed">
                            Shorter formats, higher technology integrations, and player health tracking solutions are changing modern field configurations and international leagues.
                        </p>
                        
                        <!-- Actions & Interaction bar -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-4">
                                <button onclick="toggleLike(this)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-500 transition group">
                                    <i class="fa-regular fa-heart text-base group-hover:scale-125 transition"></i>
                                    <span class="like-count">87</span> Likes
                                </button>
                                <button onclick="toggleComments(3)" class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 transition">
                                    <i class="fa-regular fa-comment text-base"></i>
                                    <span id="comment-count-3">0</span> Comments
                                </button>
                            </div>
                            <button class="text-indigo-600 hover:text-indigo-800 text-xs font-bold flex items-center gap-1">
                                Read More <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Real-Time Interactive Comments Box (Post 3) -->
                        <div id="commentBox-3" class="hidden mt-6 bg-slate-50 rounded-xl p-4 sm:p-5 border border-slate-100 transition-all duration-300">
                            <h4 class="text-sm font-bold text-slate-800 mb-4"><i class="fa-regular fa-comments text-indigo-500 mr-1.5"></i> Discussion</h4>
                            
                            <!-- Comments Feed -->
                            <div id="commentsFeed-3" class="space-y-4 max-h-60 overflow-y-auto mb-4 pr-1">
                                <div class="no-comments-message text-center py-4 text-xs text-slate-400">Be the first to comment on this article!</div>
                            </div>

                            <!-- Comment Form -->
                            <form onsubmit="postComment(event, 3)" class="flex flex-col gap-2">
                                <textarea placeholder="Write a comment..." class="w-full text-xs bg-white border border-slate-200 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 resize-none h-20" required></textarea>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] text-slate-400">Logged in as Guest</span>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition flex items-center gap-1.5 self-end">
                                        Send <i class="fa-solid fa-paper-plane text-[10px]"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </article>

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
                        <!-- Item 1 -->
                        <div class="group flex items-start gap-3 cursor-pointer">
                            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                01
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition line-clamp-2">
                                    New tech stack trends driving full-stack startups in late 2026.
                                </h4>
                                <span class="text-[10px] text-slate-400"><i class="fa-regular fa-clock mr-1"></i>2 hours ago</span>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="group flex items-start gap-3 cursor-pointer">
                            <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                02
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition line-clamp-2">
                                    Why ESG criteria became mandatory for local investment capital.
                                </h4>
                                <span class="text-[10px] text-slate-400"><i class="fa-regular fa-clock mr-1"></i>5 hours ago</span>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="group flex items-start gap-3 cursor-pointer">
                            <span class="w-6 h-6 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                03
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 group-hover:text-indigo-600 transition line-clamp-2">
                                    Olympic Games 2028 preparation schedules finalized early.
                                </h4>
                                <span class="text-[10px] text-slate-400"><i class="fa-regular fa-clock mr-1"></i>1 day ago</span>
                            </div>
                        </div>
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
    <script>
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

    </script>
</body>
</html>