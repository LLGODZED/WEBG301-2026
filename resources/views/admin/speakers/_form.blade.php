@csrf
<div class="form-group"><label>Name</label><input name="name" value="{{ old('name', $speaker->name) }}" required></div>
<div class="form-group"><label>Email</label><input type="email" name="email" value="{{ old('email', $speaker->email) }}" required></div>
<div class="form-group"><label>Phone</label><input name="phone" value="{{ old('phone', $speaker->phone) }}"></div>
<div class="form-group"><label>Bio</label><textarea name="bio">{{ old('bio', $speaker->bio) }}</textarea></div>
<button class="btn" type="submit">Save speaker</button> <a class="btn btn-secondary" href="{{ route('admin.speakers.index') }}">Cancel</a>
