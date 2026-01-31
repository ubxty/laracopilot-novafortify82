<!-- Header -->
<header class="bg-gradient-to-r from-red-600 to-black text-white shadow-lg">
    <nav class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <svg class="w-10 h-10 transform group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                </svg>
                <div class="hidden md:block">
                    <h1 class="text-2xl font-bold">Laravel Community</h1>
                    <p class="text-xs text-red-200">Open Source Projects</p>
                </div>
            </a>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-base font-medium hover:text-red-200 transition-colors">Home</a>
                <a href="{{ route('projects.public') }}" class="text-base font-medium hover:text-red-200 transition-colors">Projects</a>
                <a href="{{ route('opensource.index') }}" class="text-base font-medium hover:text-red-200 transition-colors">Open Source</a>
                <div class="flex items-center space-x-3 border-l border-white/20 pl-6">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-red-600 rounded-lg hover:bg-red-50 transition-colors font-semibold">Register</a>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-white/20">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="py-2 hover:text-red-200 transition-colors">Home</a>
                <a href="{{ route('projects.public') }}" class="py-2 hover:text-red-200 transition-colors">Projects</a>
                <a href="{{ route('opensource.index') }}" class="py-2 hover:text-red-200 transition-colors">Open Source</a>
                <div class="flex flex-col space-y-2 pt-3 border-t border-white/20">
                    <a href="{{ route('login') }}" class="py-2 text-center rounded-lg hover:bg-white/10 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="py-2 bg-white text-red-600 text-center rounded-lg hover:bg-red-50 transition-colors font-semibold">Register</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        if (menuButton) {
            menuButton.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        }
    });
</script>
