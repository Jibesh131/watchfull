<div wire:ignore.self>
    <form wire:submit.prevent="save" class="row g-3">
        <div class="col-md-6">
            <label for="type">Type</label>
            <select class="form-select form-control" wire:model.live="type" id="type">
                <option value="">-- Choose --</option>
                <option value="movie">Movie</option>
                <option value="video">Video</option>
                <option value="music">Music</option>
            </select>
        </div>

        {{-- MOVIE --}}
        @if ($type === 'movie')
            <div class="col-md-6"  wire:ignore>
                <label>
                    Thumbnail
                    <span tabindex="0" data-bs-toggle="tooltip" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picA" accept="image/*" id="thumbnailInput" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;" data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="col-md-6">
                <label for="title">Title</label>
                <input type="text" class="form-control" wire:model="title" id="title">
            </div>

            <div class="col-md-6"  wire:ignore>
                <label for="movie">
                    Movie
                    <span tabindex="0" data-bs-toggle="tooltip" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="movie" accept="video/mp4,video/x-m4v,video/*" id="movie" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;" data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-12">
                <label for="description">Sort Description</label>
                {{-- <input type="text"   id="description"> --}}
                <textarea wire:model="description" id="description" cols="30" rows="4" class="form-control"></textarea>
            </div>

            <div class="col-md-6">
                <label for="rating">Official Rating </label>
                <select class="form-select form-control" wire:model="rating" id="rating">
                    <option value="">-- Select a rating --</option>
                    <option value="U">U / G: Unrestricted Public Exhibition (All Ages)</option>
                    <option value="UA7+">UA 7+ / PG: Parental Guidance Suggested</option>
                    <option value="UA13+">UA 13+ / PG-13: Parents Strongly Cautioned (Ages 13+)</option>
                    <option value="A">A / R: Adults Only (18+)</option>
                    <option value="S">S: Specialized Audiences Only (Not for Public)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="stars">Stars</label>
                <input id="stars" type="text" class="form-control" wire:model="stars" placeholder="Type and press enter..." />
            </div>

            <div class="col-md-6">
                <label for="directors">Directors</label>
                <input type="text" class="form-control" wire:model="director" id="directors">
            </div>

            <div class="col-md-6">
                <label for="writers">Writers</label>
                <input type="text" class="form-control" wire:model="writers" id="writers">
            </div>
            
            <div class="col-md-6">
                <label for="producers">Producers</label>
                <input type="text" class="form-control" wire:model="producers" id="producers">
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

            <div class="col-md-6">
                <label>Duration (mins)</label>
                <input type="number" class="form-control" wire:model="durationA">
            </div>

            <div class="col-md-6">
                <label>Release Date</label>
                <input type="time" class="form-control" wire:model="release_dateA">
            </div>

            <script>
document.addEventListener('livewire:load', () => {
    initTagify();
});

document.addEventListener('livewire:navigated', () => {
    initTagify();
});

function initTagify() {
    const input = document.querySelector("#stars");
    if (!input || input.tagify) return;

    const tagify = new Tagify(input, {
        dropdown: { position: 'input', enabled: 0 }
    });

    tagify.on("change", () => {
        const tags = tagify.value.map(t => t.value);
        const component = Livewire.find(
            input.closest('[wire\\:id]').getAttribute('wire:id')
        );
        component.set('stars', tags);
    });
}
</script>
        @endif

        {{-- VIDEO --}}
        @if ($type === 'video')
            <div class="col-md-6"  wire:ignore>
                <label>
                    Thumbnail
                    <span tabindex="0" data-bs-toggle="tooltip" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picB" accept="image/*" id="thumbnailInput" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;" data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <label>Title</label>
                <input type="text" class="form-control" wire:model="titleB">
            </div>

            <div class="col-md-6">
                <label>Creator</label>
                <input type="text" class="form-control" wire:model="creatorB">
            </div>

            <div class="col-md-6">
                <label>Category</label>
                <input type="text" class="form-control" wire:model="categoryB">
            </div>

            <div class="col-md-6">
                <label>Length (sec)</label>
                <input type="number" class="form-control" wire:model="lengthB">
            </div>
        @endif

        {{-- MUSIC --}}
        @if ($type === 'music')
            <div class="col-md-6"  wire:ignore>
                <label>
                    Thumbnail
                    <span tabindex="0" data-bs-toggle="tooltip" title="Image Dropdown Available">
                        <i class="fa fa-info-circle cursor-pointer text-secondary"></i>
                    </span>
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="picC" accept="image/*" id="thumbnailInput" onchange="previewThumbnail(event)">
                    <button class="btn btn-outline-primary" type="button" id="previewBtn" style="display: none;" data-bs-toggle="modal" data-bs-target="#thumbnailPreviewModal">
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
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <div class="modal fade" id="thumbnailPreviewModal" tabindex="-1" aria-labelledby="thumbnailPreviewModalLabel" aria-hidden="true" wire:ignore>
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="thumbnailPreviewModalLabel">
                                <i class="fa fa-image me-2"></i>Thumbnail Preview
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="thumbnailPreviewImage" src="" alt="Preview" class="img-fluid rounded" style="max-height: 500px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fa fa-times me-2"></i>Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
