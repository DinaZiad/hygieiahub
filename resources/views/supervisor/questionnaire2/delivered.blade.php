<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linen Provision Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-top: none;
        }
        .avatar {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .badge {
            font-weight: 500;
        }
        .form-select-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        .img-thumbnail {
            transition: transform 0.2s;
        }
        .img-thumbnail:hover {
            transform: scale(1.1);
        }
        
        /* Mobile-specific styles */
        @media (max-width: 767px) {
            .table-view {
                display: none;
            }
            .card-view {
                display: block;
            }
            .entry-card {
                margin-bottom: 1rem;
                border: 1px solid rgba(0,0,0,.125);
                border-radius: 10px;
            }
            .entry-card .card-header {
                background-color: #f8f9fa;
                padding: 10px 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .entry-card .card-body {
                padding: 15px;
            }
            .entry-card .entry-info {
                margin-bottom: 10px;
            }
            .entry-card .entry-actions {
                border-top: 1px solid #dee2e6;
                padding-top: 12px;
                margin-top: 10px;
            }
            .mobile-img {
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-radius: 8px;
                margin-bottom: 10px;
            }
            .mobile-info-row {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid #f0f0f0;
                padding: 6px 0;
            }
            .mobile-info-row:last-child {
                border-bottom: none;
            }
            .mobile-label {
                font-weight: bold;
                color: #6c757d;
            }
        }
        
        /* Desktop-specific styles */
        @media (min-width: 768px) {
            .table-view {
                display: block;
            }
            .card-view {
                display: none;
            }
        }
    </style>
    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(45deg, #1d2671, #c33764); box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
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
                        <a class="nav-link " aria-current="page" href="{{route('questionnaire1.index')}}">
                            <i class="fa-solid fa-grid-horizontal"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " aria-current="page" href="{{route('questionnaire2.create')}}">
                            <i class="fa-solid fa-plus"></i> Create
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link " href="{{route('questionnaire2.notes')}}">
                            <i class="fa-solid fa-check"></i> Delivered
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="fa-solid fa-user"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="h4 font-weight-bold mb-0">
                <i class="fas fa-broom me-2"></i>Linen Provision Submissions
            </h2>

        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table View (Desktop) -->
        <div class="table-view">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap">
                    <h5 class="mb-0">Delivered Submissions</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th>Submitted By</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Service Type</th>
                                    <th class="text-center">Items</th>
                                    <th class="text-center">Task Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $index => $entry)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            @if($entry->image)
                                                <a href="{{ asset('storage/' . $entry->image) }}" data-bs-toggle="modal" data-bs-target="#imageModal{{ $entry->id }}">
                                                    <img src="{{ asset('storage/' . $entry->image) }}" class="rounded img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                </a>
                                                <!-- Image Modal -->
                                                <div class="modal fade" id="imageModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Room #{{ $entry->unit_number }} Image</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('storage/' . $entry->image) }}" class="img-fluid rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary">No image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <span class="avatar-title rounded-circle bg-light text-dark p-2">
                                                        {{ substr($entry->housekeeper_name ?? 'U', 0, 1) }}
                                                    </span>
                                                </div>
                                                <span>{{ $entry->housekeeper_name ?? 'Unknown' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-{{ $entry->status == 'partially deliver' ? 'warning text-dark' : 'success' }} py-2 px-3">
                                                <i class="fas {{ $entry->status == 'delivered' ? 'fa-broom' : 'fa-check-circle' }} me-1"></i>
                                                {{ $entry->status ?? 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('questionnaire2.updateStatus', $entry->id) }}" method="POST" class="d-flex align-items-center flex-wrap gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm" style="width: 130px;">
                                                    <option value="delivered" {{ $entry->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                    <option value="partially deliver" {{ $entry->status == 'partially deliver' ? 'selected' : '' }}>Partially</option>
                                                </select>
                                                <input type="hidden" name="entry_id" value="{{ $entry->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            @if($entry->status == 'partially deliver')
                                                <form action="{{ route('questionnaire2.submitNote', $entry->id) }}" method="POST" class="d-flex flex-column mt-2" id="noteForm">
                                                    @csrf
                                                    <textarea name="note" class="form-control mb-2" rows="2" placeholder="Leave a note..." style="font-size: 0.8rem; padding: 0.2rem;">{{ $entry->note }}</textarea>
                                                    <button type="submit" class="btn btn-primary btn-sm align-self-end">
                                                        <i class="fas fa-paper-plane"></i> 
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">Unit: {{ $entry->unit_number }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info bg-opacity-10 text-info">{{ $entry->service_type }}</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#linenModal{{ $entry->id }}">
                                                View Linen
                                            </button>
                                            <!-- Linen Modal -->
                                            <div class="modal fade" id="linenModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Linen Details for Unit #{{ $entry->unit_number }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Bed Linen:</h6>
                                                            <ul>
                                                                @foreach(json_decode($entry->bed_linen, true) ?? [] as $item => $quantity)
                                                                    @if($quantity > 0)
                                                                        <li>{{ $item }}: {{ $quantity }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                            <h6>Bath Linen:</h6>
                                                            <ul>
                                                                @foreach(json_decode($entry->bath_linen, true) ?? [] as $item => $quantity)
                                                                    @if($quantity > 0)
                                                                        <li>{{ $item }}: {{ $quantity }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">{{ $entry->task_date }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No submissions yet</h5>
                                                <p class="text-muted mb-0">When submissions are made, they'll appear here</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card View (Mobile) -->
        <div class="card-view">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Recent Submissions</h5>
                </div>
                <div class="card-body p-0">
                    @forelse($entries as $index => $entry)
                        <div class="entry-card">
                            <div class="card-header">
                                <span class="fw-bold">Entry #{{ $index + 1 }}</span>
                                <span class="badge rounded-pill bg-{{ $entry->status == 'partially deliver' ? 'warning text-dark' : 'success' }} py-2 px-3">
                                    <i class="fas {{ $entry->status == 'delivered' ? 'fa-broom' : 'fa-check-circle' }} me-1"></i>
                                    {{ $entry->status ?? 'Pending' }}
                                </span>
                            </div>
                            <div class="card-body">
                                @if($entry->image)
                                    <a href="{{ asset('storage/' . $entry->image) }}" data-bs-toggle="modal" data-bs-target="#mobileImageModal{{ $entry->id }}">
                                        <img src="{{ asset('storage/' . $entry->image) }}" class="mobile-img">
                                    </a>
                                    <!-- Mobile Image Modal -->
                                    <div class="modal fade" id="mobileImageModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Room #{{ $entry->unit_number }} Image</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $entry->image) }}" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="entry-info">
                                    <div class="mobile-info-row">
                                        <span class="mobile-label">Submitted By:</span>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-title rounded-circle bg-light text-dark p-2">
                                                    {{ substr($entry->housekeeper_name ?? 'U', 0, 1) }}
                                                </span>
                                            </div>
                                            <span>{{ $entry->housekeeper_name ?? 'Unknown' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mobile-info-row">
                                        <span class="mobile-label">Unit:</span>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">Unit: {{ $entry->unit_number }}</span>
                                    </div>
                                    
                                    <div class="mobile-info-row">
                                        <span class="mobile-label">Service Type:</span>
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $entry->service_type }}</span>
                                    </div>
                                    
                                    <div class="mobile-info-row">
                                        <span class="mobile-label">Task Date:</span>
                                        <span class="badge bg-light text-dark">{{ $entry->task_date }}</span>
                                    </div>
                                    
                                    <div class="mobile-info-row">
                                        <span class="mobile-label">Linen Items:</span>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mobileLinen{{ $entry->id }}">
                                            View Items
                                        </button>
                                        <!-- Mobile Linen Modal -->
                                        <div class="modal fade" id="mobileLinen{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Linen Details for Unit #{{ $entry->unit_number }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Bed Linen:</h6>
                                                        <ul>
                                                            @foreach(json_decode($entry->bed_linen, true) ?? [] as $item => $quantity)
                                                                @if($quantity > 0)
                                                                    <li>{{ $item }}: {{ $quantity }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                        <h6>Bath Linen:</h6>
                                                        <ul>
                                                            @foreach(json_decode($entry->bath_linen, true) ?? [] as $item => $quantity)
                                                                @if($quantity > 0)
                                                                    <li>{{ $item }}: {{ $quantity }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="entry-actions">
                                    <form action="{{ route('questionnaire2.updateStatus', $entry->id) }}" method="POST" class="d-flex align-items-center mb-3 gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <span class="mobile-label">Status:</span>
                                        <select name="status" class="form-select">
                                            <option value="delivered" {{ $entry->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="partially deliver" {{ $entry->status == 'partially deliver' ? 'selected' : '' }}>Partially</option>
                                        </select>
                                        <input type="hidden" name="entry_id" value="{{ $entry->id }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> 
                                        </button>
                                    </form>
                                    
                                    @if($entry->status == 'partially deliver')
                                        <form action="{{ route('questionnaire2.submitNote', $entry->id) }}" method="POST" class="d-flex flex-column">
                                            @csrf
                                            <label class="mobile-label mb-2">Note:</label>
                                            <textarea name="note" class="form-control mb-2" rows="2" placeholder="Leave a note...">{{ $entry->note }}</textarea>
                                            <button type="submit" class="btn btn-primary align-self-end">
                                                <i class="fas fa-paper-plane"></i> Submit
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No submissions yet</h5>
                                <p class="text-muted mb-0">When submissions are made, they'll appear here</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
        document.getElementById('noteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You're about to send this note!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            this.submit();
            Swal.fire(
                'Sent!',
                'Your note has been sent successfully.',
                'success'
            )
        }
    })
});
    </script>
</body>
</html>