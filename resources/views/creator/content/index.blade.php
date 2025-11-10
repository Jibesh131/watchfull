@extends('creator.layout.app')

@push('css')
@endpush

@section('content')

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
    <!-- Filters on the Left -->
    <div class="d-flex gap-2 flex-wrap">
        <!-- Filter 1: Content Type -->
        <select class="form-select" style="width: 160px;">
            <option selected>All Types</option>
            <option>Video</option>
            <option>Audio</option>
            <option>Image</option>
        </select>

        <!-- Filter 2: Status -->
        <select class="form-select" style="width: 160px;">
            <option selected>All Status</option>
            <option>Published</option>
            <option>Draft</option>
            <option>Scheduled</option>
        </select>

        <!-- Filter 3: Date -->
        <select class="form-select" style="width: 160px;">
            <option selected>Newest First</option>
            <option>Oldest First</option>
            <option>Last 7 Days</option>
            <option>Last 30 Days</option>
        </select>
    </div>

    <!-- Add New Button on the Right -->
    <a href="{{ route('creator.add.content') }}">
        <button class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Add New
        </button>
    </a>
</div>

<div class="card-body">
    <!-- Content List -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="thumbnail.jpg" class="img-thumbnail" width="80"></td>
                    <td>My Travel Vlog</td>
                    <td>Video</td>
                    <td>Nov 10, 2025</td>
                    <td><span class="badge bg-success">Published</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('js')
@endpush