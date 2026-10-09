<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Perpus - Sistem Manajemen Inventaris</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-body-tertiary text-dark">

    <!-- Navbar Tema Monokrom Minimalis -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm mb-4 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark" href="#">
                <i class="bi bi-book-half me-2"></i>Mini Perpus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-secondary fw-semibold {{ request()->routeIs('categories.*') ? 'text-dark border-bottom border-dark border-2' : '' }}" href="{{ route('categories.index') }}">
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary fw-semibold {{ request()->routeIs('books.*') ? 'text-dark border-bottom border-dark border-2' : '' }}" href="{{ route('books.index') }}">
                            Buku
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container pb-5">
        <!-- Area Konten dari masing-masing halaman -->
        @yield('content')
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script SweetAlert2 Notifikasi -->
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800,
                customClass: { popup: 'rounded-4' }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Perhatian',
                text: '{{ session('error') }}',
                confirmButtonColor: '#000000',
                customClass: { popup: 'rounded-4' }
            });
        @endif
    </script>
</body>
</html>