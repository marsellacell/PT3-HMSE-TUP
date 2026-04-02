<nav
    x-data="{
        mobileOpen: false,
        relatedOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
        }
    }"
    :class="scrolled ? 'bg-white shadow-md' : 'bg-white/95 backdrop-blur-sm shadow-sm'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-hmse-primary flex items-center justify-center shadow-sm group-hover:bg-hmse-primary-light transition-colors duration-200">
                    <span class="text-white font-black text-sm tracking-tight">HMSE</span>
                </div>
                <div class="hidden sm:block">
                    <p class="text-sm font-bold text-hmse-primary leading-tight">HMSE</p>
                    <p class="text-xs text-hmse-text-muted leading-tight">Tel-U Purwokerto</p>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-1">

                <a href="{{ route('home') }}"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-hmse-primary/5
                          {{ request()->routeIs('home') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary' }}">
                    Home
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-hmse-primary/5
                          {{ request()->routeIs('about') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary' }}">
                    About Us
                </a>

                <a href="{{ route('news.index') }}"
                   class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-hmse-primary/5
                          {{ request()->routeIs('news.*') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary' }}">
                    News
                </a>

                {{-- Related Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button
                        class="nav-link px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-hmse-primary/5 text-gray-600 hover:text-hmse-primary flex items-center gap-1"
                        :class="open ? 'text-hmse-primary bg-hmse-primary/5' : ''"
                    >
                        Related
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50"
                    >
                        <a href="https://zetech.telkomuniversity.ac.id" target="_blank"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-150">
                            <svg class="w-4 h-4 text-hmse-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Zetech
                        </a>
                        <a href="#" target="_blank"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-150">
                            <svg class="w-4 h-4 text-hmse-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Web Prodi
                        </a>
                    </div>
                </div>

            </div>

            {{-- CTA Button (Desktop) --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-semibold text-hmse-primary border-2 border-hmse-primary rounded-lg hover:bg-hmse-primary hover:text-white transition-all duration-200">
                    Login
                </a>
            </div>

            {{-- Hamburger (Mobile) --}}
            <button
                @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg text-gray-500 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-200"
                aria-label="Toggle menu"
            >
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white border-t border-gray-100 shadow-lg"
        @click.outside="mobileOpen = false"
    >
        <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-1">

            <a href="{{ route('home') }}"
               class="px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ request()->routeIs('home') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5' }}">
                Home
            </a>

            <a href="{{ route('about') }}"
               class="px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ request()->routeIs('about') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5' }}">
                About Us
            </a>

            <a href="{{ route('news.index') }}"
               class="px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-150
                      {{ request()->routeIs('news.*') ? 'text-hmse-primary font-semibold bg-hmse-primary/5' : 'text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5' }}">
                News
            </a>

            {{-- Related Mobile Accordion --}}
            <div x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-sm font-medium text-gray-600 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-150"
                >
                    Related
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition class="pl-4 flex flex-col gap-1 mt-1">
                    <a href="https://zetech.telkomuniversity.ac.id" target="_blank"
                       class="px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-150">
                        → Zetech
                    </a>
                    <a href="#" target="_blank"
                       class="px-4 py-2.5 rounded-lg text-sm text-gray-500 hover:text-hmse-primary hover:bg-hmse-primary/5 transition-colors duration-150">
                        → Web Prodi
                    </a>
                </div>
            </div>

            <div class="pt-2 pb-1 border-t border-gray-100 mt-1">
                <a href="{{ route('login') }}"
                   class="block w-full text-center px-4 py-2.5 text-sm font-semibold text-white bg-hmse-primary rounded-lg hover:bg-hmse-primary-light transition-colors duration-200">
                    Login Dashboard
                </a>
            </div>

        </div>
    </div>
</nav>
