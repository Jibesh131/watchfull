<?php

namespace App\Livewire\Creator;

use App\Models\Content;
use App\Models\Genre;
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
    public $director;
    public $description;
    public $rating;
    public $writers;
    public $producers;
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

    protected array $messages = [
        'movie.required_if' => 'The movie field is required',
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
        $this->rating = $content->age_rating;
        $this->stars = json_decode($content->stars, true) ?? [];
        $this->genres = json_decode($content->genres, true) ?? [];
        $this->director = json_decode($content->director, true) ?? null;
        $this->writers = json_decode($content->writers, true) ?? null;
        $this->producers = json_decode($content->producers, true) ?? null;

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
                'rating' => 'required',
                'stars' => 'required',
                'thumbnail' => $this->itemId ? 'nullable|image|max:1024' : 'required|image|max:1024',
                'movie' => $this->itemId ? 'nullable|mimes:mp4,mov,avi|max:' . (1024 * 10) : 'required|mimes:mp4,mov,avi|max:' . (1024 * 10),
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

    public function render()
    {
        return view('livewire.creator.content-form', [
            'allGenres' => $this->allGenres,
        ]);
    }

    public function save()
    {
        $validated = $this->validate($this->rules(), $this->messages);

        // dd($validated);
        DB::beginTransaction();

        try {
            if ($this->thumbnail instanceof TemporaryUploadedFile) {
                $imgPath = $this->thumbnail->store('uploads/thumbnails', 'public');
            } else {
                $imgPath = null;
            }

            if ($this->movie instanceof TemporaryUploadedFile) {
                $moviePath = $this->movie->store('uploads/movie', 'public');
            } else {
                $moviePath = null;
            }

            if ($this->itemId) {
                $content = Content::findOrFail($this->itemId);

                $content->type = $validated['type'] ?? $content->type;
                $content->title = $validated['title'] ?? $content->title;
                $content->description = $validated['description'] ?? $content->description;
                $content->age_rating = $validated['rating'] ?? $content->age_rating;

                if ($imgPath) {
                    if ($content->thumbnail && Storage::disk('public')->exists($content->thumbnail)) {
                        Storage::disk('public')->delete($content->thumbnail);
                    }
                    $content->thumbnail = $imgPath;
                }

                if ($moviePath) {
                    if ($content->content_file && Storage::disk('public')->exists($content->content_file)) {
                        Storage::disk('public')->delete($content->content_file);
                    }
                    $content->content_file = $moviePath;
                }

                if (isset($validated['stars'])) {
                    $content->stars = json_encode($validated['stars']);
                }

                if (isset($validated['genres'])) {
                    $content->genres = json_encode($validated['genres']);
                }

                $content->save();

                DB::commit();

                $this->cleanupOldTmp();
                $this->deleteCurrentTmp();

                session()->flash('notify', [
                    'type' => 'success',
                    'title' => 'Updated',
                    'message' => 'Content updated successfully.',
                ]);

                return redirect()->route('creator.content.index');
            } else {
                $content = new Content();
                $content->type = $validated['type'];
                $content->title = $validated['title'];
                $content->description = $validated['description'];
                $content->age_rating = $validated['rating'] ?? null;
                $content->thumbnail = $imgPath;
                $content->content_file = $moviePath;
                $content->stars = isset($validated['stars']) ? json_encode($validated['stars']) : json_encode([]);
                $content->genres = isset($validated['genres']) ? json_encode($validated['genres']) : json_encode([]);
                $content->save();

                DB::commit();

                $this->cleanupOldTmp();
                // $this->deleteCurrentTmp();

                session()->flash('notify', [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Content uploaded successfully.'
                ]);

                return redirect()->route('creator.content.index');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            // $this->deleteCurrentTmp();
            $this->dispatch('notify', type: 'danger', message: 'Something went wrong. Please try again later.', title: 'Oops');
        }
    }

    protected function registerTmp($file)
    {
        if ($file instanceof TemporaryUploadedFile) {
            $this->tempFiles[] = $file->getRealPath();
        }
    }

    protected function deleteCurrentTmp()
    {
        foreach ($this->tempFiles as $path) {
            $dir = dirname($path);
            if (is_dir($dir)) {
                File::deleteDirectory($dir);
            }
        }

        $this->tempFiles = [];
    }

    protected function cleanupOldTmp()
    {
        $tmp = storage_path('app/livewire-tmp');

        foreach (glob($tmp . '/*') as $folder) {
            if (is_dir($folder) && filemtime($folder) < now()->subHour()->timestamp) {
                File::deleteDirectory($folder);
            }
        }
    }

    public function updatedThumbnail()
    {
        $this->registerTmp($this->thumbnail);
    }

    public function updatedMovie()
    {
        $this->registerTmp($this->movie);
    }
}
