<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    public function show($id)
    {
        $song = Song::findOrFail($id);
        return response()->json($song);
    }

    public function create()
    {
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'file' => 'required|mimes:mp3,wav,ogg|max:20480',
        ]);

        $path = $request->file('file')->store('songs', 'public');

        $song = Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'file_path' => $path,
        ]);

        return redirect()->route('songs.index')->with('success', 'Canción subida exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
        ]);
        $song->title = $request->title;
        $song->artist = $request->artist;
        if ($request->hasFile('file')) {
            $request->validate(['file' => 'mimes:mp3,wav,ogg|max:20480']);
            $path = $request->file('file')->store('songs', 'public');
            $song->file_path = $path;
        }
        $song->save();
        // If the request expects JSON (AJAX/API), return JSON. Otherwise redirect back to the songs list.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($song);
        }

        return redirect()->route('songs.index')->with('success', 'Canción actualizada.');
    }

    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();
        // Support AJAX/JSON responses, but for normal form submissions redirect to the songs list.
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['message' => 'Canción eliminada']);
        }

        return redirect()->route('songs.index')->with('success', 'Canción eliminada.');
    }
}
