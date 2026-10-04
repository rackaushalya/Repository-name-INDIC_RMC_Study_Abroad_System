{{-- English score converter + course eligibility check (Qualifications > English tab). --}}
@php
    $converterSeed = $englishQualifications->first();
@endphp

<style>
    .ec-form { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; max-width: 520px; }
    .ec-result { margin-top: 6px; }
    .ec-chips { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px; margin-bottom: 14px; }
    .ec-chip { border: 1px solid #e6e9ef; border-radius: 10px; padding: 10px 12px; background: #f8fafc; }
    .ec-chip span { display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #9aa2b0; }
    .ec-chip strong { display: block; font-size: 18px; color: #101a2b; margin-top: 3px; }
    .ec-chip.is-input { border-color: #f97316; background: #fff8f3; }
    .ec-match { display: flex; align-items: center; gap: 12px; padding: 14px 16px; border-radius: 10px; background: #eafaf0; color: #1b7a43; font-size: 13.5px; font-weight: 600; }
    .ec-match.is-low { background: #fff7e6; color: #8a5a0b; }
    .ec-match i { font-size: 20px; }
    .ec-note { font-size: 11.5px; color: #9aa2b0; margin-top: 10px; }
    .ec-error { color: #c0362c; font-size: 12.5px; }
    @media (max-width: 600px) { .ec-form { grid-template-columns: 1fr; } }
</style>

<div class="card" id="english-converter">
    <div class="card-head">
        <div>
            <h3>English Score Converter</h3>
            <p>Enter a score to see its approximate equivalents and how many courses it already qualifies you for.</p>
        </div>
    </div>

    <div class="ec-form">
        <div class="field">
            <label for="ec_test">Test</label>
            <select id="ec_test">
                @foreach (\App\Services\EnglishScoreConverter::TESTS as $test)
                    <option value="{{ $test }}" @selected(($converterSeed?->test_type ?? 'IELTS') === $test)>{{ $test }}</option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="ec_score">Overall score</label>
            <input type="number" id="ec_score" step="0.5" min="0" placeholder="e.g. 6.5"
                value="{{ $converterSeed && in_array($converterSeed->test_type, \App\Services\EnglishScoreConverter::TESTS, true) ? rtrim(rtrim((string) $converterSeed->overall_score, '0'), '.') : '' }}">
        </div>
    </div>

    <div class="ec-result" id="ec_result" aria-live="polite"></div>
</div>

<script>
    (function () {
        var test = document.getElementById('ec_test');
        var score = document.getElementById('ec_score');
        var out = document.getElementById('ec_result');
        var url = @json(route('student.qualifications.english.convert'));
        var maxScores = @json(\App\Services\EnglishScoreConverter::MAX_SCORE);
        var timer = null;
        var requestId = 0;

        function el(tag, className, text) {
            var node = document.createElement(tag);
            if (className) node.className = className;
            if (text !== undefined) node.textContent = text;
            return node;
        }

        function showError(message) {
            out.replaceChildren(el('div', 'ec-error', message));
        }

        function render(data) {
            if (data.below_range) {
                showError(data.message);
                return;
            }

            var chips = el('div', 'ec-chips');
            Object.keys(data.equivalents).forEach(function (name) {
                var chip = el('div', 'ec-chip' + (name === test.value ? ' is-input' : ''));
                chip.appendChild(el('span', null, name));
                chip.appendChild(el('strong', null, String(data.equivalents[name])));
                chips.appendChild(chip);
            });

            var courses = data.courses;
            var matchClass = 'ec-match' + (courses.total > 0 && courses.qualifying === 0 ? ' is-low' : '');
            var match = el('div', matchClass);
            match.appendChild(el('i', 'bi bi-mortarboard-fill'));
            match.appendChild(el('span', null, courses.total > 0
                ? 'This score meets the English requirement for ' + courses.qualifying + ' of ' + courses.total + ' courses.'
                : 'No courses have published an English requirement yet.'));

            out.replaceChildren(chips, match,
                el('div', 'ec-note', 'Equivalents are approximate (based on IELTS ' + data.ielts_band + '). Each university makes the final decision.'));
        }

        function convert() {
            var value = parseFloat(score.value);

            if (score.value === '' || isNaN(value)) {
                out.replaceChildren();
                return;
            }
            if (value < 0 || value > maxScores[test.value]) {
                showError('The highest ' + test.value + ' score is ' + maxScores[test.value] + '.');
                return;
            }

            var current = ++requestId;
            fetch(url + '?test_type=' + encodeURIComponent(test.value) + '&score=' + encodeURIComponent(value), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(function (response) { return response.json().then(function (body) { return { ok: response.ok, body: body }; }); })
                .then(function (result) {
                    if (current !== requestId) return;
                    if (!result.ok) {
                        showError(result.body.message || 'Please check the score you entered.');
                        return;
                    }
                    render(result.body);
                })
                .catch(function () {
                    if (current === requestId) showError('Could not convert the score right now. Please try again.');
                });
        }

        function schedule() {
            clearTimeout(timer);
            timer = setTimeout(convert, 300);
        }

        test.addEventListener('change', convert);
        score.addEventListener('input', schedule);

        if (score.value !== '') convert();
    })();
</script>
