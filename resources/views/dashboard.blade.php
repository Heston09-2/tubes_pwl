<x-app-layout>
    @section('content')

    <style>
        /* Custom CSS Variables untuk tema hijau-abu-abu */
        :root {
            --accent-green: #5f7367;
            --accent-light: #9aaca0;
            --accent-lighter: #dfe5e1;
            --text-secondary: #5a5a5a;
            --border-custom: #e0e5e2;
        }
        
        /* Custom utility classes yang tidak tersedia di Tailwind core */
        .text-accent { color: var(--accent-green); }
        .bg-accent { background-color: var(--accent-green); }
        .bg-accent-light { background-color: var(--accent-light); }
        .bg-accent-lighter { background-color: var(--accent-lighter); }
        .text-secondary { color: var(--text-secondary); }
        .border-custom { border-color: var(--border-custom); }
        
        /* Custom gradient */
        .bg-gradient-accent {
            background: linear-gradient(135deg, var(--accent-lighter) 0%, #ffffff 100%);
        }
        
        /* Custom shadows untuk konsistensi */
        .shadow-custom {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }
        
        .shadow-hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
        }
        
        /* Hide scrollbar */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }
    </style>

    <!-- Enhanced Infographics Section -->
    <div class="flex flex-wrap justify-center gap-5 p-8 bg-white shadow-custom mb-10 relative lg:flex-row flex-col items-center">
        <div class="flex-1 min-w-[180px] max-w-[220px] bg-gradient-accent rounded-lg p-5 text-center relative transition-all duration-300 border border-custom shadow-custom hover:-translate-y-1 hover:shadow-hover lg:min-w-[180px] lg:max-w-[220px] min-w-full max-w-full mb-4 lg:mb-0">
            <div class="text-2xl text-accent mb-3 opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-gray-800 m-0 relative inline-block after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-accent">{{ $totalArtworks }}</p>
            <h3 class="text-sm font-medium mt-3 mb-0 text-accent font-sans tracking-wide">Koleksi  Museum</h3>
        </div>
        
        <div class="flex-1 min-w-[180px] max-w-[220px] bg-gradient-accent rounded-lg p-5 text-center relative transition-all duration-300 border border-custom shadow-custom hover:-translate-y-1 hover:shadow-hover lg:min-w-[180px] lg:max-w-[220px] min-w-full max-w-full mb-4 lg:mb-0">
            <div class="text-2xl text-accent mb-3 opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-gray-800 m-0 relative inline-block after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-accent">{{ $totalCategories }}</p>
            <h3 class="text-sm font-medium mt-3 mb-0 text-accent font-sans tracking-wide">Kategori</h3>
        </div>
        
        <div class="flex-1 min-w-[180px] max-w-[220px] bg-gradient-accent rounded-lg p-5 text-center relative transition-all duration-300 border border-custom shadow-custom hover:-translate-y-1 hover:shadow-hover lg:min-w-[180px] lg:max-w-[220px] min-w-full max-w-full mb-4 lg:mb-0">
            <div class="text-2xl text-accent mb-3 opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-gray-800 m-0 relative inline-block after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-accent">{{ $averageDataPerCategory }}</p>
            <h3 class="text-sm font-medium mt-3 mb-0 text-accent font-sans tracking-wide"> Koleksi per Kategori</h3>
        </div>
        
        <div class="flex-1 min-w-[180px] max-w-[220px] bg-gradient-accent rounded-lg p-5 text-center relative transition-all duration-300 border border-custom shadow-custom hover:-translate-y-1 hover:shadow-hover lg:min-w-[180px] lg:max-w-[220px] min-w-full max-w-full mb-4 lg:mb-0">
            <div class="text-2xl text-accent mb-3 opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-gray-800 m-0 relative inline-block after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-accent">{{ $totalCreators }}</p>
            <h3 class="text-sm font-medium mt-3 mb-0 text-accent font-sans tracking-wide">Pembuat/Penemu</h3>
        </div>
        
        <div class="flex-1 min-w-[180px] max-w-[220px] bg-gradient-accent rounded-lg p-5 text-center relative transition-all duration-300 border border-custom shadow-custom hover:-translate-y-1 hover:shadow-hover lg:min-w-[180px] lg:max-w-[220px] min-w-full max-w-full mb-4 lg:mb-0">
            <div class="text-2xl text-accent mb-3 opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M2 12h20"></path>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
            </div>
            <p class="text-2xl font-semibold text-gray-800 m-0 relative inline-block after:content-[''] after:absolute after:-bottom-2 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-accent">{{ $totalCountries }}</p>
            <h3 class="text-sm font-medium mt-3 mb-0 text-accent font-sans tracking-wide">Asal Negara</h3>
        </div>
    </div>
    
    <!-- Welcome Message -->
    <div class="text-center py-10 px-5 max-w-4xl mx-auto mb-12 relative before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-20 before:h-0.5 before:bg-accent">
        <h1 class="text-3xl font-normal mb-4 text-gray-800 font-serif">Selamat Datang di Flows Archive</h1>
        <p class="text-lg leading-relaxed text-secondary mb-4">Flows Archive adalah museum universal yang menyajikan koleksi dari berbagai peradaban dan zaman di seluruh dunia. Temukan berbagai karya unik yang menggambarkan kekayaan sejarah, seni, ilmu pengetahuan, dan warisan budaya dari berbagai negara. Nikmati perjalanan visual yang menghubungkan masa lalu, masa kini, dan masa depan di satu tempat.</p>
        <p class="text-lg leading-relaxed text-secondary">Museum ini bertujuan untuk menginspirasi, mendidik, dan memperkaya wawasan pengunjung melalui eksplorasi artefak dan karya dari seluruh dunia. Mari bergabung dalam perjalanan lintas waktu dan ruang yang menghubungkan berbagai peradaban dalam satu galeri interaktif.</p>
    </div>

    <!-- Featured Collection Hero Section -->
    <div class="w-full max-w-none p-0 relative bg-gray-800 mb-12 h-[500px] overflow-hidden shadow-lg">
        <!-- Scroll Arrows for Featured -->
        <div class="absolute top-1/2 -translate-y-1/2 w-full flex justify-between px-3 z-30 pointer-events-none">
            <button type="button" class="w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-lg pointer-events-auto" id="prevFeatured">
                <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[135deg] -mr-0.5"></div>
            </button>
            <button type="button" class="w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-lg pointer-events-auto" id="nextFeatured">
                <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[-45deg] -ml-0.5"></div>
            </button>
        </div>
        
        <div class="flex overflow-x-hidden gap-0 p-0 scroll-smooth h-[500px] snap-x snap-mandatory" id="featuredScroll">
            @foreach ($artworksBottom as $artwork)
                <div class="flex-none w-full snap-start">
                    <a href="{{ route('artworks.detail', $artwork->id) }}" class="block bg-transparent border-0 shadow-none h-[500px] w-full relative">
                        <div class="h-[500px] w-full overflow-hidden relative before:content-[''] before:absolute before:inset-0 before:bg-gradient-to-t before:from-black/60 before:via-black/20 before:via-40% before:to-transparent before:z-10">
                            @if($artwork->image)
                                <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <img src="https://via.placeholder.com/1600x900" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @endif
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-8 pt-16 z-20">
                            <h3 class="text-white text-2xl font-medium mb-3 drop-shadow-md">{{ $artwork->name }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="max-w-none mx-auto p-0">
        <!-- Categories Section -->
        <section class="mb-16 relative px-5">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-normal text-gray-800 relative inline-block pb-1.5 tracking-wide after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-accent">Eksplorasi Kategori Museum</h2>
                
                <!-- Scroll Arrows for Categories -->
                <div class="flex gap-3">
                    <button type="button" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-sm" id="prevCategory">
                        <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[135deg] -mr-0.5"></div>
                    </button>
                    <button type="button" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-sm" id="nextCategory">
                        <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[-45deg] -ml-0.5"></div>
                    </button>
                </div>
            </div>
            
            <div class="flex overflow-x-auto gap-5 py-1 scroll-smooth hide-scrollbar" id="categoryScroll">
                @foreach ($artworksTop as $artwork)
                    <div class="flex-none w-72">
                        <a href="{{ route('category.show', $artwork->category) }}" class="block bg-white rounded-md overflow-hidden shadow-custom transition-all duration-300 border border-custom h-full hover:-translate-y-1 hover:shadow-hover">
                            <div class="h-44 overflow-hidden relative">
                                @if($artwork->image)
                                    <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500">
                                @else
                                    <img src="https://via.placeholder.com/280x180" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500">
                                @endif
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 text-white text-xl font-medium text-center w-4/5 drop-shadow-md bg-gray-800/60 backdrop-blur-sm py-3 px-4 rounded border border-white/10 transition-all duration-300">
                                    {{ ucfirst($artwork->category) }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Recommended Section -->
        <section class="mb-16 relative px-5">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-normal text-gray-800 relative inline-block pb-1.5 tracking-wide after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-10 after:h-0.5 after:bg-accent">Rekomendasi untuk Anda</h2>
                
                <!-- Scroll Arrows for Recommended -->
                <div class="flex gap-3">
                    <button type="button" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-sm" id="prevRecommended">
                        <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[135deg] -mr-0.5"></div>
                    </button>
                    <button type="button" class="w-9 h-9 rounded-full bg-white border border-gray-200 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-accent hover:text-white hover:border-accent shadow-sm" id="nextRecommended">
                        <div class="w-2 h-2 border-r-2 border-b-2 border-current transform rotate-[-45deg] -ml-0.5"></div>
                    </button>
                </div>
            </div>
            
            <div class="flex overflow-x-auto gap-5 py-1 scroll-smooth hide-scrollbar" id="recommendedScroll">
                @foreach($recommendedArtworks as $artwork)
                    <div class="flex-none w-72">
                        <a href="{{ route('artworks.detail', $artwork->id) }}" class="block bg-white rounded-md overflow-hidden shadow-custom transition-all duration-300 border border-custom h-full hover:-translate-y-1 hover:shadow-hover">
                            <div class="h-44 overflow-hidden relative before:content-[''] before:absolute before:inset-0 before:bg-gradient-to-b before:from-black/10 before:to-transparent before:z-10 before:transition-opacity before:duration-300 hover:before:opacity-50">
                                @if($artwork->image)
                                    <img src="{{ asset('storage/images/' . $artwork->image) }}" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                @else
                                    <img src="https://via.placeholder.com/280x180" alt="{{ $artwork->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                @endif
                            </div>
                            <div class="p-4 py-5">
                                <h3 class="text-lg font-medium mb-1 text-gray-800">{{ $artwork->name }}</h3>
                                <div class="text-sm text-accent font-normal font-sans uppercase tracking-wide">{{ ucfirst($artwork->category) }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle horizontal scrolling
            function setupScrolling(scrollContainerId, prevButtonId, nextButtonId) {
                const scrollContainer = document.getElementById(scrollContainerId);
                const prevButton = document.getElementById(prevButtonId);
                const nextButton = document.getElementById(nextButtonId);
                
                if (!scrollContainer || !prevButton || !nextButton) {
                    console.log('Missing elements:', { scrollContainerId, prevButtonId, nextButtonId });
                    return;
                }
                
                console.log('Setting up scrolling for:', scrollContainerId);
                
                // Calculate scroll distance based on container type
                function getScrollDistance() {
                    if (scrollContainerId === 'featuredScroll') {
                        return scrollContainer.clientWidth; // Full width for featured
                    } else {
                        // For category and recommended, scroll by card width + gap
                        const firstCard = scrollContainer.querySelector('.flex-none');
                        if (firstCard) {
                            return firstCard.offsetWidth + 20; // card width + gap
                        }
                        return 300; // fallback
                    }
                }
                
                // Scroll left when clicking prev button
                prevButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const scrollDistance = getScrollDistance();
                    console.log('Scrolling left by:', scrollDistance);
                    
                    scrollContainer.scrollBy({
                        left: -scrollDistance,
                        behavior: 'smooth'
                    });
                });
                
                // Scroll right when clicking next button
                nextButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const scrollDistance = getScrollDistance();
                    console.log('Scrolling right by:', scrollDistance);
                    
                    scrollContainer.scrollBy({
                        left: scrollDistance,
                        behavior: 'smooth'
                    });
                });
                
                // Update button visibility on scroll
                function updateButtonVisibility() {
                    const isAtStart = scrollContainer.scrollLeft <= 5;
                    const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 5;
                    
                    // Update prev button
                    if (isAtStart) {
                        prevButton.classList.add('opacity-50', 'cursor-not-allowed');
                        prevButton.classList.remove('hover:bg-accent', 'hover:text-white');
                    } else {
                        prevButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        prevButton.classList.add('hover:bg-accent', 'hover:text-white');
                    }
                    
                    // Update next button
                    if (isAtEnd) {
                        nextButton.classList.add('opacity-50', 'cursor-not-allowed');
                        nextButton.classList.remove('hover:bg-accent', 'hover:text-white');
                    } else {
                        nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        nextButton.classList.add('hover:bg-accent', 'hover:text-white');
                    }
                }
                
                // Listen for scroll events
                scrollContainer.addEventListener('scroll', updateButtonVisibility);
                
                // Initial button visibility check
                setTimeout(updateButtonVisibility, 100);
                
                // Update on window resize
                window.addEventListener('resize', function() {
                    setTimeout(updateButtonVisibility, 100);
                });
            }
            
            // Setup scroll functionality for all sections with delay to ensure DOM is ready
            setTimeout(function() {
                setupScrolling('featuredScroll', 'prevFeatured', 'nextFeatured');
                setupScrolling('categoryScroll', 'prevCategory', 'nextCategory');
                setupScrolling('recommendedScroll', 'prevRecommended', 'nextRecommended');
            }, 100);
            
            // Add subtle animation to infographic items
            const infographicItems = document.querySelectorAll('.bg-gradient-accent');
            infographicItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, (index * 150) + 200);
            });
            
            // Touch/swipe support for mobile
            let isDown = false;
            let startX;
            let scrollLeft;
            
            function addTouchSupport(scrollContainer) {
                scrollContainer.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - scrollContainer.offsetLeft;
                    scrollLeft = scrollContainer.scrollLeft;
                });
                
                scrollContainer.addEventListener('mouseleave', () => {
                    isDown = false;
                });
                
                scrollContainer.addEventListener('mouseup', () => {
                    isDown = false;
                });
                
                scrollContainer.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - scrollContainer.offsetLeft;
                    const walk = (x - startX) * 2;
                    scrollContainer.scrollLeft = scrollLeft - walk;
                });
            }
            
            // Add touch support to all scroll containers
            setTimeout(function() {
                const scrollContainers = ['featuredScroll', 'categoryScroll', 'recommendedScroll'];
                scrollContainers.forEach(containerId => {
                    const container = document.getElementById(containerId);
                    if (container) {
                        addTouchSupport(container);
                    }
                });
            }, 100);
        });
    </script>

    @endsection
</x-app-layout>