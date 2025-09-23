@extends('layouts.app')
@section('content')

    <style>
        .partner-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .partner-logo {
            max-height: 150px; 
            width: auto;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }
        .partner-logo:hover {
            opacity: 1;
        }
        .partners-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        .partner-caption {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
    <div class="graph">
<p class="lead text-muted mt-5">
    Our fleet of modern, reliable vehicles ensures safe and efficient journeys for every trip.  
    We take pride in maintaining top-quality standards to keep our passengers and partners moving forward.
</p>
</div>
    <!-- Partnership Section -->
    <section class="partners-section mt-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-3">Our Partners</h2>
                    <p class="lead text-muted">
                        We collaborate with leading organizations to drive innovation and growth.  
                        Explore our valued partnerships below.
                    </p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- Partner 1 -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="partner-card">
                        <img src="#" alt="Partner 1 Logo" class="partner-logo img-fluid mx-auto d-block">
                        <h6 class="mt-3 mb-1">Partner 1</h6>
                        <p class="partner-caption">Delivering innovative solutions since 2005.</p>
                    </div>
                </div>
                <!-- Partner 2 -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="partner-card">
                        <img src="{{ asset('images/andeng.jpg') }}" alt="Partner 2 Logo" class="partner-logo img-fluid mx-auto d-block">
                        <h6 class="mt-3 mb-1">Partner 2</h6>
                        <p class="partner-caption">Empowering businesses worldwide.</p>
                    </div>
                </div>
                <!-- Partner 3 -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="partner-card">
                        <img src="https://via.placeholder.com/150x100/dc3545/ffffff?text=Partner+3" alt="Partner 3 Logo" class="partner-logo img-fluid mx-auto d-block">
                        <h6 class="mt-3 mb-1">Partner 3</h6>
                        <p class="partner-caption">Trusted name in global logistics.</p>
                    </div>
                </div>
                <!-- Partner 4 -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="partner-card">
                        <img src="https://via.placeholder.com/150x100/ffc107/000000?text=Partner+4" alt="Partner 4 Logo" class="partner-logo img-fluid mx-auto d-block">
                        <h6 class="mt-3 mb-1">Partner 4</h6>
                        <p class="partner-caption">Connecting people through technology.</p>
                    </div>
                </div>
                <!-- Partner 5 -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center">
                    <div class="partner-card">
                        <img src="{{ asset('images/ruzvel.jpg') }}" alt="Partner 5 Logo" class="partner-logo img-fluid mx-auto d-block">
                        <h6 class="mt-3 mb-1">Partner 5</h6>
                        <p class="partner-caption">Pioneering sustainable solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
