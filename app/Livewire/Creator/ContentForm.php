<?php

namespace App\Livewire\Creator;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class ContentForm extends Component
{
    use WithFileUploads;

    public $type = ''; // changed from selected to type

    // Movie fields
    public $titleA, $authorA, $picA, $durationA, $release_dateA;

    // Video fields
    public $titleB, $creatorB, $categoryB, $picB, $lengthB;

    // Music fields
    public $titleC, $artistC, $albumC, $genreC, $picC;

    public function save()
    {
        $data = [
            'type' => $this->type,
        ];

        // Merge type-specific data
        if ($this->type === 'A') {
            $data = array_merge($data, [
                'title' => $this->titleA,
                'author' => $this->authorA,
                'thumbnail' => $this->picA,
                'duration' => $this->durationA,
                'release_date' => $this->release_dateA,
            ]);
        } elseif ($this->type === 'B') {
            $data = array_merge($data, [
                'title' => $this->titleB,
                'creator' => $this->creatorB,
                'category' => $this->categoryB,
                'thumbnail' => $this->picB,
                'length' => $this->lengthB,
            ]);
        } elseif ($this->type === 'C') {
            $data = array_merge($data, [
                'title' => $this->titleC,
                'artist' => $this->artistC,
                'album' => $this->albumC,
                'genre' => $this->genreC,
                'thumbnail' => $this->picC,
            ]);
        }

        // Instead of dd, send to controller via HTTP or emit event
        // Example HTTP post to controller route:
        // Http::post(route('content.save'), $data);
        echo "success";
        // session()->flash('success', 'Data sent successfully!');
    }

    public function render()
    {
        return view('livewire.creator.content-form');
    }
}
