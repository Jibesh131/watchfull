<?php

namespace App\Livewire\Creator;

use App\Models\Content;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContentForm extends Component
{
    use WithFileUploads;

    public array $tempFiles = [];

    public $type = 'movie';

    // Movie fields
    public array $allGenres = [];
    public $genres, $stars, $director;
    public $thumbnail, $title, $movie, $description, $rating, $writers, $producers, $composer,
        $cinematographer, $editor, $pd, $durationA, $release_dateA;

    // Video fields
    public $titleB, $creatorB, $categoryB, $picB, $lengthB;

    // Music fields
    public $titleC, $artistC, $albumC, $genreC, $picC;

    protected $rules = [
        'type' => 'in:movie,video,music',
        'title' => 'required',
        'thumbnail' => 'required|image|max:1024',
        'movie' => 'required_if:type,movie|mimes:mp4,mov,avi|max:' . (1024 * 10),
        'description' => 'required',
        'rating' => 'required',
        'stars' => 'required',
        'genres' => 'required',
    ];

    protected $message = [
        'movie.required_if' => 'The movie field is required',
    ];

    protected function registerTmp($file)
    {
        if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $this->tempFiles[] = $file->getRealPath();
        }
    }

    protected function deleteCurrentTmp()
    {
        foreach ($this->tempFiles as $path) {
            $dir = dirname($path);
            if (is_dir($dir)) {
                \Illuminate\Support\Facades\File::deleteDirectory($dir);
            }
        }

        $this->tempFiles = [];
    }

    protected function cleanupOldTmp()
    {
        $tmp = storage_path('app/livewire-tmp');

        foreach (glob($tmp . '/*') as $folder) {
            if (is_dir($folder)) {
                if (filemtime($folder) < now()->subHour()->timestamp) {
                    \Illuminate\Support\Facades\File::deleteDirectory($folder);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.creator.content-form', ['allGenres' => $this->allGenres]);
    }

    public function mount()
    {
        $this->allGenres = Genre::orderBy('name')->get(['id as value', 'name'])->toArray();
    }

    public function save()
    {
        DB::beginTransaction();

        try {
            $formData = $this->validate();

            $imgPath = $this->thumbnail->store('uploads/thumbnails', 'public');
            $moviePath = $this->movie->store('uploads/movie', 'public');

            $content = new Content;
            $content->type = $formData['type'];
            $content->title = $formData['title'];
            $content->thumbnail = $imgPath;
            $content->content_file = $moviePath;
            $content->description = $formData['description'];
            $content->age_rating = $formData['rating'];
            $content->stars = json_encode(extract_tagify_values($formData['stars']));
            $content->genres = json_encode(extract_tagify_values($formData['genres']));
            $content->save();

            DB::commit();

            // Cleanup logic here
            $this->cleanupOldTmp();     // delete old tmp (1+ hour)
            $this->deleteCurrentTmp();  // delete tmp files created during this request

            session()->flash('notify', [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Content uploaded successfully.'
            ]);

            return redirect()->route('creator.content');
            
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->deleteCurrentTmp(); // avoid orphan tmp on error
            $this->dispatch('notify', type: 'danger', message: 'Something went wrong. Please try again later.', title: 'Oops');
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
