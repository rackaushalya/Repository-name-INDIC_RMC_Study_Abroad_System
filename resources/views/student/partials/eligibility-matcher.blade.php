{{-- Eligibility Matcher: the courses the student is closest to qualifying for (dashboard). --}}
<style>
    .em-card { background: #fff; border: 1px solid #e6e9ef; border-radius: 14px; padding: 24px 26px; margin-bottom: 24px; }
    .em-head h3 { font-size: 16px; color: #101a2b; }
    .em-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; margin-bottom: 18px; }
    .em-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 16px; }
    .em-course { border: 1px solid #e6e9ef; border-radius: 12px; padding: 18px; display: flex; flex-direction: column; }
    .em-course-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; margin-bottom: 4px; }
    .em-course h4 { font-size: 14.5px; color: #172033; }
    .em-meta { font-size: 12px; color: #7c8493; margin-bottom: 12px; }
    .em-badge { flex-shrink: 0; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; white-space: nowrap; }
    .em-eligible { background: #eafaf0; color: #1b7a43; }
    .em-close { background: #fff7e6; color: #8a5a0b; }
    .em-far { background: #fff1f1; color: #c0362c; }
    .em-bar { height: 7px; border-radius: 10px; background: #eef0f4; overflow: hidden; margin-bottom: 4px; }
    .em-bar > div { height: 100%; border-radius: 10px; background: #f97316; }
    .em-bar.is-full > div { background: #22a05a; }
    .em-score { font-size: 11.5px; color: #7c8493; margin-bottom: 12px; }
    .em-checks { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 8px; }
    .em-check { display: flex; gap: 9px; font-size: 12.5px; line-height: 1.4; }
    .em-check i { margin-top: 1px; flex-shrink: 0; }
    .em-check.is-pass i { color: #22a05a; }
    .em-check.is-fail i { color: #c0362c; }
    .em-check strong { color: #172033; }
    .em-check span { color: #7c8493; }
    .em-open { font-size: 12.5px; color: #7c8493; background: #f8fafc; border-radius: 8px; padding: 10px 12px; }
    .em-empty { font-size: 13px; color: #9aa2b0; padding: 14px 0; }
    .em-note { font-size: 11.5px; color: #9aa2b0; margin-top: 14px; }
    .em-roadmap { margin-top: auto; padding-top: 14px; }
    .em-roadmap a { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 700; color: #f97316; }
    .em-roadmap a:hover { text-decoration: underline; }
</style>

<div class="em-card">
    <div class="em-head">
        <h3><i class="bi bi-bullseye" style="color:#f97316;"></i> Courses You Can Aim For</h3>
        <p>Matched against your qualifications, English score, age, work experience and budget.</p>
    </div>

    @if ($eligibleCourses->isEmpty())
        <div class="em-empty">No active courses to match yet. Check back once courses are added.</div>
    @else
        <div class="em-grid">
            @foreach ($eligibleCourses as $match)
                @php
                    $course = $match['course'];
                    $statusLabel = ['eligible' => 'You qualify', 'close' => 'Almost there', 'far' => 'Not yet'][$match['status']];
                @endphp
                <div class="em-course">
                    <div class="em-course-top">
                        <h4>{{ $course->course_name }}</h4>
                        <span class="em-badge em-{{ $match['status'] }}">{{ $statusLabel }}</span>
                    </div>
                    <div class="em-meta">
                        {{ $course->university?->university_name ?? 'University' }}
                        @if ($course->university?->country)
                            · {{ $course->university->country->country_name }}
                        @endif
                        @if ($course->course_level)
                            · {{ $course->course_level }}
                        @endif
                    </div>

                    @if ($match['total'] > 0)
                        <div class="em-bar {{ $match['percent'] >= 100 ? 'is-full' : '' }}">
                            <div style="width: {{ $match['percent'] }}%;"></div>
                        </div>
                        <div class="em-score">{{ $match['passed'] }} of {{ $match['total'] }} requirements met</div>

                        <ul class="em-checks">
                            @foreach ($match['checks'] as $check)
                                <li class="em-check {{ $check['passed'] ? 'is-pass' : 'is-fail' }}">
                                    <i class="bi {{ $check['passed'] ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
                                    <div><strong>{{ $check['label'] }}.</strong> <span>{{ $check['detail'] }}</span></div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="em-open">This course has not published entry requirements yet, so there is nothing to check against.</div>
                    @endif

                    <div class="em-roadmap">
                        <a href="{{ route('student.roadmap.show', $course) }}">
                            View Admission Roadmap <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="em-note">Based on the requirements published for each course. The university makes the final decision.</div>
    @endif
</div>
