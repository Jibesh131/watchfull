<div>
    <form wire:submit.prevent="save" class="row g-3">
        <div class="col-md-6">
            <label for="type">Type</label>
            <select class="form-select form-control" wire:model.live="type" id="type" @disabled($itemId)>>
                <option value="">-- Choose --</option>
                <option value="movie">Movie</option>
                <option value="video">Video</option>
                <option value="music">Music</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- MOVIE --}}
        @if ($type === 'movie')
            <div class="col-md-6">
                <label for="title" class="required">Title</label>
                <input type="text" class="form-control" wire:model="title" id="title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="thumbnail" class="required"> Thumbnail </label>
                <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Image Dropdown Available">
                    <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                </span>

                <div class="input-group" wire:ignore>
                    <input type="file" class="form-control" wire:model="thumbnail" accept="image/*" id="thumbnail"
                        onchange="previewThumbnail(event, 'thumbnailPreviewBtn', 'thumbnailPreviewImage')">

                    <button class="btn btn-outline-primary" type="button" id="thumbnailPreviewBtn"
                        data-src="{{ $itemId && $thumbnail_path ? asset('storage/' . $thumbnail_path) : '' }}"
                        style="{{ $itemId && $thumbnail_path ? '' : 'display:none;' }}" data-bs-toggle="modal"
                        data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="movie" class="required"> Movie </label>
                <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Video Dropdown Available">
                    <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                </span>
                <div class="input-group" wire:ignore>
                    <input type="file" class="form-control" wire:model="movie" accept="video/mp4,video/x-m4v,video/*"
                        id="movie" onchange="previewThumbnail(event, 'moviePreviewBtn', 'moviePreviewImage')">
                    <button class="btn btn-outline-primary" type="button"
                        data-src="{{ $itemId && $movie_path ? asset('storage/' . $movie_path) : '' }}"
                        style="{{ $itemId && $movie_path ? '' : 'display:none;' }}" data-bs-toggle="modal"
                        data-bs-target="#videoPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                @error('movie')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="description" class="required">Sort Description</label>
                <textarea wire:model="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="age_rating" class="required">Age Rating</label>
                <select class="form-select form-control" wire:model="age_rating" id="age_rating">
                    <option value="">-- Select a rating --</option>
                    <option value="U">U / G: Unrestricted Public Exhibition (All Ages)</option>
                    <option value="UA7+">UA 7+ / PG: Parental Guidance Suggested</option>
                    <option value="UA13+">UA 13+ / PG-13: Parents Strongly Cautioned (Ages 13+)</option>
                    <option value="A">A / R: Adults Only (18+)</option>
                    <option value="S">S: Specialized Audiences Only (Not for Public)</option>
                </select>
                @error('age_rating')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="stars" class="required"> Stars </label>
                <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Type and press Enter...">
                    <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                </span>
                <div class="input-group" wire:ignore>
                    <input type="text" id="stars" class="form-control" x-data x-ref="starsInput" wire:ignore
                        x-init="const tag = new Tagify($refs.starsInput);
                        tag.addTags(@js($stars));
                        tag.on('change', () => {
                            $wire.set('stars', tag.value.map(e => e.value));
                        });">
                </div>
                @error('stars')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="genres" class="required">
                    Genres
                    <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Type and press Enter...">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group" wire:ignore>
                    <input type="text" id="genres" class="form-control" x-data x-ref="genresInput" wire:ignore
                        x-init="const tag = new Tagify($refs.genresInput, {
                            whitelist: @js($allGenres),
                            enforceWhitelist: false
                        });
                        tag.addTags(@js($genres));
                        tag.on('change', () => {
                            $wire.set('genres', tag.value.map(e => e.value));
                        });">
                </div>
                @error('genres')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="directors" class="required"> Directors </label>
                <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Type and press Enter...">
                    <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                </span>
                <div class="input-group" wire:ignore>
                    <input type="text" id="directors" class="form-control" data-tagify wire:model="director">
                </div>
                @error('director')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6" wire:ignore>
                <label for="writers">Writers</label>
                <div class="input-group" wire:ignore>
                    <input type="text" id="writers" class="form-control" wire:model="writers" data-tagify>
                </div>
                @error('writers')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="producers">Production Credits</label>
                <div class="input-group" wire:ignore>
                    <input type="text" class="form-control" wire:model="producers" id="producers" data-tagify>
                </div>
                @error('producers')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label id="composer">Composer</label>
                <input type="text" class="form-control" wire:model="composer" id="composer">
            </div>

            <div class="col-md-6">
                <label id="cinematographer">Cinematographer</label>
                <input type="text" class="form-control" wire:model="cinematographer" id="cinematographer">
            </div>

            <div class="col-md-6">
                <label for="editor">Editor</label>
                <input type="text" class="form-control" wire:model="editor" id="editor">
            </div>

            <div class="col-md-6">
                <label for="pd">Production Designer</label>
                <input type="text" class="form-control" wire:model="pd" id="pd">
            </div>

            <div class="col-md-12">
            </div>
        @endif

        {{-- VIDEO --}}
        @if ($type === 'video')
            <div class="col-md-6">
                <label>Title</label>
                <input type="text" class="form-control" wire:model="titleB">
            </div>

            <div class="col-md-6" wire:ignore>
                <label>
                    Thumbnail
                    <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picB" accept="image/*"
                        id="thumbnailInput" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;"
                        data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6" wire:ignore>
                <label for="video">
                    Upload Video
                    <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="File Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picB"
                        accept="video/mp4,video/x-m4v,video/*" id="video">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;"
                        data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label>Captipion File</label>
                <input type="number" class="form-control" wire:model="lengthB">
            </div>

            <div class="col-md-6">
                <label>Creator</label>
                <input type="text" class="form-control" wire:model="creatorB">
            </div>

            <div class="col-md-6">
                <label>Category</label>
                <input type="text" class="form-control" wire:model="categoryB">
            </div>
        @endif

        {{-- MUSIC --}}
        @if ($type === 'music')
            <div class="col-md-6" wire:ignore>
                <label>
                    Thumbnail
                    <span tabindex="0" data-bs-toggle="tooltip" class="ms-2" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picC" accept="image/*"
                        id="thumbnailInput" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;"
                        data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label>Title</label>
                <input type="text" class="form-control" wire:model="titleC">
            </div>

            <div class="col-md-6">
                <label>Artist</label>
                <input type="text" class="form-control" wire:model="artistC">
            </div>

            <div class="col-md-6">
                <label>Album</label>
                <input type="text" class="form-control" wire:model="albumC">
            </div>

            <div class="col-md-6">
                <label>Genre</label>
                <input type="text" class="form-control" wire:model="genreC">
            </div>
        @endif

        @if ($type)
            <div class="col-md-12 mt-3 d-flex">
                <button type="submit" class="btn btn-dark" data-submit="draft">
                    Save As Draft <i class="fa-solid fa-file-pen ms-1"></i>
                </button>
                <button type="button" class="btn btn-secondary ms-2" data-submit="schedule" data-bs-toggle="modal"
                    data-bs-target="#scheduleModel">
                    Schedule <i class="fa-regular fa-clock ms-1"></i>
                </button>
                <button type="submit" class="btn btn-primary ms-auto" data-submit="publish">
                    Publish <i class="fa-solid fa-paper-plane ms-1"></i>
                </button>
            </div>
        @endif
    </form>
    {{-- For thumbnail --}}
    <div class="modal fade" id="thumbnailPreviewModal" tabindex="-1" aria-labelledby="thumbnailPreviewModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thumbnailPreviewModalLabel">
                        <i class="fa fa-image me-2"></i>Thumbnail Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="thumbnailPreviewImage" src="" alt="Preview" class="img-fluid rounded"
                        style="max-height: 500px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- For video player --}}
    <div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-video me-2"></i>Video Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <video id="videoPreviewPlayer" controls style="max-height:500px; width:100%; border-radius:10px;">
                        <source src="" type="video/mp4">
                    </video>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Shedule content  --}}
    <div class="modal fade" id="scheduleModel" tabindex="-1" aria-labelledby="scheduleModel" aria-hidden="true"
        wire:ignore>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ScheduleModelLabel">
                        <i class="fa fa-image me-2"></i>Schedule Content
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center px-4">
                    <p class="text-start mb-1">Lanch Time</p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3 px-1">
                                <input type="date" name="" id="" class="form-control">
                            </div>
                            <div class="col-3 px-1">
                                <select name="" id="" class="form-select form-control">
                                    <option value="">Hour</option>
                                    @for ($i = 0; $i <= 24; $i++)
                                        <option value="{{ $i }}">
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-3 px-1">
                                <select name="" id="" class="form-select form-control">
                                    <option value="">Minute</option>
                                    @for ($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}">
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-3 px-1">
                                <select name="" id="" class="form-select form-control">
                                    <option value="">Second</option>
                                    @for ($i = 0; $i <= 59; $i++)
                                        <option value="{{ $i }}">
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
