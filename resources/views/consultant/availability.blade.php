@extends('layouts.consultant')

@section('title', 'Availability')

@section('content')

<div class="page-header">
    <div>
        <h1>Availability</h1>
        <p>Set the days and times you're available for consultations.</p>
    </div>
</div>

@if (session('success'))
    <div class="panel" style="border-left:4px solid #146c43;margin-bottom:16px;">
        <div class="strong" style="color:#146c43">{{ session('success') }}</div>
    </div>
@endif

<div class="stack">

    {{-- ADD NEW SLOT --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Add a time slot</div>
        </div>

        <form method="POST" action="{{ route('consultant.availability.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label for="day_of_week">Day *</label>
                    <select id="day_of_week" name="day_of_week" required style="width:100%">
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" @selected(old('day_of_week') === $day)>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="start_time">Start time *</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', '09:00') }}" required>
                </div>
                <div class="field">
                    <label for="end_time">End time *</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time', '17:00') }}" required>
                </div>
                <div class="field" style="display:flex;align-items:flex-end;gap:8px;">
                    <label style="display:flex;align-items:center;gap:6px;font-weight:500;font-size:13px;margin:0;">
                        <input type="checkbox" name="is_available" value="1" checked style="width:auto">
                        Available
                    </label>
                </div>
            </div>

            @error('day_of_week')<div class="field"><div class="err">{{ $message }}</div></div>@enderror
            @error('start_time')<div class="field"><div class="err">{{ $message }}</div></div>@enderror
            @error('end_time')<div class="field"><div class="err">{{ $message }}</div></div>@enderror

            <div style="margin-top:16px">
                <button class="btn" type="submit">Add slot</button>
            </div>
        </form>
    </div>

    {{-- EXISTING SLOTS --}}
    <div class="panel">
        <div class="panel-header">
            <div class="panel-title">Your weekly schedule</div>
        </div>

        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr><th>Day</th><th>Start</th><th>End</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                @forelse ($availability as $slot)
                    <tr>
                        <td class="strong">{{ $slot->day_of_week }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}</td>
                        <td>
                            @if ($slot->is_available)
                                <span class="badge green">Available</span>
                            @else
                                <span class="badge grey">Unavailable</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <form class="inline-form" method="POST" action="{{ route('consultant.availability.update', $slot->availability_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="day_of_week" value="{{ $slot->day_of_week }}">
                                    <input type="hidden" name="start_time" value="{{ $slot->start_time }}">
                                    <input type="hidden" name="end_time" value="{{ $slot->end_time }}">
                                    <input type="hidden" name="is_available" value="{{ $slot->is_available ? 0 : 1 }}">
                                    <button class="btn btn-light btn-sm" type="submit">
                                        {{ $slot->is_available ? 'Mark unavailable' : 'Mark available' }}
                                    </button>
                                </form>
                                <form class="inline-form" method="POST" action="{{ route('consultant.availability.destroy', $slot->availability_id) }}" onsubmit="return confirm('Remove this slot?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light btn-sm" type="submit">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No availability slots added yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
