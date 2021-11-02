<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function create()
    {
        return view('genres.create', [
            'title' => 'New Genres',
            'genre' => New Genre,
            'submitLabel' => 'Create',
        ]);
    }

    public function store(GenreRequest $request)
    {
        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Genre was created');
    }

    public function table()
    {
        return view('genres.table', [
            'genres' => Genre::latest()->paginate(10),
            'title' => 'Genres',
        ]);
    }
    public function edit(Genre $genre)
    {
        return view('genres.edit', [
            'genre' => $genre,
            'title' => "Edit album: {$genre->name}",
            'submitLabel' => 'Update',
        ]);
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect(route('genres.edit', $genre))->with('success', 'Genre was updated');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
    }
}
