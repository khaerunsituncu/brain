<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\BandRequest;
use App\Models\{Band, Genre};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BandController extends Controller
{
    public function table()
    {
        return view('bands.table', [
            'bands' => Band::latest()->paginate(16),
            'title' => "Genres",
        ]);
    }

    public function create()
    {
        return view('bands.create', [
            'genres' => Genre::get(),
            'title' => 'New Band',
            'band' => new Band,
        ]);
    }

    public function store(BandRequest $request)
    {
        $band = Band::create([
            'name' => request('name'),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('image/band') : null,
            'slug'  => Str::slug(request('name')),
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was created');
    }

    public function edit(Band $band)
    {
        return view('bands.edit', [
            'band' => $band,
            'title' => "Edit genre: $band->name",
            'genres' => Genre::get(),
        ]);
    }

    public function update(Band $band, BandRequest $request)
    {
        if (request('thumbnail')) {
            Storage::delete($band->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('image/band');
        } elseif ($band->thumbnail) {
            $thumbnail = $band->thumbnail;
        } else {
            $thumbnail = null;
        }

        $band->update([
            'name' => request('name'),
            'slug'  => Str::slug(request('name')),
            'thumbnail' => $thumbnail,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was updated');
    }

    public function destroy(Band $band)
    {
        Storage::delete($band->thumbnail);
        $band->genres()->detach();
        $band->albums()->delete();
        $band->delete();
    }
}
