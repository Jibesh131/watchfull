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
                    @forelse ($contents as $content)
                        <tr>
                            <td>
                                <img src="{{ asset($content?->thumbnail ? 'storage/' . $content->thumbnail : 'mix/image/demo.png') }}"
                                    class="img-thumbnail" width="80">
                            </td>
                            <td>{{ $content?->title ?? '' }}</td>
                            <td>{{ $content?->type ?? '' }}</td>
                            <td>{{ format_date($content?->created_at) ?? '--' }}</td>
                            <td>
                                @php
                                    $status = $content?->status ?? '';
                                    if($status == 'published') $x = 'success';
                                    elseif ($status == 'schedule') $x = 'secondary';
                                    elseif ($status == 'draft') $x = 'dark';
                                    elseif ($status == 'hidden') $x = 'warning';
                                    elseif ($status == 'pending') $x = 'secondary-gradient';
                                    else 
                                @endphp
                                <span class="badge bg-success">Published</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-gear"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No recode found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    {{-- <script>
Swal.fire({
    title: "Good job!",
    text: "You clicked the button!",
    icon: "success",
    confirmButtonText: "Confirm Me",
    customClass: {
        confirmButton: "btn btn-success"
    },
    buttonsStyling: false
});
</script> --}}
@endpush
