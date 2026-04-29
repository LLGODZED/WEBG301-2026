@csrf
<div class="grid grid-2">
    <div class="form-group"><label>Title</label><input name="title" value="{{ old('title', $session->title) }}" required></div>
    <div class="form-group"><label>Max attendees</label><input type="number" name="max_attendees" value="{{ old('max_attendees', $session->max_attendees ?: 30) }}" min="1" required></div>
</div>
<div class="form-group"><label>Description</label><textarea name="description" required>{{ old('description', $session->description) }}</textarea></div>
<div class="grid grid-2">
    <div class="form-group"><label>Start time</label><input type="datetime-local" name="start_time" value="{{ old('start_time', $session->start_time ? $session->start_time->format('Y-m-d\TH:i') : '') }}" required></div>
    <div class="form-group"><label>End time</label><input type="datetime-local" name="end_time" value="{{ old('end_time', $session->end_time ? $session->end_time->format('Y-m-d\TH:i') : '') }}" required></div>
</div>
<div class="grid grid-3">
    <div class="form-group"><label>Room</label><select name="room_id" required><option value="">Choose room</option>@foreach($rooms as $room)<option value="{{ $room->id }}" {{ old('room_id', $session->room_id) == $room->id ? 'selected' : '' }}>{{ $room->name }} ({{ $room->capacity }})</option>@endforeach</select></div>
    <div class="form-group"><label>Speaker</label><select name="speaker_id" required><option value="">Choose speaker</option>@foreach($speakers as $speaker)<option value="{{ $speaker->id }}" {{ old('speaker_id', $session->speaker_id) == $speaker->id ? 'selected' : '' }}>{{ $speaker->name }}</option>@endforeach</select></div>
    <div class="form-group"><label>Track</label><select name="track_id" required><option value="">Choose track</option>@foreach($tracks as $track)<option value="{{ $track->id }}" {{ old('track_id', $session->track_id) == $track->id ? 'selected' : '' }}>{{ $track->name }}</option>@endforeach</select></div>
</div>
<div class="grid grid-2">
    <div class="form-group"><label>Level</label><select name="level" required>@foreach($levels as $level)<option value="{{ $level }}" {{ old('level', $session->level) == $level ? 'selected' : '' }}>{{ $level }}</option>@endforeach</select></div>
    <div class="form-group"><label>Status</label><select name="status" required>@foreach($statuses as $status)<option value="{{ $status }}" {{ old('status', $session->status ?: 'published') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>@endforeach</select></div>
</div>
<button class="btn" type="submit">Save session</button> <a class="btn btn-secondary" href="{{ route('admin.sessions.index') }}">Cancel</a>
