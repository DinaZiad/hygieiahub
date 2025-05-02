<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housekeeping Submissions</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 0.9rem;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            border-top: none;
            white-space: nowrap;
        }
        .table td {
            vertical-align: middle;
            font-size: 0.8rem;
        }
        .avatar {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .badge {
            font-weight: 500;
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
        }
        .form-select-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.7rem;
            height: 28px;
        }
        .img-thumbnail {
            transition: transform 0.2s;
            max-width: 50px;
            max-height: 50px;
            object-fit: cover;
        }
        .img-thumbnail:hover {
            transform: scale(1.1);
        }
        .modal-body img {
            max-width: 100%;    
            height: auto;
        }
        .table-responsive {
            -webkit-overflow-scrolling: touch;
        }
        .btn-sm {
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
        }
        .form-select {
            width: 100px;
        }
        .modal-dialog {
            max-width: 90%;
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
            body {
                font-size: 0.85rem;
            }
            .img-thumbnail {
                max-width: 40px;
                max-height: 40px;
            }
            .hide-on-mobile {
                display: none;
            }
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            .btn-sm {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .form-select-sm {
                width: 100%;
                max-width: 100px;
            }
            .modal-dialog {
                max-width: 95%;
                margin: 0.5rem;
            }
            .table td, .table th {
                padding: 0.5rem;
            }
            .d-flex {
                flex-direction: column;
                align-items: stretch;
            }
            .badge {
                font-size: 0.65rem;
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
        @media (max-width: 576px) {
            .table th, .table td {
                font-size: 0.7rem;
            }
            .img-thumbnail {
                max-width: 35px;
                max-height: 35px;
            }
            .form-select-sm {
                font-size: 0.65rem;
            }
            .btn-sm {
                font-size: 0.65rem;
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
                        <a class="nav-link active" aria-current="page" href="{{route('questionnaire1.index')}}">
                            <i class="fa-solid fa-grid-horizontal"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{route('questionnaire2.create')}}">
                            <i class="fa-solid fa-plus"></i> Create
                        </a>
                    </li>
                    <li class="nav-item">
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
    <div class="container-fluid py-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h2 class="h4 font-weight-bold mb-2">
                <i class="fas fa-broom me-2"></i>Cleaned Units
            </h2>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="alert alert-info text-start">
    <i class="fas fa-user-shield me-2"></i> Welcome, {{ auth()->user()->name }}! You are logged in as an {{ auth()->user()->role }}.
  </div>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Submissions</h5>
            </div>

            <div class="card shadow-sm border-0 mb-3">
              
                <div class="card-body">
                    <form action="{{ route('questionnaire1.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <div class="col-md-4">
                                <label for="housekeeper_id" class="form-label"> by Housekeeper</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <select class="form-select" id="housekeeper_id" name="housekeeper_id">
                                        <option value="">All</option>
                                        @foreach($housekeepers as $housekeeper)
                                            <option value="{{ $housekeeper->id }}" {{ request()->get('housekeeper_id') == $housekeeper->id ? 'selected' : '' }}>
                                                {{ $housekeeper->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                    value="{{ request()->get('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                    value="{{ request()->get('end_date') }}">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <a href="{{ route('questionnaire1.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i>Reset
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0 pb-4">
                <!-- Table View (Desktop) -->
                <div class="table-view">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    {{-- <th class="text-center">Image</th> --}}
                                    <th>Submitted By</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                    <th class="hide-on-mobile">Unit</th>
                                    <th class="hide-on-mobile">Service Type</th>
                                    <th class="text-center">Items</th>
                                    <th class="hide-on-mobile">Task Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $index => $entry)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        {{-- <td class="text-center">
                                            @if($entry->image)
                                                <a href="{{ asset('storage/' . $entry->image) }}" data-bs-toggle="modal" data-bs-target="#imageModal{{ $entry->id }}">
                                                    <img src="{{ asset('storage/' . $entry->image) }}" class="rounded img-thumbnail">
                                                </a>
                                                <!-- Image Modal -->
                                                <div class="modal fade" id="imageModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Room #{{ $entry->room_number }} Image</h5>
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
                                        </td> --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <span class="avatar-title rounded-circle bg-light text-dark p-2">
                                                        {{ substr($entry->user->name ?? 'U', 0, 1) }}
                                                    </span>
                                                </div>
                                                <span>{{ $entry->user->name ?? 'Unknown' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-{{ $entry->status == 'Inspected' ? 'warning text-dark' : 'primary' }} py-2 px-3">
                                                <i class="fas {{ $entry->status == 'Inspected' ? 'fa-broom' : 'fa-check-circle' }} me-1"></i>
                                                {{ $entry->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form id="approveForm-{{ $entry->id }}" action="{{ route('questionnaire1.updateStatus', $entry->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="">
                                                @if($entry->status != 'Approved' && $entry->status != 'Inspected')
                                                    <button type="button" class="btn btn-primary btn-sm d-block d-sm-inline mb-2" onclick="confirmApproval({{ $entry->id }}, 'Approved')">
                                                        <i class="fas fa-check-circle me-1"></i> Approve
                                                    </button><link rel="icon" type="image/x-icon" href="/images/favicon.ico">
                                                    <button type="button" class="btn btn-warning btn-sm d-block d-sm-inline mb-2" onclick="confirmApproval({{ $entry->id }}, 'Inspected')">
                                                        <i class="fas fa-broom me-1"></i> Inspect
                                                    </button>
                                                @else
                                                    <span class="badge bg-success py-2 px-3">Done</span>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="hide-on-mobile">
                                            <span class="badge bg-primary bg-opacity-10 text-primary">Unit: {{ $entry->unit_number }}</span>
                                        </td>
                                        <td class="hide-on-mobile">
                                            <span class="badge bg-info bg-opacity-10 text-info">{{ $entry->service_type }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($entry->provided_items) && is_array(json_decode($entry->provided_items, true)))
                                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#itemsModal{{ $entry->id }}">
                                                    View Items
                                                </button>
                                                <!-- Items Modal -->
                                                <div class="modal fade" id="itemsModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Items for Unit #{{ $entry->unit_number }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Provided Items:</h6>
                                                                <ul>
                                                                    @foreach(json_decode($entry->provided_items, true) ?? [] as $item => $quantity)
                                                                        @if($quantity > 0)
                                                                            <li>{{ $item }}: {{ $quantity }}</li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                                <h6>Removed Items:</h6>
                                                                <ul>
                                                                    @foreach(json_decode($entry->removed_items, true) ?? [] as $item => $quantity)
                                                                        @if($quantity > 0)
                                                                            <li>{{ $item }}: {{ $quantity }}</li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary">No items</span>
                                            @endif
                                        </td>
                                        <td class="hide-on-mobile">
                                            <span class="badge bg-light text-dark">Task Date: {{ $entry->task_date }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
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
                <!-- Card View (Mobile) -->
                <div class="card-view">
                    <div class="card-body p-0">
                        @forelse($entries as $index => $entry)
                            <div class="entry-card">
                                <div class="card-header">
                                    <span class="fw-bold">Entry #{{ $index + 1 }}</span>
                                    <span class="badge rounded-pill bg-{{ $entry->status == 'Inspected' ? 'warning text-dark' : 'primary' }} py-2 px-3">
                                        <i class="fas {{ $entry->status == 'Inspected' ? 'fa-broom' : 'fa-check-circle' }} me-1"></i>
                                        {{ $entry->status }}
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
                                                        <h5 class="modal-title">Room #{{ $entry->room_number }} Image</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $entry->image) }}" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary d-block mb-2">No image</span>
                                    @endif
                                    <div class="entry-info">
                                        <div class="mobile-info-row">
                                            <span class="mobile-label">Submitted By:</span>
                                            <div class="d-flex align-items-center">
                                                <span>{{ $entry->user->name ?? 'Unknown' }}</span>
                                            </div>
                                        </div>
                                        <div class="mobile-info-row">
                                            <span class="mobile-label">Unit:</span>
                                            <span class="badge bg-primary bg-opacity-10 text-primary">Unit: {{ $entry->unit_number }}</span>
                                        </div>
                                        <div class="mobile-info-row">
                                            <span class="mobile-label">Task Date:</span>
                                            <span class="badge bg-light text-dark">{{ $entry->task_date }}</span>
                                        </div>
                                        <div class="mobile-info-row d-flex ">
                                            <div class="d-flex justify-content-start align-items-center">
                                            <button class="btn btn-sm btn-primary " style="width: 50%;" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $entry->id }}">
                                                <i class="fas fa-eye me-1"></i> View Details
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="entry-actions">
                                        <form id="approveForm-mobile-{{ $entry->id }}" action="{{ route('questionnaire1.updateStatus', $entry->id) }}" method="POST" class="d-flex align-items-center mb-3 gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="">
                                            <span class="mobile-label">Action:</span>
                                            @if($entry->status != 'Approved' && $entry->status != 'Inspected')
                                                <button type="button" class="btn btn-primary btn-sm" onclick="confirmApprovalMobile({{ $entry->id }}, 'Approved')">
                                                    <i class="fas fa-check-circle me-1"></i> Approve
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="confirmApprovalMobile({{ $entry->id }}, 'Inspected')">
                                                    <i class="fas fa-broom me-1"></i> Inspect
                                                </button>
                                            @else
                                                <span class="badge bg-success py-2 px-3">Done</span>
                                            @endif
                                        </form>
                                    </div>
                                    <!-- Mobile Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $entry->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Unit #{{ $entry->unit_number }} Details</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Images Column -->
                                                        <div class="col-md-6 mb-4">
                                                            <h6 class="text-primary mb-3"><i class="fas fa-images me-2"></i>Images</h6>
                                                            <div class="row g-2">
                                                                @if(!empty($entry->images) && is_array(json_decode($entry->images, true)))
                                                                    @foreach(json_decode($entry->images, true) as $image)
                                                                        <div class="col-6 col-md-4">
                                                                            <a href="{{ asset('storage/' . $image) }}" data-bs-toggle="modal" data-bs-target="#imageModal{{ $entry->id . '_' . $loop->index }}">
                                                                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Uploaded image">
                                                                            </a>
                                                                            <!-- Image Modal -->
                                                                            <div class="modal fade" id="imageModal{{ $entry->id . '_' . $loop->index }}" tabindex="-1" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title">Unit #{{ $entry->unit_number }} Image</h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body text-center">
                                                                                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-12 text-center py-4">
                                                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                                                        <p class="text-muted">No images uploaded</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Items Column -->
                                                        <div class="col-md-6">
                                                            <div class="accordion" id="detailsAccordion{{ $entry->id }}">
                                                                <!-- Provided Items -->
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#providedItems{{ $entry->id }}">
                                                                            <i class="fas fa-plus-circle me-2"></i>Provided Items
                                                                        </button>
                                                                    </h2>
                                                                    <div id="providedItems{{ $entry->id }}" class="accordion-collapse collapse">
                                                                        <div class="accordion-body">
                                                                            @if(!empty($entry->provided_items) && is_array(json_decode($entry->provided_items, true)))
                                                                                <ul class="list-group">
                                                                                    @foreach(json_decode($entry->provided_items, true) ?? [] as $item => $quantity)
                                                                                        @if($quantity > 0)
                                                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                                {{ $item }}
                                                                                                <span class="badge bg-primary rounded-pill">{{ $quantity }}</span>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            @else
                                                                                <p class="text-muted text-center py-3">No provided items</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Removed Items -->
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#removedItems{{ $entry->id }}">
                                                                            <i class="fas fa-minus-circle me-2"></i>Removed Items
                                                                        </button>
                                                                    </h2>
                                                                    <div id="removedItems{{ $entry->id }}" class="accordion-collapse collapse">
                                                                        <div class="accordion-body">
                                                                            @if(!empty($entry->removed_items) && is_array(json_decode($entry->removed_items, true)))
                                                                                <ul class="list-group">
                                                                                    @foreach(json_decode($entry->removed_items, true) ?? [] as $item => $quantity)
                                                                                        @if($quantity > 0)
                                                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                                {{ $item }}
                                                                                                <span class="badge bg-danger rounded-pill">{{ $quantity }}</span>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            @else
                                                                                <p class="text-muted text-center py-3">No removed items</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Tasks -->
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tasks{{ $entry->id }}">
                                                                            <i class="fas fa-tasks me-2"></i>Tasks
                                                                        </button>
                                                                    </h2>
                                                                    <div id="tasks{{ $entry->id }}" class="accordion-collapse collapse">
                                                                        <div class="accordion-body">
                                                                            <div class="row">
                                                                                <!-- Bedroom Tasks -->
                                                                                <div class="col-12 mb-3">
                                                                                    <h6 class="text-primary mb-2"><i class="fas fa-bed me-2"></i>Bedroom Tasks</h6>
                                                                                    <ul class="list-group">
                                                                                        @foreach(json_decode($entry->bedroom_tasks, true) ?? [] as $task)
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                                                    <label class="form-check-label">{{ $task }}</label>
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                                <!-- Bathroom Tasks -->
                                                                                <div class="col-12 mb-3">
                                                                                    <h6 class="text-primary mb-2"><i class="fas fa-bath me-2"></i>Bathroom Tasks</h6>
                                                                                    <ul class="list-group">
                                                                                        @foreach(json_decode($entry->bathroom_tasks, true) ?? [] as $task)
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                                                    <label class="form-check-label">{{ $task }}</label>
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                                <!-- General Tasks -->
                                                                                <div class="col-12">
                                                                                    <h6 class="text-primary mb-2"><i class="fas fa-tasks me-2"></i>General Tasks</h6>
                                                                                    <ul class="list-group">
                                                                                        @foreach(json_decode($entry->general_tasks, true) ?? [] as $task)
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                                                    <label class="form-check-label">{{ $task }}</label>
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        function confirmApproval(entryId, status) {
            Swal.fire({
                title: 'Confirm Action',
                text: `Are you sure you want to ${status.toLowerCase()} this entry?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${status.toLowerCase()} it!`
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('approveForm-' + entryId);
                    form.querySelector('input[name="status"]').value = status; // Set the status dynamically
                    form.submit();
                    Swal.fire(
                        'Processing!',
                        `The entry is being ${status.toLowerCase()}ed.`,
                        'success'
                    );
                }
            });
        }

        function confirmApprovalMobile(entryId, status) {
            Swal.fire({
                title: 'Confirm Action',
                text: `Are you sure you want to ${status.toLowerCase()} this entry?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${status.toLowerCase()} it!`
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('approveForm-mobile-' + entryId);
                    form.querySelector('input[name="status"]').value = status; // Set the status dynamically
                    form.submit();
                    Swal.fire(
                        'Processing!',
                        `The entry is being ${status.toLowerCase()}ed.`,
                        'success'
                    );
                }
            });
        }
    </script>
</body>
</html>