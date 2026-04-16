@extends('layout.master')

@section('content')

<!-- ================= HERO SECTION ================= -->
<section class="hero-section position-relative overflow-hidden">

    <!-- Floating Shapes -->
    <div class="hero-item sm color-blue" style="top: 40px; left: 80px;"></div>
    <div class="hero-item md color-purple" style="top: 150px; left: 200px;"></div>
    <div class="hero-item lg color-aqua" style="top: 100px; right: 120px;"></div>
    <div class="hero-item xs color-pink" style="top: 260px; left: 140px;"></div>
    <div class="hero-item sm color-yellow" style="top: 300px; right: 30px;"></div>

    <div class="container">
        <div class="row align-items-center min-vh-100">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 text-white">
                <h1 class="display-4 fw-bold mb-4">
                    Reuniting Lost Items <br> With Their People
                </h1>

                <p class="lead text-white-50 mb-4">
                    A community-driven platform that helps you report lost items
                    and reconnect people with their belongings.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('report-lost') }}" class="btn btn-outline-light btn-lg ">
                         <i class="fas fa-search-minus"></i> Report Lost
                    </a>

                    <a href="{{ route('report-found') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-hand-holding me-2"></i> Report Found
                    </a>
                </div>
            </div>

            <!-- RIGHT ICON -->
            <div class="col-lg-6 d-flex justify-content-center mt-5 mt-lg-0">
                <div class="hero-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= STATISTICS ================= -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-3 col-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-exclamation-triangle text-danger display-4 mb-3"></i>
                    <h3 class="fw-bold">42</h3>
                    <p class="text-muted">Lost Items</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-hand-holding text-success display-4 mb-3"></i>
                    <h3 class="fw-bold">28</h3>
                    <p class="text-muted">Found Items</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-handshake text-warning display-4 mb-3"></i>
                    <h3 class="fw-bold">15</h3>
                    <p class="text-muted">Reunited</p>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-4">
                <div class="stat-card">
                    <i class="fas fa-users text-info display-4 mb-3"></i>
                    <h3 class="fw-bold">156</h3>
                    <p class="text-muted">Users</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= HOW IT WORKS ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">How It Works</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white mx-auto mb-3">1</div>
                    <i class="fas fa-edit display-4 text-primary mb-3"></i>
                    <h5>Report</h5>
                    <p class="text-muted">Submit details of a lost or found item.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white mx-auto mb-3">2</div>
                    <i class="fas fa-search display-4 text-primary mb-3"></i>
                    <h5>Search</h5>
                    <p class="text-muted">Browse items reported by the community.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number bg-primary text-white mx-auto mb-3">3</div>
                    <i class="fas fa-handshake display-4 text-primary mb-3"></i>
                    <h5>Connect</h5>
                    <p class="text-muted">Safely reconnect items with owners.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
