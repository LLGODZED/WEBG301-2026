@csrf
<div class="form-group"><label>Name</label><input name="name" value="{{ old('name', $track->name) }}" required></div>
<div class="form-group"><label>Color</label><input type="color" name="color" value="{{ old('color', $track->color ?: '#1d4ed8') }}" required></div>
<div class="form-group"><label>Description</label><textarea name="description">{{ old('description', $track->description) }}</textarea></div>
<button class="btn" type="submit">Save track</button> <a class="btn btn-secondary" href="{{ route('admin.tracks.index') }}">Cancel</a>
