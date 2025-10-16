<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sonora;

class SonoraController extends Controller
{
    public function index()
    {
        $songs = Sonora::all();
        return view('sonora.index', compact('songs'));
    }

    public function create()
    {
        return view('sonora.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer',
            'cover_url' => 'required|url',
            'audio_file' => 'required|url',
        ]);

        Sonora::create($request->all());

        return redirect()->route('sonora.index');
    }
}
