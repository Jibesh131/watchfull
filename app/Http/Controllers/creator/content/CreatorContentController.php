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
        $type = request()->type ?? '';
        $status = request()->status ?? '';
        $date = request()->date ?? '';

        $contents = Content::query();

        if (!blank($keyword)) {
            $contents->where('title', 'like', '%' . $keyword . '%');
        }
        if(!blank($type)){
            $contents->where('type', 'like', $type);
        }
        if(!blank($status)){
            $contents->status($status);
        }
        match ($date) {
            'newest' => $contents->orderBy('created_at', 'desc'),
            'oldest' => $contents->orderBy('created_at', 'asc'),
            'last7'  => $contents->where('created_at', '>=', now()->subDays(7)),
            'last30' => $contents->where('created_at', '>=', now()->subDays(30)),
            default  => $contents->orderBy('created_at', 'desc'),
        };
        
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
