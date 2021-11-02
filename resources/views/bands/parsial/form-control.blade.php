<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input class="form-control-file" type="file" name="thumbnail" id="thumbnail">
    @error('thumbnail')
    <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $band->name) }}">
    @error('name')
    <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="genres">Choose Genre</label>
    <select class="form-control select2multiple" name="genres[]" id="genres" multiple>
        @foreach ($genres as $genre)
        <option {{ $band->genres()->find($genre->id) ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->name }}
        </option>
        @endforeach
    </select>
    @error('genres')
    <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>