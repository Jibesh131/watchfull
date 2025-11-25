<?php

namespace App\Http\Controllers\creator\content;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Http\Request;

class CreatorContentController extends Controller
{
    public function index()
    {
        $title = 'My Contents';
        $search = true;
        $links = [
            [
                'name' => $title
            ]
        ];
        $keyword = request()->keyword ?? '';
        
        $contents = Content::orderBy('created_at', 'desc');
        if (!blank($keyword)) {
            $contents->where('title', 'like', '%' . $keyword . '%');
        }
        $contents = $contents->get();
        return view('creator.content.index', compact('title', 'search', 'links', 'contents'));
    }

    public function add() {
        $title = 'Add Content';
        $links = [
            [
                'url' => route('creator.content.index'),
                'name' => 'My Contents'
            ],
            [
                'name' => $title
            ]
        ];
        return view('creator.content.add', compact('title', 'links'));
    }

    public function edit($id)
    {
        $title = 'Edit Content';
        $links = [
            [
                'url' => route('creator.content.index'),
                'name' => 'My Contents'
            ],
            [
                'name' => $title
            ]
        ];

        $id = hash_decode($id);
        return view('creator.content.add', compact('title', 'links', 'id'));
    }

    public function delete($id){
        dd(hash_decode($id));
    }
}
