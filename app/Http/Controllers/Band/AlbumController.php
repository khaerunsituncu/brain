<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\{Album, Band};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function create()
    {
        return view('albums.create', [
            'title' => 'New Album',
            'bands' => Band::get(),
            'album' => new Album,
            'submitLabel' => 'Create',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'band' => 'required','unique:albums',
            'name' => 'required',
            'year' => 'required',
        ]);

        $band = Band::find($request->band);

        Album::create([
            'band_id' => $request->band,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'year' => $request->year,
        ]);

        return back()->with('success', 'Album was created into ' . $band->name );
    }

    public function table()
    {
        return view('albums.table', [
            'albums' => Album::paginate(16),
            'title' => 'Albums',
        ]);
    }

    public function edit(Album $album)
    {
        return view('albums.edit',[
            'title' => "Edit album: {$album->name}",
            'album' => $album, 
            'bands' => Band::get(),
            'submitLabel' => 'Update',
        ]);
    }

    public function update(Request $request, Album $album)  
    {
        $request->validate([
            'band' => ['required', 'unique:albums,name,' . $album->id],
            'name' => 'required',
            'year' => 'required',   
        ]);
    
        $album->update([
            'band_id' => $request->band,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'year' => $request->year,
        ]);

        return redirect(route('albums.edit', $album))->with('success', 'Album was updated');
    }

    public function destroy(Album $album)
    {
        $album->delete();
    }
}
