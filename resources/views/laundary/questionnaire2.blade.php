<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"="width=device-width, initial-scale=1.0">
    <title>Housekeeping Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 font-weight-bold mb-0">
                <i class="fas fa-broom me-2"></i>Housekeeping Submissions
            </h2>
            <div class="d-flex">
                <button class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-1"></i> New Submission
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Submissions</h5>
                {{-- <div class="d-flex">
                    <div class="input-group input-group-sm me-2" style="width: 200px;">
                        <span class="input-group-text bg-transparent"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <select class="form-select form-select-sm" style="width: 150px;">
                        <option>Filter by Status</option>
                        <option>Clean</option>
                        <option>Inspected</option>
                    </select>
                </div> --}}
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
                                <th>Unit</th>
                                <th>Service Type</th>
                                <th>Status Remarks</th>
                                <th class="text-center">Items</th>
                                <th>Task Date</th>
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
                                    </td>
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
                                        <span class="badge rounded-pill bg-{{ $entry->status == 'Inspected' ? 'warning text-dark' : 'success' }} py-2 px-3">
                                            <i class="fas {{ $entry->status == 'Inspected' ? 'fa-broom' : 'fa-check-circle' }} me-1"></i>
                                            {{ $entry->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('questionnaire1.updateStatus', $entry->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm me-2" style="width: 120px;">
                                                <option value="ِApprove" {{ $entry->status == 'Approve' ? 'selected' : '' }}>Approve</option>
                                                <option value="Inspected" {{ $entry->status == 'Inspected' ? 'selected' : '' }}>Inspected</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">Unit: {{ $entry->unit_number }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $entry->service_type }}</span>
                                    </td>
                                    <td class="text-truncate" style="max-width: 200px;" title="{{ $entry->status_remarks }}">
                                        {{ $entry->status_remarks ?: 'No remarks' }}
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
                                    <td>
                                        <span class="badge bg-light text-dark">Task Date: {{ $entry->task_date }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        })
    </script>
</body>
</html>