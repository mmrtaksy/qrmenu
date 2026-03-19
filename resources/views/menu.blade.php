<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Raqoon Cafe - Menü</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #0a0a0f;
            --surface: #141419;
            --surface-2: #1c1c24;
            --border: rgba(255,255,255,0.06);
            --text: #f5f5f7;
            --text-secondary: #8e8e93;
            --accent: #ff9e81;
            --accent-glow: rgba(255,158,129,0.15);
            --accent-dark: #e88a6d;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Hero */
        .hero {
            position: relative;
            padding: 3rem 1.5rem 1.5rem;
            text-align: center;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            position: relative;
        }
        .hero-brand span { color: var(--accent); }
        .hero-tagline {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 0.25rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        /* Search */
        .search-wrap {
            max-width: 680px;
            margin: 0 auto;
            padding: 1rem 1.5rem 0;
            position: relative;
        }
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .search-input::placeholder { color: var(--text-secondary); }
        .search-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .search-icon {
            position: absolute;
            left: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            margin-top: 0.5rem;
        }
        .search-clear {
            position: absolute;
            right: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            cursor: pointer;
            display: none;
            background: none;
            border: none;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
        .search-clear.visible { display: block; }

        /* Category Navigation */
        .category-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 0;
        }
        .category-nav-scroll {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            padding: 0 1.5rem;
            scrollbar-width: none;
            -ms-overflow-style: none;
            justify-content: center;
        }
        .category-nav-scroll::-webkit-scrollbar { display: none; }
        .cat-pill {
            flex-shrink: 0;
            padding: 0.5rem 1.25rem;
            border-radius: 100px;
            background: var(--surface-2);
            color: var(--text-secondary);
            font-size: 0.825rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
            text-decoration: none;
            white-space: nowrap;
        }
        .cat-pill:hover, .cat-pill.active {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 4px 20px var(--accent-glow);
        }

        /* Content */
        .menu-content { padding: 1rem 1.5rem 2rem; max-width: 680px; margin: 0 auto; }

        /* Category Section - Accordion style */
        .category-section { margin-bottom: 0.75rem; }
        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }
        .category-header:hover {
            border-color: rgba(255,158,129,0.2);
        }
        .category-header.open {
            border-radius: 16px 16px 0 0;
            border-bottom-color: transparent;
            background: var(--surface-2);
        }
        .category-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .category-icon img { width: 100%; height: 100%; object-fit: cover; }
        .category-icon-placeholder {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .category-info { flex: 1; }
        .category-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
        }
        .category-count {
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 400;
        }
        .category-arrow {
            color: var(--text-secondary);
            font-size: 1.2rem;
            transition: transform 0.3s;
            flex-shrink: 0;
        }
        .category-header.open .category-arrow { transform: rotate(180deg); }

        /* Products list */
        .category-products {
            display: none;
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 16px 16px;
            padding: 0.5rem;
            overflow: hidden;
        }
        .category-products.open {
            display: block;
            animation: fadeDown 0.3s ease;
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Product Card */
        .product-card {
            display: flex;
            gap: 1rem;
            padding: 0.85rem;
            margin-bottom: 0.25rem;
            border-radius: 12px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .product-card:last-child { margin-bottom: 0; }
        .product-card:hover {
            background: var(--surface-2);
        }
        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .product-image-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            background: var(--surface-2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .product-info { flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center; }
        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.2rem;
        }
        .product-desc {
            color: var(--text-secondary);
            font-size: 0.78rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-price {
            margin-top: 0.4rem;
            font-size: 1rem;
            font-weight: 700;
            color: var(--accent);
        }
        .product-price .currency {
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-left: 2px;
        }

        /* No results */
        .no-results {
            display: none;
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-secondary);
        }
        .no-results.visible { display: block; }
        .no-results i { font-size: 2.5rem; margin-bottom: 0.75rem; display: block; }

        /* Product Detail Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(10px);
            z-index: 200;
            align-items: flex-end;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal-sheet {
            background: var(--surface);
            border-radius: 24px 24px 0 0;
            width: 100%;
            max-width: 680px;
            max-height: 85vh;
            overflow-y: auto;
            animation: slideUp 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        .modal-handle {
            width: 40px;
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
            margin: 12px auto;
        }
        .modal-image {
            width: 100%;
            aspect-ratio: 16/10;
            object-fit: cover;
        }
        .modal-body { padding: 1.5rem; }
        .modal-product-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .modal-product-desc {
            color: var(--text-secondary);
            line-height: 1.7;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .modal-product-price {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--accent);
        }
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }

        /* Scroll to top */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 1.5rem;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s;
            box-shadow: 0 4px 20px var(--accent-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
        }
        .scroll-top.visible { opacity: 1; transform: translateY(0); }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* Search highlight */
        .highlight { background: var(--accent-glow); color: var(--accent); border-radius: 2px; padding: 0 2px; }

        /* Footer */
        .menu-footer {
            border-top: 1px solid var(--border);
            padding: 2rem 1.5rem 2.5rem;
            text-align: center;
            max-width: 680px;
            margin: 0 auto;
        }
        .footer-social {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            font-size: 1.15rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .footer-social a:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px var(--accent-glow);
        }
        .footer-copyright {
            color: var(--text-secondary);
            font-size: 0.75rem;
            line-height: 1.7;
        }
        .footer-copyright a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .footer-copyright a:hover { opacity: 0.8; }
        .footer-divider {
            width: 40px;
            height: 2px;
            background: var(--border);
            margin: 1rem auto;
            border-radius: 1px;
        }

        @media (min-width: 768px) {
            .hero-brand { font-size: 3rem; }
            .product-image, .product-image-placeholder { width: 100px; height: 100px; }
            .modal-sheet { border-radius: 24px; margin: auto; max-height: 90vh; }
        }
    </style>
</head>
<body>
    <!-- Hero -->
    <header class="hero">
        <div class="hero-brand"><span>Raqoon</span> Cafe</div>
        <div class="hero-tagline">Lezzetin Buluşma Noktası</div>
    </header>

    <!-- Search -->
    <div class="search-wrap">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="search-input" id="searchInput" placeholder="Menüde ara..." autocomplete="off">
        <button class="search-clear" id="searchClear"><i class="bi bi-x-circle-fill"></i></button>
    </div>

    <!-- Category Navigation -->
    @if($categories->isNotEmpty())
    <nav class="category-nav">
        <div class="category-nav-scroll">
            @foreach($categories as $category)
                @if($category->activeProducts->isNotEmpty())
                <a href="#cat-{{ $category->slug }}" class="cat-pill" data-target="cat-{{ $category->slug }}">
                    {{ $category->name }}
                </a>
                @endif
            @endforeach
        </div>
    </nav>
    @endif

    <!-- Menu Content -->
    <main class="menu-content">
        @if($categories->isEmpty())
            <div class="empty-state">
                <i class="bi bi-cup-hot"></i>
                <h3>Menü hazırlanıyor</h3>
                <p>Yakında burada olacağız!</p>
            </div>
        @else
            @foreach($categories as $category)
                @if($category->activeProducts->isNotEmpty())
                <section class="category-section fade-in" id="cat-{{ $category->slug }}" data-category="{{ mb_strtolower($category->name) }}">
                    <div class="category-header" onclick="toggleCategory(this)">
                        @if($category->image)
                            <div class="category-icon">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                            </div>
                        @else
                            <div class="category-icon-placeholder">
                                <i class="bi bi-grid-fill text-white"></i>
                            </div>
                        @endif
                        <div class="category-info">
                            <div class="category-name">{{ $category->name }}</div>
                            <div class="category-count">{{ $category->activeProducts->count() }} ürün</div>
                        </div>
                        <i class="bi bi-chevron-down category-arrow"></i>
                    </div>

                    <div class="category-products">
                        @foreach($category->activeProducts as $product)
                        <div class="product-card" data-name="{{ mb_strtolower($product->name) }}" data-desc="{{ mb_strtolower($product->description ?? '') }}" onclick="showProduct({{ json_encode([
                            'name' => $product->name,
                            'description' => $product->description,
                            'price' => number_format($product->price, 2),
                            'image' => $product->image ? asset('storage/' . $product->image) : null,
                        ]) }})">
                            @if($product->image)
                                <div class="product-image">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                                </div>
                            @else
                                <div class="product-image-placeholder">
                                    <i class="bi bi-cup-hot" style="font-size:1.5rem;color:var(--text-secondary);"></i>
                                </div>
                            @endif
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                @if($product->description)
                                    <div class="product-desc">{{ $product->description }}</div>
                                @endif
                                <div class="product-price">
                                    {{ number_format($product->price, 2) }}<span class="currency">TL</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            @endforeach

            <div class="no-results" id="noResults">
                <i class="bi bi-search"></i>
                <h4>Sonuç bulunamadı</h4>
                <p>Farklı bir arama terimi deneyin.</p>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="menu-footer">
        @if($socialLinks->isNotEmpty())
        <div class="footer-social">
            @foreach($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" title="{{ $link->platform }}">
                    <i class="bi bi-{{ $link->icon }}"></i>
                </a>
            @endforeach
        </div>
        @endif
        <div class="footer-divider"></div>
        <div class="footer-copyright">
            &copy; {{ date('Y') }} Raqoon Cafe. Tüm hakları saklıdır.<br>
            Made by <a href="https://www.linkedin.com/in/mmrtaksy/" target="_blank" rel="noopener noreferrer">mmrtaksy</a>
        </div>
    </footer>

    <!-- Product Detail Modal -->
    <div class="modal-overlay" id="productModal" onclick="closeModal(event)">
        <div class="modal-sheet" onclick="event.stopPropagation()">
            <div class="modal-handle"></div>
            <div style="position:relative;">
                <img id="modalImage" class="modal-image" src="" alt="" style="display:none;">
                <button class="modal-close" onclick="closeModal()"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                <div id="modalName" class="modal-product-name"></div>
                <div id="modalDesc" class="modal-product-desc"></div>
                <div id="modalPrice" class="modal-product-price"></div>
            </div>
        </div>
    </div>

    <!-- Scroll to top -->
    <button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0})">
        <i class="bi bi-chevron-up"></i>
    </button>

    <script>
        // Fade-in animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Toggle category accordion
        function toggleCategory(header) {
            const products = header.nextElementSibling;
            const isOpen = header.classList.contains('open');

            header.classList.toggle('open');
            products.classList.toggle('open');

            // Scroll into view
            if (!isOpen) {
                setTimeout(() => {
                    header.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 50);
            }
        }

        // Category pills - scroll to & open
        const pills = document.querySelectorAll('.cat-pill');
        pills.forEach(pill => {
            pill.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.getElementById(pill.dataset.target);
                if (!target) return;

                const header = target.querySelector('.category-header');
                const products = target.querySelector('.category-products');

                // Open this category if closed
                if (!header.classList.contains('open')) {
                    header.classList.add('open');
                    products.classList.add('open');
                }

                // Scroll to it
                const navHeight = document.querySelector('.category-nav').offsetHeight + 16;
                window.scrollTo({ top: target.offsetTop - navHeight, behavior: 'smooth' });

                // Update active pill
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
            });
        });

        // Active pill on scroll
        const sections = document.querySelectorAll('.category-section');
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    pills.forEach(p => p.classList.remove('active'));
                    const activePill = document.querySelector(`.cat-pill[data-target="${id}"]`);
                    if (activePill) {
                        activePill.classList.add('active');
                        activePill.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                }
            });
        }, { rootMargin: '-20% 0px -70% 0px' });
        sections.forEach(s => sectionObserver.observe(s));

        // Search
        const searchInput = document.getElementById('searchInput');
        const searchClear = document.getElementById('searchClear');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            searchClear.classList.toggle('visible', query.length > 0);

            let anyVisible = false;

            document.querySelectorAll('.category-section').forEach(section => {
                const catName = section.dataset.category;
                const header = section.querySelector('.category-header');
                const productsList = section.querySelector('.category-products');
                const cards = section.querySelectorAll('.product-card');
                let catMatch = catName.includes(query);
                let productVisible = false;

                cards.forEach(card => {
                    const name = card.dataset.name;
                    const desc = card.dataset.desc;
                    const matches = query === '' || name.includes(query) || desc.includes(query) || catMatch;
                    card.style.display = matches ? '' : 'none';
                    if (matches) productVisible = true;
                });

                if (query && productVisible) {
                    header.classList.add('open');
                    productsList.classList.add('open');
                } else if (query && !productVisible) {
                    header.classList.remove('open');
                    productsList.classList.remove('open');
                }

                section.style.display = productVisible ? '' : 'none';
                if (productVisible) anyVisible = true;
            });

            if (noResults) noResults.classList.toggle('visible', query.length > 0 && !anyVisible);
        });

        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        });

        // Scroll top button
        window.addEventListener('scroll', () => {
            document.getElementById('scrollTop').classList.toggle('visible', window.scrollY > 400);
        });

        // Product modal
        function showProduct(product) {
            const modal = document.getElementById('productModal');
            const img = document.getElementById('modalImage');

            document.getElementById('modalName').textContent = product.name;
            document.getElementById('modalDesc').textContent = product.description || '';
            document.getElementById('modalPrice').innerHTML = product.price + '<span class="currency" style="font-size:1rem;color:var(--text-secondary);margin-left:4px;">TL</span>';

            if (product.image) {
                img.src = product.image;
                img.style.display = 'block';
            } else {
                img.style.display = 'none';
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(e) {
            if (e && e.target !== document.getElementById('productModal')) return;
            document.getElementById('productModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Swipe down to close modal
        let touchStart = 0;
        document.querySelector('.modal-sheet').addEventListener('touchstart', (e) => {
            touchStart = e.touches[0].clientY;
        });
        document.querySelector('.modal-sheet').addEventListener('touchend', (e) => {
            const diff = e.changedTouches[0].clientY - touchStart;
            if (diff > 100) closeModal();
        });
    </script>
</body>
</html>
