@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Linen Provision Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #e0e7ff;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f72585;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            background-color: #f5f7ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2b2d42;
        }
        
        .main-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 25px;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 0%, transparent 40%);
        }
        
        .card-header h3 {
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
        }
        
        .accordion-button {
            font-weight: 600;
            padding: 16px 20px;
            transition: all 0.3s ease;
        }
        
        .accordion-button:not(.collapsed) {
            color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.1);
            box-shadow: none;
        }
        
        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(67, 97, 238, 0.3);
        }
        
        .accordion-item {
            border: 1px solid rgba(67, 97, 238, 0.15);
            margin-bottom: 12px;
            border-radius: 12px !important;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.05);
            transition: all 0.3s ease;
        }
        
        .accordion-item:hover {
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
        }
        
        .number-input {
            width: 60px;
            text-align: center;
            border: 1px solid var(--primary-light);
            background-color: var(--primary-light);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 0;
            border-radius: 50%;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .btn-circle:hover {
            transform: scale(1.1);
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            border-radius: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 15px;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .card {
            border-radius: 10px;
            border: 1px solid rgba(67, 97, 238, 0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.1);
        }
        
        .card-body {
            padding: 15px;
        }
        
        /* Navbar styling */
        .navbar {
            background: linear-gradient(45deg, #1d2671, #c33764);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 12px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 8px 15px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.15);
        }
        
        /* Toast styling */
        .toast {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-header {
                padding: 18px;
            }
            
            .accordion-button {
                padding: 14px 16px;
                font-size: 15px;
            }
        }
        
        /* Animation for form elements */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .accordion-item, .submit-btn {
            animation: fadeIn 0.4s ease forwards;
        }
        
        .accordion-item:nth-child(1) { animation-delay: 0.1s; }
        .accordion-item:nth-child(2) { animation-delay: 0.2s; }
        .accordion-item:nth-child(3) { animation-delay: 0.3s; }
        .accordion-item:nth-child(4) { animation-delay: 0.4s; }
        .submit-btn { animation-delay: 0.5s; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-broom me-2"></i>CleaningApp
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#enhancedNavbar" aria-controls="enhancedNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="enhancedNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('questionnaire1.index')}}">
                            <i class="fa-solid fa-grid-horizontal me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('questionnaire2.create')}}">
                            <i class="fa-solid fa-plus me-1"></i> Create
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('questionnaire2.notes')}}">
                            <i class="fa-solid fa-check me-1"></i> Delivered
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="fa-solid fa-user me-1"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container py-4 main-container">
    <div class="card shadow-lg form-card">
        <div class="card-header text-white text-center">
            <h3 class="mb-0">Linen Provision Form</h3>
        </div>
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('questionnaire2.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="accordion mb-4" id="formAccordion">
                    <!-- Basic Information -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBasic">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBasic" aria-expanded="true" aria-controls="collapseBasic">
                                <i class="fas fa-info-circle me-2"></i> Basic Information
                            </button>
                        </h2>
                        <div id="collapseBasic" class="accordion-collapse collapse show" aria-labelledby="headingBasic">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <!-- Row 1: Housekeeper Name and Unit Number -->
                                    <div class="col-6 col-md-6">
                                        <label class="form-label"> Name</label>
                                        <input type="text" name="housekeeper_name" class="form-control" value="{{ Auth::user()->name }}" readonly style="background-color: #f0f4ff; border: 1px solid rgba(67, 97, 238, 0.2);">
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <label class="form-label">Unit Number</label>
                                        <input type="text" name="unit_number" class="form-control">
                                    </div>
                                    <!-- Row 2: Service Type and Status Remarks -->
                                    <div class="col-6 col-md-6">
                                        <label class="form-label">Service Type</label>
                                        <select name="service_type" class="form-select">
                                            <option value="Scheduled Cleaning">Scheduled Cleaning</option>
                                            <option value="Unscheduled Cleaning">Unscheduled Cleaning</option>
                                            <option value="Paid Service">Paid Service</option>
                                        </select>
                                    </div>
                                  
                                    <div class="col-6 col-md-6">
                                        <label class="form-label">Task Date</label>
                                        <input type="date" name="task_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                 
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bed Linens -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBedLinens">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBedLinens">
                                <i class="fas fa-bed me-2"></i> Bed Linens
                            </button>
                        </h2>
                        <div id="collapseBedLinens" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                                    @foreach($items['Bed Linen'] as $item)
                                    <div class="col">
                                        <div class="card h-100 text-center">
                                            <div class="card-body p-2">
                                                <p class="mb-2 text-truncate" style="height: 2.5rem;">{{ $item }}</p>
                                                <input type="number" name="bed_linen[{{ $item }}]" value="0" class="form-control text-center" min="0" style="width: 80px; margin: 0 auto;">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bath Linens -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBathLinens">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBathLinens">
                                <i class="fas fa-bath me-2"></i> Bath Linens
                            </button>
                        </h2>
                        <div id="collapseBathLinens" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                                    @foreach($items['Bathroom Linen'] as $item)
                                        <div class="col">
                                            <div class="card h-100 text-center">
                                                <div class="card-body p-2">
                                                    <p class="mb-2">{{ $item }}</p>
                                                    <input type="number" name="bath_linen[{{ $item }}]" value="0" class="form-control text-center" min="0" style="width: 80px; margin: 0 auto;">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary submit-btn w-100 py-3">
                        <i class="fas fa-paper-plane me-2"></i> Submit Form
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> Form submitted successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle accordion exclusive opening
        const accordionButtons = document.querySelectorAll('.accordion-button');
        accordionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const currentCollapse = document.querySelector(this.getAttribute('data-bs-target'));
                const allCollapses = document.querySelectorAll('.accordion-collapse');

                allCollapses.forEach(collapse => {
                    if (collapse !== currentCollapse && collapse.classList.contains('show')) {
                        collapse.classList.remove('show');
                        const parentButton = collapse.parentElement.querySelector('.accordion-button');
                        parentButton.classList.add('collapsed');
                        parentButton.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        });

        @if(session('success'))
            const toastElement = document.getElementById('successToast');
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        @endif
    });
</script>
</body>
</html>