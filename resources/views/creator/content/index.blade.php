@extends('creator.layout.app')

@push('css')
@endpush

@section('content')
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <!-- Filters on the Left -->
        <form action="" method="get" autocomplete="off">
            <div class="d-flex gap-2 flex-wrap">
                <select class="form-select" style="width: 160px;" name="type">
                    <option value="" {{ blank(request()->type) ? 'selected' : '' }}>All Types</option>
                    <option value="movie" {{ request()->type == 'movie' ? 'selected' : '' }}>Movie</option>
                    <option value="video" {{ request()->type == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="music" {{ request()->type == 'music' ? 'selected' : '' }}>Music</option>
                </select>

                <select class="form-select" style="width: 160px;" name="status">
                    <option value="" {{ blank(request()->status) ? 'selected' : '' }}>All Status</option>
                    <option value="published" {{ request()->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="draft" {{ request()->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="scheduled" {{ request()->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="hidden" {{ request()->status == 'hidden' ? 'selected' : '' }}>Hidden</option>
                </select>

                <select class="form-select" style="width: 160px;" name="date">  
                    <option value="newest" {{ in_array(request()->date, ['newest', null, ''])   ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request()->date == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="last7" {{ request()->date == 'last7' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="last30" {{ request()->date == 'last30' ? 'selected' : '' }}>Last 30 Days</option>
                </select>

                <button type="submit" class="btn btn-secondary">Filter <i class="fa fa-filter opacity-75 ms-1"></i></button>
                @if (!empty(request()->keyword) || !empty(request()->type) || !empty(request()->status) || !empty(request()->date))
                    <a href="{{ route('creator.content.index') }}" class="btn btn-danger"> 
                        Clear <i class="fa fa-xmark fa-fw ms-1" style="font-size: 1rem;"></i>
                    </a>
                @endif

            </div>
        </form>

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
                                <span data-bs-toggle="tooltip"
                                    data-bs-title="{{ $content?->title ?? '' }}">{{ setLengthLimit($content?->title, 15) }}</span>
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
                                    if ($status == 'published') {
                                        $x = 'bg-success-gradient';
                                    } elseif ($status == 'schedule') {
                                        $x = 'bg-primary-gradient';
                                    } elseif ($status == 'draft') {
                                        $x = 'bg-black-gradient';
                                    } elseif ($status == 'hidden') {
                                        $x = 'bg-warning-gradient';
                                    } elseif ($status == 'pending') {
                                        $x = 'bg-secondary-gradient';
                                    }
                                @endphp
                                <span class="badge text-uppercase {{ $x }}">{{ $status }}</span>
                            </td>
                            <td>
                                @php
                                    $hid = hash_encode($content?->id ?? 0);
                                @endphp
                                <a href="{{ route('creator.content.edit', $hid) }}"
                                    class="btn btn-sm btn-outline-primary py-1 px-2 fs-6"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('creator.content.delete', $hid) }}"
                                    class="btn btn-sm btn-outline-danger py-1 px-2 fs-6"><i class="fa fa-trash"></i></a>
                                <a href="{{ route('creator.content.edit', $hid) }}"
                                    class="btn btn-sm btn-outline-secondary py-1 px-2 fs-6"><i class="fa fa-gear"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">No recode found.</td>
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
