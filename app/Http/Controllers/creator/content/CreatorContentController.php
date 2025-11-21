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
            // [
            //     'url' => route('admin.coordinator.index'),
            //     'name' => 'Coordinators'
            // ],
            // [
            //     'name' => $title
            // ]
        ];
        // $applications = Application::where('status', '!=', 'draft')->orderBy('submitted_at', 'DESC')->get();
        $genras =  Genre::orderBy('name')->pluck('name')->toArray();
        return view('creator.content.add', compact('title', 'links', 'genras'));
    }
}
