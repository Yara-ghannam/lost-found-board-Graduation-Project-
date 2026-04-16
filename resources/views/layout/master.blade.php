<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="fas fa-search">Lost & Found</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/32/149/149852.png" type="image/png">

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-search me-2"></i>Lost & Found
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active text-white fw-bold' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('lost-items') ? 'active text-white fw-bold' : '' }}"
                            href="{{ route('lost-items') }}">Lost Items</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('found-items') ? 'active text-white fw-bold' : '' }}"
                            href="{{ route('found-items') }}">Found Items</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link ms-2 px-3 {{ Route::is('report-lost') ? 'active text-white fw-bold' : '' }}"
                            href="{{ route('report-lost') }}">Report Lost</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link ms-2 px-3 {{ Route::is('report-found') ? 'active text-white fw-bold' : '' }}"
                            href="{{ route('report-found') }}">Report Found</a>
                    </li>

                    @if (Session::get('is_logged_in'))
                        <li class="nav-item">
                            <a class="nav-link ms-2 px-3 {{ Route::is('posts.*') ? 'active' : '' }}"
                                href="{{ route('posts.index') }}">My Posts</a>
                        </li>
                    @endif

                    @if (Session::get('role') == 'admin')
                        <li class="nav-item dropdown ">
                            <a class="nav-link btn gradient-btn  text-white ms-2 px-3 dropdown-toggle
                            {{ Route::is('dashboard') || Route::is('users.*') ? 'active' : '' }}"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dashboard
                            </a>

                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a class="dropdown-item {{ Route::is('dashboard') ? 'active' : '' }}"
                                        href="{{ route('dashboard') }}">
                                        Posts
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('users') ? 'active' : '' }}"
                                        href="{{ route('users') }}">
                                        Users
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('claims') ? 'active' : '' }}"
                                        href="{{ route('claims') }}">
                                        Claims Status
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- 🔹 Login / Register or Personal Info -->
                    <div class="d-flex ms-lg-3 mt-2 mt-lg-0">
                        @if (Session::get('is_logged_in'))
                            <!-- Personal dropdown when logged in -->
                            <div class="dropdown">
                                <button class="btn gradient-btn dropdown-toggle text-white" type="button"
                                    id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Session::get('name') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark text-white"
                                    aria-labelledby="userMenu">
                                    <li>
                                        <span class="dropdown-item-text text-white d-flex align-items-center">
                                            <i class="fas fa-user me-2"></i>
                                            <span>{{ Session::get('email') }}</span>
                                        </span>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <!-- Update Profile -->
                                    <li>
                                        <a href="{{ route('your.profile') }}"
                                            class="dropdown-item d-flex align-items-center text-white"
                                            onmouseover="this.classList.replace('text-white','text-dark');"
                                            onmouseout="this.classList.replace('text-dark','text-white');">
                                            <span class="me-2">&#9998;</span> Update Profile
                                        </a>

                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <a href="{{ route('reset-password') }}"
                                            class="dropdown-item d-flex align-items-center justify-content-center text-white"
                                            onmouseover="this.classList.replace('text-white','text-dark');"
                                            onmouseout="this.classList.replace('text-dark','text-white');">
                                            <i class="fas fa-key me-2"></i>
                                            Reset Password
                                        </a>
                                    </li>


                                    <br>
                                    <li class="text-center">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item  align-items-center text-white"
                                                onmouseover="this.classList.replace('text-white','text-dark');"
                                                onmouseout="this.classList.replace('text-dark','text-white');">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <!-- Show login/register if not logged in -->
                            <a href="{{ route('show-login') }}" class="btn btn-outline-light me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                        @endif
                    </div>
                    @php
                        $isLoggedIn = Session::get('is_logged_in');
                    @endphp

                    @if ($isLoggedIn)
                        @php
                            $notifications = \App\Models\Notification::where('user_id', Session::get('user_id'))
                                ->where('is_read', false)
                                ->latest()
                                ->get();
                        @endphp

                        <li class="nav-item dropdown">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-bell fa-lg"></i>

                                @if ($notifications->count() > 0)
                                    <span id="notification-count"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $notifications->count() }}
                                    </span>
                                @endif
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end bg-dark text-white p-0"
                                style="min-width: 320px; max-height: 400px; overflow-y: auto;">

                                <li class="dropdown-header fw-bold px-3 py-2">
                                    Notifications
                                </li>

                                @forelse($notifications as $n)
                                    <li class="px-2 py-1 bg-dark" id="notification-{{ $n->id }}">

                                        <div class="alert alert-secondary alert-dismissible fade show mb-1 py-2 px-3"
                                            role="alert" style="background:#2b2b2b; color:#fff; border:none;">

                                            <div class="small">
                                                {{ $n->notification_text }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $n->created_at->diffForHumans() }}
                                            </small>

                                            <!-- Close Button -->
                                            <button type="button" class="btn-close btn-close-white mark-read-btn"
                                                data-id="{{ $n->id }}" aria-label="Close">
                                            </button>
                                        </div>

                                    </li>
                                @empty
                                    <li class="dropdown-item text-center text-muted px-3 py-3">
                                        No new notifications
                                    </li>
                                @endforelse
                            </ul>
                        </li>

                    @endif


                    <style>
                        /* Hover effect */
                        .dropdown-menu li.dropdown-item:hover {
                            background-color: #e9ecef;
                        }

                        /* Badge inside icon */
                        .nav-link .badge {
                            font-size: 0.7rem;
                            padding: 0.25em 0.4em;
                        }

                        /* Make time smaller and muted */
                        .dropdown-item small {
                            font-size: 0.65rem;
                        }
                    </style>





                </ul>


            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')


    <body class="d-flex flex-column min-vh-100">
        <div class="flex-grow-1">
        </div>

        <footer class="bg-dark text-white py-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5><i class="fas fa-search me-2"></i>Lost & Found Hub</h5>
                        <p class="text-white small">Helping reunite people with their lost belongings through community
                            support.</p>
                    </div>
                    <div class="col-md-4 mb-4 text-white">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled text-white">
                            <li><a href="{{ route('lost-items') }}"
                                    class="text-white text-decoration-none small">Browse Lost Items</a></li>
                            <li><a href="{{ route('found-items') }}"
                                    class="text-white text-decoration-none small">Browse Found Items</a></li>
                            <li><a href="{{ route('report-lost') }}"
                                    class="text-white text-decoration-none small">Report Lost Item</a></li>
                            <li><a href="{{ route('report-found') }}"
                                    class="text-white text-decoration-none small">Report Found Item</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Contact</h5>
                        <p class="text-white">
                            <i class="fas fa-envelope me-2 small"></i>info@lostfoundhub.com<br>
                            <i class="fas fa-phone me-2 small"></i>+962776242573
                        </p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">&copy; 2026 Lost & Found Hub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.mark-read-btn').forEach(button => {
        button.addEventListener('click', function() {
            let notificationId = this.dataset.id;
            let notificationEl = document.getElementById('notification-' + notificationId);
            let badge = document.getElementById('notification-count');

            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    notificationEl.style.transition = 'opacity 0.3s';
                    notificationEl.style.opacity = '0';
                    setTimeout(() => notificationEl.remove(), 300);

                    if (badge) {
                        let count = parseInt(badge.innerText);
                        count--;
                        if (count <= 0) {
                            badge.remove();
                        } else {
                            badge.innerText = count;
                        }
                    }
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>




</body>

</html>
