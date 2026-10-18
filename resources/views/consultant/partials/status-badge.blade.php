@php
    $map = [
        'Requested' => 'orange', 'Confirmed' => 'blue', 'Completed' => 'green',
        'Cancelled' => 'grey', 'No Show' => 'red',
        'Active' => 'green', 'Follow-up Required' => 'orange', 'Closed' => 'grey',
        'Submitted' => 'grey', 'Under Review' => 'grey', 'Consultant Assigned' => 'blue',
        'Consultation Scheduled' => 'blue', 'Consultation Completed' => 'green',
        'Recommendation Provided' => 'green', 'Rejected' => 'red',
    ];
@endphp
<span class="badge {{ $map[$status ?? ''] ?? 'grey' }}">{{ $status ?? '-' }}</span>
