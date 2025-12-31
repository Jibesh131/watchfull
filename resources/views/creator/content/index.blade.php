@extends('creator.layout.app')

@push('css')
<style>
    .status-badge-pos{
        position: absolute;
        top: 8px;
        left: 8px;
    }

    .item-shadow{
        box-shadow: 0px 0px 10px 0 rgba(69, 65, 78, 0.35);
    }

    /* Thumbnail wrapper */
    .thumbnail-wrapper {
        position: relative;
        width: 100%;
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;              /* Neutral background */
        border-radius: 12px 0 0 12px;
        overflow: hidden;
    }

    /* Thumbnail image */
    .thumbnail-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;              /* 🔑 Show full image */
        object-position: center;
    }
</style>
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
                    <option value="newest" {{ in_array(request()->date, ['newest', null, '']) ? 'selected' : '' }}>Newest
                        First</option>
                    <option value="oldest" {{ request()->date == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="last7" {{ request()->date == 'last7' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="last30" {{ request()->date == 'last30' ? 'selected' : '' }}>Last 30 Days</option>
                </select>

                <button type="submit" class="btn btn-secondary">Filter <i
                        class="fa fa-filter opacity-75 ms-1"></i></button>
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
        @forelse ($contents as $content)
            <div class="card rounded mb-3 item-shadow">
                <div class="row g-0 content-card-row">
                    <!-- Thumbnail Section -->
                    <div class="col-md-2 pe-0">
                        <div class="thumbnail-wrapper">
                            <img src="{{ asset($content?->thumbnail ? 'storage/' . $content->thumbnail : 'mix/image/demo.png') }}"
                                alt="Thumbnail" class="img-fluid" />
                            @php
                                [$statusBadge, $statusText] = content_status_badge($content?->status);
                            @endphp
                            <span class="badge {{ $statusBadge }} status-badge-pos fw-semibold shadow-sm">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="col-md-10">
                        <div class="card-body content-details p-3">
                            <!-- Title and Actions -->
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="content-title fw-bold text-dark mb-0">
                                    {{ $content?->title ?? 'Untitled' }}
                                    <span class="badge bg-dark metadata-badge mx-1">
                                        <i class="fa fa-film me-1"></i> {{ ucfirst($content?->type ?? 'N/A') }}
                                    </span>
                                </h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    @php $hid = hash_encode($content?->id ?? 0); @endphp
                                    <a href="{{ route('creator.content.edit', $hid) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('creator.content.delete', $hid) }}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a href="{{ route('creator.content.edit', $hid) }}" class="btn btn-secondary">
                                        <i class="fa fa-gear"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Metadata -->
                            <div class="mb-2">
                                <span class="badge bg-secondary metadata-badge me-1 mb-1">
                                    Age Rating: {{ $content?->age_rating ?? 'N/A' }}
                                </span>
                                <span class="badge bg-dark metadata-badge me-1 mb-1">
                                    Duration: {{ $content?->duration ?? '--' }} min
                                </span>
                                <span class="badge bg-primary metadata-badge me-1 mb-1">
                                    Release:
                                    {{ $content?->created_at ? format_date($content->created_at, 'M d, Y') : '--' }}
                                </span>
                            </div>

                            <!-- Details in Two Columns -->
                            <div class="row g-2">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Stars -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="fw-semibold text-secondary ">Stars:</span>
                                        <span class="text-dark flex-fill ms-2">
                                            {{ $content?->stars && count($content->stars) ? implode(', ', $content->stars) : '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Description -->
                                    <div class="d-flex align-items-start mb-1 d-none">
                                        <span
                                            class="info-label fw-semibold text-secondary ">Description:</span>
                                        <span class="info-value text-muted flex-fill ms-2">
                                            {{ $content?->description ?? 'No description' }}
                                        </span>
                                    </div>

                                    <!-- Genres -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="fw-semibold text-secondary ">Genres:</span>
                                        <span class="text-dark flex-fill ms-2">
                                            {{ $content?->genres && count($content->genres) ? implode(', ', $content->genres) : '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Directors -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="fw-semibold text-secondary ">Directors:</span>
                                        <span class="text-dark flex-fill ms-2">
                                            {{ $content?->directors && count($content->directors) ? implode(', ', $content->directors) : '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Writers -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="fw-semibold text-secondary ">Writers:</span>
                                        <span class="text-dark flex-fill ms-2">
                                            {{ $content?->writers && count($content->writers) ? implode(', ', $content->writers) : '(empty)' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Production Credits -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="fw-semibold text-secondary">Production Credits:</span>
                                        <span class="flex-fill ms-2">
                                            {{ $content?->producers && count($content->producers) ? implode(', ', $content->producers) : '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Composer -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="info-label fw-semibold text-secondary ">Composer:</span>
                                        <span class="info-value text-dark flex-fill ms-2">
                                            {{ $content?->composer ?? '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Cinematographer -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span
                                            class="info-label fw-semibold text-secondary ">Cinematographer:</span>
                                        <span class="info-value text-dark flex-fill ms-2">
                                            {{ $content?->cinematographer ?? '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Editor -->
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="info-label fw-semibold text-secondary ">Editor:</span>
                                        <span class="info-value text-dark flex-fill ms-2">
                                            {{ $content?->editor ?? '(empty)' }}
                                        </span>
                                    </div>

                                    <!-- Production Designer -->
                                    <div class="d-flex align-items-start mb-1 d-none">
                                        <span class="info-label fw-semibold text-secondary ">Production
                                            Designer:</span>
                                        <span class="info-value text-dark flex-fill ms-2">
                                            {{ $content?->pd ?? '(empty)' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">No content found</div>
        @endforelse
    </div>
@endsection
