<?php

namespace App\Livewire\Creator;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class ContentForm extends Component
{
    use WithFileUploads;

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
        'description' => 'required',
    ];

    public function mount()
    {
        $this->allGenres = Genre::orderBy('name')->pluck('name')->toArray();
    }

    public function save()
    {
        $validateData = $this->validate();
        dd($validateData);
    }

    public function render()
    {
        return view('livewire.creator.content-form', ['allGenres' => $this->allGenres]);
    }
}
