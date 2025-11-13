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
    public array $stars, $genres, $allGenres = [];
    public $thumbnail, $title, $movie, $description, $rating, $director, $writers, $producers, $composer,
    $cinematographer, $editor, $pd, $durationA, $release_dateA;

    // Video fields
    public $titleB, $creatorB, $categoryB, $picB, $lengthB;

    // Music fields
    public $titleC, $artistC, $albumC, $genreC, $picC;

    public function mount()
    {
        $this->allGenres = Genre::orderBy('name')->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.creator.content-form', ['allGenres' => $this->allGenres]);
    }
}
