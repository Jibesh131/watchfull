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
        <a href="{{ route('creator.content.add') }}">
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
                            <td>
                                <p>{{ setLengthLimit($content?->title, 15) }}</p>
                            </td>
                            <td>
                                <span class="text-capitalize">{{ $content?->type ?? '' }}</span>
                            </td>
                            <td>
                                <span>{{ format_date($content?->created_at, 'jS M, Y') ?? '--' }}</span>
                            </td>
                            <td>
                                @php
                                    $status = $content?->status ?? '';
                                    if($status == 'published') $x = 'bg-success-gradient';
                                    elseif ($status == 'schedule') $x = 'bg-primary-gradient';
                                    elseif ($status == 'draft') $x = 'bg-black-gradient';
                                    elseif ($status == 'hidden') $x = 'bg-warning-gradient';
                                    elseif ($status == 'pending') $x = 'bg-secondary-gradient';
                                    else 
                                @endphp
                                <span class="badge text-uppercase {{ $x }}">{{ $status }}</span>
                            </td>
                            <td>
                                @php
                                    $hid = hash_encode($content?->id ?? 0);
                                @endphp
                                <a href="{{ route('creator.content.edit', $hid) }}" class="btn btn-sm btn-outline-primary py-1 px-2 fs-6"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('creator.content.delete', $hid) }}" class="btn btn-sm btn-outline-danger py-1 px-2 fs-6"><i class="fa fa-trash"></i></a>
                                <a href="{{ route('creator.content.edit', $hid) }}" class="btn btn-sm btn-outline-secondary py-1 px-2 fs-6"><i class="fa fa-gear"></i></a>
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
