<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
            <form method="POST" class="confirm-delete-form" action="{{ route('logout') }} ">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
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

  <h2 class="mt-5">Users</h2>

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
                  <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
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

  <h2 class="mt-4 text-center text-md-start">Questionnaire One</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Housekeeper Name</th>
                    <th>Unit Number</th>
                    <th>Service Type</th>
                    <th>Status Remarks</th>
                    <th>Task Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ques1 as $index => $entry)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry->housekeeper_name }}</td>
                        <td>{{ $entry->unit_number }}</td>
                        <td>{{ $entry->service_type }}</td>
                        <td>{{ $entry->status_remarks }}</td>
                        <td>{{ $entry->task_date }}</td>
                        <td>
                            <form action="{{ route('questionnaire1.delete', $entry->id) }}" method="POST" class="confirm-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete</button>
                              </form>
                              
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="mt-4 text-center text-md-start">Questionnaire Two</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Housekeeper Name</th>
                    <th>Role</th>
                    <th>Service Type</th>
                    <th>Status</th>
                    <th>Task Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ques2 as $index => $entry)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry->housekeeper_name }}</td>
                        <td>{{ $entry->role }}</td>
                        <td>{{ $entry->service_type }}</td>
                        <td>{{ $entry->status }}</td>
                        <td>{{ $entry->task_date }}</td>
                        <td>
                            <form action="{{ route('questionnaire2.delete', $entry->id) }}" method="POST" class="confirm-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete</button>
                              </form>
                              
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
  </script>
  
</body>
</html>
