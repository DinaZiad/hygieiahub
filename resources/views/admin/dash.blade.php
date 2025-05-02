<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <style>
    body {
      font-size: 0.9rem;
      background-color: #f8f9fa;
    }
    .navbar {
      background: linear-gradient(45deg, #1d2671, #c33764) !important;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .navbar-brand {
      font-size: 1.2rem;
    }
    .navbar-toggler {
      border: none;
    }
    .navbar-toggler-icon {
      background-color: #fff;
      border-radius: 5px;
    }
    .container {
      padding-top: 2rem;
      padding-bottom: 2rem;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .card-header {
      background-color: #fff;
      border-bottom: 1px solid #eee;
      padding: 1rem 1.5rem;
      font-weight: bold;
      color: #333;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .card-body {
      padding: 1.5rem;
    }
    .card-title {
      font-size: 1.1rem;
      margin-bottom: 0.8rem;
      color: #555;
    }
    .card-text {
      font-size: 1.5rem;
      color: #333;
      font-weight: bold;
    }
    .table {
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .table thead th {
      background-color: #f0f0f0;
      border-bottom: 2px solid #ddd;
      font-weight: 600;
      color: #333;
      font-size: 0.9rem;
    }
    .table tbody td {
      border-bottom: 1px solid #eee;
      color: #555;
      font-size: 0.85rem;
    }
    .btn-sm, .btn, .form-select-sm {
      font-size: 0.8rem;
      padding: 0.4rem 0.7rem;
      border-radius: 5px;
    }
    .alert {
      border-radius: 8px;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
    }
    .table-responsive {
      overflow-x: auto;
    }

    /* Mobile adjustments */
    @media (max-width: 767px) {
      .container {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      h1 {
        font-size: 1.6rem;
        text-align: center;
      }
      h2 {
        font-size: 1.3rem;
        text-align: center;
      }
      .d-flex.justify-content-end {
        justify-content: center !important;
      }
      .btn-lg {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        width: 100%;
      }
      .card-title {
        font-size: 1rem;
      }
      .card-text {
        font-size: 1.3rem;
      }
      .table th, .table td {
        font-size: 0.8rem;
        white-space: nowrap;
      }
      .d-flex.gap-2 {
        flex-direction: column !important;
        align-items: stretch !important;
      }
      .form-select-sm, .btn-sm {
        width: 100%;
      }
      form.d-flex {
        flex-direction: column !important;
      }
      .col-3 {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-broom me-2"></i>CleaningApp Admin
        </a>
        <div class="d-flex">
            <form method="POST" action="{{ route('logout') }} ">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm confirm-logout">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-4">
  <h1 class="mb-4">Admin Dashboard</h1>

  <div class="alert alert-info text-start">
    <i class="fas fa-user-shield me-2"></i> Welcome, {{ auth()->user()->name }}! You are logged in as an admin.
  </div>

  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('export.report') }}" class="btn btn-success btn-lg">
      <i class="fas fa-file-excel me-2"></i> Export to Excel
    </a>
  </div>
  

  <h2 class="mt-4">Housekeeping Submission Statistics</h2>

  <div class="row g-3">
    <div class="col-md-6 col-lg-3">
      <div class="card bg-primary text-white shadow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h5 class="card-title"><i class="fas fa-search me-2"></i> Inspected</h5>
            <p class="card-text">{{ $inspectedQues }}</p>
          </div>
          <i class="fas fa-eye fa-3x opacity-50"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="card bg-success text-white shadow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h5 class="card-title"><i class="fas fa-check-circle me-2"></i> Approved</h5>
            <p class="card-text">{{ $approvedQues }}</p>
          </div>
          <i class="fas fa-thumbs-up fa-3x opacity-50"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="card bg-info text-white shadow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h5 class="card-title"><i class="fas fa-truck me-2"></i> Delivered</h5>
            <p class="card-text">{{ $deliveredQues }}</p>
          </div>
          <i class="fas fa-check-double fa-3x opacity-50"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="card bg-warning text-dark shadow">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h5 class="card-title"><i class="fas fa-exclamation-triangle me-2"></i> Partially Delivered</h5>
            <p class="card-text">{{ $partiallyDeliveredQues }}</p>
          </div>
          <i class="fas fa-hourglass-half fa-3x opacity-50"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3 mt-4">
  <!-- Card 1: Today's Submissions -->
  <div class="col-12 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0">Today's Submissions</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <!-- Cleaned Units -->
          <div class="col-6">
            <div class="d-flex align-items-center">
              <div class="me-2">
                <i class="fas fa-house-user text-primary" style="font-size: 2rem;"></i>
              </div>
              <div>
                <h6 class="mb-1 small">Cleaned Units</h6>
                <p class="mb-0 text-muted small">{{ $todayQues1 }} submissions</p>
              </div>
            </div>
          </div>
          <!-- Requested Linen -->
          <div class="col-6">
            <div class="d-flex align-items-center">
              <div class="me-2">
                <i class="fas fa-bed text-success" style="font-size: 2rem;"></i>
              </div>
              <div>
                <h6 class="mb-1 small">Requested Linen</h6>
                <p class="mb-0 text-muted small">{{ $todayQues2 }} submissions </p>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 2: Total Submissions -->
  <div class="col-12 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="mb-0">Total Submissions</h5>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <!-- Cleaned Units Total -->
          <div class="col-6">
            <div class="d-flex align-items-center">
              <div class="me-2">
                <i class="fas fa-house-user text-primary" style="font-size: 2rem;"></i>
              </div>
              <div>
                <h6 class="mb-1 small">Cleaned Units</h6>
                <p class="mb-0 text-muted small">{{ $ques1->count() }} total submissions</p>
              </div>
            </div>
          </div>
          <!-- Requested Linen Total -->
          <div class="col-6">
            <div class="d-flex align-items-center">
              <div class="me-2">
                <i class="fas fa-bed text-success" style="font-size: 2rem;"></i>
              </div>
              <div>
                <h6 class="mb-1 small">Requested Linen</h6>
                <p class="mb-0 text-muted small">{{ $ques2->count() }} total submissions</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Statistics Cards -->
          
          <!-- Users Table -->
          <div class="mt-4">
            <h2 class="mb-3">Users</h2>
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $index => $user)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->role }}</td>
                      <td>
                        <div class="d-flex gap-2">
                          <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 200px;">
                              <option value="" {{ !$user->role ? 'selected' : '' }}>Select Role</option>
                              <option value="housekeeper" {{ $user->role == 'housekeeper' ? 'selected' : '' }}>Housekeeper</option>
                              <option value="supervisor" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                              <option value="laundry" {{ $user->role == 'laundry' ? 'selected' : '' }}>Laundry</option>
                            </select>
                          </form>
                          <form action="{{ route('users.delete', $user->id) }}" method="POST" class="confirm-delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <!-- Search Form and Tables -->
          <div class="mt-5">
            <form action="{{ route('admin.dash') }}" method="GET" class="mb-4">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by unit number..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search"></i> Search
                </button>
                @if(request('search'))
                  <a href="{{ route('admin.dash') }}" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Reset
                  </a>
                @endif
              </div>
            </form>

            <!-- Requested Linen Table -->
            <div class="mb-4">
              <h2 class="mb-3">Requested Linen</h2>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Unit Number</th>
                      <th>User</th>
                      <th>Status</th>
                      <th>Submitted At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ques2 as $ques)
                      <tr>
                        <td>{{ $ques->unit_number }}</td>
                        <td>{{ $ques->user->name }}</td>
                        <td>
                          <span class="badge bg-{{ $ques->status === 'Approved' ? 'success' : ($ques->status === 'Delivered' ? 'info' : 'warning') }}">
                            {{ $ques->status ?? ' - - - - - - - ' }}
                          </span>
                        </td>
                        <td>{{ $ques->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                          <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModalQ2{{ $ques->id }}">
                              <i class="fas fa-eye me-1"></i> View Details
                            </button>
                            <form action="{{ route('questionnaire2.delete', $ques->id) }}" method="POST" class="confirm-delete-form d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      <!-- Questionnaire 2 Details Modal -->
                      <div class="modal fade" id="detailsModalQ2{{ $ques->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                              <h5 class="modal-title">Unit #{{ $ques->unit_number }} Details (Questionnaire 2)</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <!-- Left column: Linens -->
                                <div class="col-md-6 mb-4">
                                  <h6 class="text-primary mb-3"><i class="fas fa-bed me-2"></i>Linens</h6>
                                  <div class="accordion" id="linensAccordionQ2{{ $ques->id }}">
                                    <!-- Bed Linen -->
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bedLinenQ2{{ $ques->id }}">
                                          <i class="fas fa-bed me-2"></i>Bed Linen
                                        </button>
                                      </h2>
                                      <div id="bedLinenQ2{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          @if(!empty($ques->bed_linen) && is_array(json_decode($ques->bed_linen, true)))
                                            <ul class="list-group">
                                              @foreach(json_decode($ques->bed_linen, true) ?? [] as $item => $quantity)
                                                @if($quantity > 0)
                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $item }}
                                                    <span class="badge bg-primary rounded-pill">{{ $quantity }}</span>
                                                  </li>
                                                @endif
                                              @endforeach
                                            </ul>
                                          @else
                                            <p class="text-muted text-center py-3">No bed linen items</p>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <!-- Bath Linen -->
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bathLinenQ2{{ $ques->id }}">
                                          <i class="fas fa-bath me-2"></i>Bath Linen
                                        </button>
                                      </h2>
                                      <div id="bathLinenQ2{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          @if(!empty($ques->bath_linen) && is_array(json_decode($ques->bath_linen, true)))
                                            <ul class="list-group">
                                              @foreach(json_decode($ques->bath_linen, true) ?? [] as $item => $quantity)
                                                @if($quantity > 0)
                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $item }}
                                                    <span class="badge bg-primary rounded-pill">{{ $quantity }}</span>
                                                  </li>
                                                @endif
                                              @endforeach
                                            </ul>
                                          @else
                                            <p class="text-muted text-center py-3">No bath linen items</p>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <!-- Right column: Info -->
                                <div class="col-md-6">
                                  <div class="accordion" id="infoAccordionQ2{{ $ques->id }}">
                                    <!-- Service Type -->
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#serviceTypeQ2{{ $ques->id }}">
                                          <i class="fas fa-info-circle me-2"></i>Service Type
                                        </button>
                                      </h2>
                                      <div id="serviceTypeQ2{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          <p class="mb-0">{{ $ques->service_type ?? 'Not specified' }}</p>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <!-- Note -->
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#noteQ2{{ $ques->id }}">
                                          <i class="fas fa-sticky-note me-2"></i>Note
                                        </button>
                                      </h2>
                                      <div id="noteQ2{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          <p class="mb-0">{{ $ques->note ?? 'No note provided' }}</p>
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
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Cleaned Units Table -->
            <div>
              <h2 class="mb-3">Cleaned Units</h2>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Unit Number</th>
                      <th>User</th>
                      <th>Status</th>
                      <th>Submitted At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ques1 as $ques)
                      <tr>
                        <td>{{ $ques->unit_number }}</td>
                        <td>{{ $ques->user->name }}</td>
                        <td>
                          <span class="badge bg-{{ $ques->status === 'Inspected' ? 'success' : 'primary' }}">
                            {{ $ques->status ?? ' - - - - - - - ' }}
                          </span>
                        </td>
                        <td>{{ $ques->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                          <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModalQ1{{ $ques->id }}">
                              <i class="fas fa-eye me-1"></i> View Details
                            </button>
                            <form action="{{ route('questionnaire1.delete', $ques->id) }}" method="POST" class="confirm-delete-form d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i> Delete
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      <!-- Questionnaire 1 Details Modal -->
                      <div class="modal fade" id="detailsModalQ1{{ $ques->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                              <h5 class="modal-title">Unit #{{ $ques->unit_number }} Details (Questionnaire 1)</h5>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <!-- Left column: Images -->
                                <div class="col-md-6 mb-4">
                                  <h6 class="text-primary mb-3"><i class="fas fa-images me-2"></i>Images</h6>
                                  <div class="row g-2">
                                    @if(!empty($ques->image))
                                      @foreach(json_decode($ques->image, true) as $image)
                                        <div class="col-6 col-md-4">
                                          <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Uploaded image">
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
                                
                                <!-- Right column: Details -->
                                <div class="col-md-6">
                                  <div class="accordion" id="detailsAccordionQ1{{ $ques->id }}">
                                    <!-- Provided Items -->
                                    <div class="accordion-item">
                                      <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#providedItemsQ1{{ $ques->id }}">
                                          <i class="fas fa-plus-circle me-2"></i>Provided Items
                                        </button>
                                      </h2>
                                      <div id="providedItemsQ1{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          @if(!empty($ques->provided_items) && is_array(json_decode($ques->provided_items, true)))
                                            <ul class="list-group">
                                              @foreach(json_decode($ques->provided_items, true) ?? [] as $item => $quantity)
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#removedItemsQ1{{ $ques->id }}">
                                          <i class="fas fa-minus-circle me-2"></i>Removed Items
                                        </button>
                                      </h2>
                                      <div id="removedItemsQ1{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          @if(!empty($ques->removed_items) && is_array(json_decode($ques->removed_items, true)))
                                            <ul class="list-group">
                                              @foreach(json_decode($ques->removed_items, true) ?? [] as $item => $quantity)
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tasksQ1{{ $ques->id }}">
                                          <i class="fas fa-tasks me-2"></i>Tasks
                                        </button>
                                      </h2>
                                      <div id="tasksQ1{{ $ques->id }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                          <div class="row">
                                            <!-- Bedroom Tasks -->
                                            <div class="col-12 mb-3">
                                              <h6 class="text-primary mb-2"><i class="fas fa-bed me-2"></i>Bedroom Tasks</h6>
                                              <ul class="list-group">
                                                @foreach(json_decode($ques->bedroom_tasks, true) ?? [] as $task)
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
                                                @foreach(json_decode($ques->bathroom_tasks, true) ?? [] as $task)
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
                                                @foreach(json_decode($ques->general_tasks, true) ?? [] as $task)
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
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.confirm-delete-form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "This action cannot be undone!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });

    document.querySelectorAll('.confirm-logout').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        Swal.fire({
          title: 'Logout?',
          text: "Are you sure you want to log out?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, log out',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>
  
</body>
</html>
