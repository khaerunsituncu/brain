<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $genre->name) }}" class="form-control">
    @error('name')
        <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>