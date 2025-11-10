<?php

namespace App\Http\Controllers\creator\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatorContentController extends Controller
{
    public function index()
    {
        $title = 'My Contents';
        $links = [];
        return view('creator.content.index', compact('title', 'links'));
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
        return view('creator.content.add', compact('title', 'links'));
    }
}
