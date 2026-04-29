@extends('layouts.app')
@section('title', 'Manage Rooms')
@section('content')
<section class="section"><div class="container">
@include('admin.partials.nav')
<div class="actions" style="justify-content:space-between;"><h1>Rooms</h1><a class="btn" href="{{ route('admin.rooms.create') }}">Create room</a></div>
<div class="table-wrap"><table><thead><tr><th>Name</th><th>Building</th><th>Capacity</th><th>Sessions</th><th>Actions</th></tr></thead><tbody>
@foreach($rooms as $room)
<tr><td>{{ $room->name }}</td><td>{{ $room->building }}</td><td>{{ $room->capacity }}</td><td>{{ $room->sessions_count }}</td><td class="actions"><a href="{{ route('admin.rooms.show', $room) }}">View</a><a href="{{ route('admin.rooms.edit', $room) }}">Edit</a><form method="POST" action="{{ route('admin.rooms.destroy', $room) }}">@csrf @method('DELETE')<button class="btn btn-danger btn-small" onclick="return confirm('Delete this room?')">Delete</button></form></td></tr>
@endforeach
</tbody></table></div>{{ $rooms->links() }}
</div></section>
@endsection
