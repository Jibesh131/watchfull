<?php

namespace App\Livewire\Creator;

use App\Models\Content;
use App\Models\Genre;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContentForm extends Component
{
    use WithFileUploads;

    public ?int $itemId = null;
    public array $tempFiles = [];

    public string $type = 'movie';
    public array $allGenres = [];

    public $title;
    public $thumbnail;
    public $movie;
    public $thumbnail_path;
    public $movie_path;
    public $genres = [];
    public $stars = [];
    public $director = [];
    public $description;
    public $age_rating;
    public $writers = [];
    public $producers = [];
    public $composer;
    public $cinematographer;
    public $editor;
    public $pd;
    public $durationA;
    public $release_dateA;

    // Video fields
    public $titleB;
    public $creatorB;
    public $categoryB;
    public $picB;
    public $lengthB;

    // Music fields
    public $titleC;
    public $artistC;
    public $albumC;
    public $genreC;
    public $picC;

    protected array $fileProfiles = [
        'video' => [
            'thumbnail' => 'uploads/video/thumbnails',
            'content_file' => 'uploads/video/files',
        ],

        'music' => [
            'banner' => 'uploads/music/banners',
            'content_file'   => 'uploads/music/files',
        ],

        'movie' => [
            'thumbnail'  => 'uploads/movie/thumbnail',
            'content_file'  => 'uploads/movie/content_file',
        ],
    ];

    protected array $typeFields = [
        'video' => ['title', 'description', 'composer', 'editor', 'stars', 'genres'],
        'music' => ['title', 'description', 'singer', 'lyricist', 'stars', 'genres'],
        'movie' => ['title', 'description', 'director', 'producer', 'composer', 'cinematographer', 'editor', 'production_designer', 'choreographer', 'stars', 'genres'],
    ];

    public function mount($id = null)
    {
        $this->allGenres = Genre::orderBy('name')->get(['id as value', 'name'])->toArray();

        if ($id) {
            $this->itemId = $id;
            $this->loadItem();
        }
    }

    protected function loadItem(): void
    {
        $content = Content::findOrFail($this->itemId);

        $this->type = $content->type;
        $this->title = $content->title;
        $this->thumbnail_path = $content->thumbnail;
        $this->movie_path = $content->content_file;
        $this->description = $content->description;
        $this->age_rating = $content->age_rating;
        $this->stars = json_encode($content->stars) ?? [];
        $this->genres = json_encode($content->genres) ?? [];
        $this->director = json_encode($content->directors) ?? [];
        $this->writers = json_encode($content->writers) ?? [];
        $this->producers = json_encode($content->producers) ?? [];

        // Movie-specific
        $this->composer = $content->composer ?? null;
        $this->cinematographer = $content->cinematographer ?? null;
        $this->editor = $content->editor ?? null;
        $this->pd = $content->pd ?? null;
        $this->durationA = $content->duration ?? null;
        $this->release_dateA = $content->release_date ?? null;

        // Video/Music placeholders if used
        $this->titleB = $content->title ?? null;
        $this->creatorB = $content->creator ?? null;
        $this->categoryB = $content->category ?? null;

        $this->titleC = $content->title ?? null;
        $this->artistC = $content->artist ?? null;
        $this->albumC = $content->album ?? null;
        $this->genreC = $content->genre ?? null;

        // Do not overwrite file properties ($thumbnail, $movie) — they represent uploads.
    }

    protected function rules(): array
    {
        $common = [
            'type' => 'in:movie,video,music',
            'title' => 'required|string',
            'description' => 'required|string',
            'genres' => 'required',
            'producers' => 'nullable',
            'writers' => 'nullable',
        ];

        if ($this->type === 'movie') {
            return array_merge($common, [
                'age_rating' => 'required',
                'stars' => 'required',
                'thumbnail' => $this->itemId ? 'nullable|image|max:1024' : 'required|image|max:1024',
                'movie' => $this->itemId ? 'nullable|mimes:mp4,mov,avi|max:' . (1024 * 10) : 'required|mimes:mp4,mov,avi|max:' . (1024 * 10),
                'director' => 'nullable',
                'writers' => 'nullable',
                'producers' => 'nullable',
                'composer' => 'nullable',
                'cinematographer' => 'nullable',
                'editor' => 'nullable',
                'pd' => 'nullable',
            ]);
        }

        if ($this->type === 'video') {
            return array_merge($common, [
                'thumbnail' => $this->itemId ? 'nullable|image|max:1024' : 'required|image|max:1024',
                'movie' => $this->itemId ? 'nullable|mimes:mp4,mov,avi|max:' . (1024 * 10) : 'required|mimes:mp4,mov,avi|max:' . (1024 * 10),
            ]);
        }

        if ($this->type === 'music') {
            return array_merge($common, [
                'picC' => $this->itemId ? 'nullable|image|max:1024' : 'required|image|max:1024',
            ]);
        }

        return $common;
    }

    protected array $messages = [
        'movie.required_if' => 'The movie field is required',
    ];

    public function render()
    {
        return view('livewire.creator.content-form', [
            'allGenres' => $this->allGenres,
        ]);
    }

    public function save()
    {
        $validated = $this->validate($this->rules(), $this->messages);
        DB::beginTransaction();
        try {
            $filePaths = $this->processUploads($validated['type']);
            if ($this->itemId) {
                $this->updateContent($this->itemId, $validated, $filePaths); //EDIT
            } else {
                $this->createContent($validated, $filePaths);  //ADD
            }
            
            DB::commit();

            session()->flash('notify', [
                'type' => 'success',
                'title' => $this->itemId ? 'Updated' : 'Success',
                'message' => $this->itemId ? 'Content updated successfully.' : 'Content uploaded successfully.',
            ]);

            return redirect()->route('creator.content.index');
        } catch (\Throwable $e) {
            DB::rollBack();

            // $this->dispatch('notify', type: 'danger', title: 'Oops', message: 'Something went wrong.');
            logger()->error($e);
            $this->dispatch('notify', type: 'danger', title: 'Oops', message: $e->getMessage());

            return;
        }
    }

    private function processUploads(string $type): array
    {
        $paths = [];
        foreach ($this->fileProfiles[$type] as $field => $directory) {
            $file = $this->$field ?? null;
            if ($file instanceof TemporaryUploadedFile) {
                $paths[$field] = $file->store($directory, 'public');
            }
        }
        return $paths;
    }


    private function createContent(array $validated, array $filePaths): Content
    {
        $content = new Content();
        $this->fillContentFields($content, $validated, $filePaths);
        $content->save();
        return $content;
    }

    private function updateContent(int $id, array $validated, array $filePaths): Content
    {
        $content = Content::findOrFail($id);
        $this->deleteReplacedFiles($content, $filePaths);
        // dd($filePaths);
        $this->fillContentFields($content, $validated, $filePaths);
        $content->save();
        return $content;
    }

    private function fillContentFields(Content $content, array $validated, array $filePaths): void
    {
        $content->type        = $validated['type'] ?? $content->type;
        $content->title       = $validated['title'];
        $content->description = $validated['description'];
        $content->age_rating  = $validated['age_rating'] ?? null;
        $content->stars  = json_to_array($validated['stars']  ?? []);
        $content->genres = json_to_array($validated['genres'] ?? []);

        if($validated['type'] == 'movie'){
            $content->directors  = json_to_array($validated['director']  ?? []);
            $content->writers  = json_to_array($validated['writers']  ?? []);
            $content->producers  = json_to_array($validated['producers']  ?? []);
            $content->composer = $validated['composer']  ?? '';
            $content->cinematographer = $validated['cinematographer'] ?? '';
            $content->editor = $validated['editor'] ?? '';
            $content->pd = $validated['pd'] ?? '';
        }
        
        foreach ($filePaths as $field => $path) {
            $content->$field = $path;
        }

        $ffprobe = FFProbe::create([
            'ffprobe.binaries' => 'D:\\ffmpeg\\bin\\ffprobe.exe',
        ]);
        
        $duration = $ffprobe
        ->format(storage_path('app/public/' . $content->content_file))
        ->get('duration');
        
        $content->duration = intval($duration);
    }

    private function deleteReplacedFiles(Content $content, array $filePaths): void
    {
        foreach ($filePaths as $field => $newPath) {
            $this->deleteOldFile($content->$field ?? null);
        }
    }

    private function deleteOldFile(?string $oldPath): void   //Used to remove replaced files during update.
    {
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }

    private function cleanupOldTmp(): void
    {
        $tmp = storage_path('app/livewire-tmp');

        foreach (glob($tmp . '/*') as $folder) {
            if (is_dir($folder) && filemtime($folder) < now()->subHours(2)->timestamp) {
                File::deleteDirectory($folder);
            }
        }
    }
}
