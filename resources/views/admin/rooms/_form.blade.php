@csrf
<div class="form-group">
    <label>Name</label>
    <input name="name" value="{{ old('name', $room->name) }}" required>
</div>
<div class="form-group">
    <label>Building</label>
    <input name="building" value="{{ old('building', $room->building) }}" required>
</div>
<div class="form-group">
    <label>Capacity</label>
    <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required>
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description">{{ old('description', $room->description) }}</textarea>
</div>
<button class="btn" type="submit">Save room</button>
<a class="btn btn-secondary" href="{{ route('admin.rooms.index') }}">Cancel</a>
