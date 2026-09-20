@php
    $lead = $lead ?? null;
@endphp

<div class="form-group">
    <label>First Name *</label>
    <input type="text" name="first_name" value="{{ old('first_name', $lead->first_name ?? '') }}" required>
    @error('first_name') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" value="{{ old('last_name', $lead->last_name ?? '') }}">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $lead->email ?? '') }}">
</div>

<div class="form-group">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $lead->phone ?? '') }}">
</div>

<div class="form-group">
    <label>Source</label>
    <input type="text" name="source" value="{{ old('source', $lead->source ?? '') }}" placeholder="e.g. Instagram, WhatsApp, Referral">
</div>

<div class="form-group">
    <label>Interested Country</label>
    <select name="interested_country_id">
        <option value="">— Select —</option>
        @foreach ($countries as $country)
            <option value="{{ $country->country_id }}"
                @selected(old('interested_country_id', $lead->interested_country_id ?? '') == $country->country_id)>
                {{ $country->country_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Interested Course</label>
    <input type="text" name="interested_course" value="{{ old('interested_course', $lead->interested_course ?? '') }}">
</div>

<div class="form-group">
    <label>Status *</label>
    <select name="lead_status" required>
        @foreach (['New', 'Contacted', 'Qualified', 'Converted', 'Lost'] as $status)
            <option value="{{ $status }}"
                @selected(old('lead_status', $lead->lead_status ?? 'New') == $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Assigned Consultant</label>
    <select name="assigned_consultant_id">
        <option value="">— Unassigned —</option>
        @foreach ($consultants as $consultant)
            <option value="{{ $consultant->consultant_id }}"
                @selected(old('assigned_consultant_id', $lead->assigned_consultant_id ?? '') == $consultant->consultant_id)>
                {{ $consultant->user->name ?? 'Consultant #' . $consultant->consultant_id }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" rows="4">{{ old('notes', $lead->notes ?? '') }}</textarea>
</div>