{{--
    Smart tips card.
    Expects: $tips (array of ['type','icon','text']), $tipsTitle, $tipsSubtitle.
    Optional: $liveUrl - when set, the list re-renders as the student edits the preference fields.
--}}
<style>
    .tip-card { background: #fff; border: 1px solid #e6e9ef; border-radius: 12px; padding: 22px 26px; margin-bottom: 24px; }
    .tip-card-head h3 { font-size: 15px; color: #101a2b; }
    .tip-card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; margin-bottom: 14px; }
    .tip-list { display: flex; flex-direction: column; gap: 9px; }
    .tip-item { display: flex; align-items: flex-start; gap: 11px; padding: 11px 13px; border-radius: 9px; font-size: 13px; line-height: 1.45; }
    .tip-item i { font-size: 16px; margin-top: 1px; flex-shrink: 0; }
    .tip-success { background: #eafaf0; color: #1b7a43; }
    .tip-info { background: #eef4ff; color: #2a5db0; }
    .tip-warning { background: #fff7e6; color: #8a5a0b; }
    .tip-empty { font-size: 13px; color: #9aa2b0; }
</style>

<div class="tip-card" id="tip-card">
    <div class="tip-card-head">
        <h3><i class="bi bi-lightbulb-fill" style="color:#f97316;"></i> {{ $tipsTitle }}</h3>
        <p>{{ $tipsSubtitle }}</p>
    </div>

    <div class="tip-list" id="tip-list">
        @forelse ($tips as $tip)
            <div class="tip-item tip-{{ $tip['type'] }}">
                <i class="bi {{ $tip['icon'] }}"></i>
                <span>{{ $tip['text'] }}</span>
            </div>
        @empty
            <div class="tip-empty">Fill in the fields below and tips will appear here.</div>
        @endforelse
    </div>
</div>

@isset($liveUrl)
    <script>
        (function () {
            var list = document.getElementById('tip-list');
            var url = @json($liveUrl);
            var fields = ['preferred_country_id', 'preferred_course_level', 'preferred_course_field', 'max_budget', 'preferred_intake'];
            var timer = null;
            var requestId = 0;

            function render(tips) {
                list.replaceChildren();

                if (!tips.length) {
                    var empty = document.createElement('div');
                    empty.className = 'tip-empty';
                    empty.textContent = 'Fill in the fields below and tips will appear here.';
                    list.appendChild(empty);
                    return;
                }

                tips.forEach(function (tip) {
                    var item = document.createElement('div');
                    item.className = 'tip-item tip-' + (['success', 'info', 'warning'].includes(tip.type) ? tip.type : 'info');

                    var icon = document.createElement('i');
                    icon.className = 'bi ' + String(tip.icon).replace(/[^a-z0-9-]/gi, '');

                    var text = document.createElement('span');
                    text.textContent = tip.text;

                    item.appendChild(icon);
                    item.appendChild(text);
                    list.appendChild(item);
                });
            }

            function refresh() {
                var params = new URLSearchParams();
                fields.forEach(function (name) {
                    var input = document.getElementById(name);
                    if (input && input.value !== '') params.set(name, input.value);
                });

                var current = ++requestId;
                fetch(url + '?' + params.toString(), {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin'
                })
                    .then(function (response) { return response.ok ? response.json() : null; })
                    .then(function (data) {
                        if (data && current === requestId) render(data.tips || []);
                    })
                    .catch(function () { /* keep the last tips on a network error */ });
            }

            function schedule() {
                clearTimeout(timer);
                timer = setTimeout(refresh, 400);
            }

            // The card sits above the form, so wait for the fields to exist.
            document.addEventListener('DOMContentLoaded', function () {
                fields.forEach(function (name) {
                    var input = document.getElementById(name);
                    if (!input) return;
                    input.addEventListener('input', schedule);
                    input.addEventListener('change', schedule);
                });
            });
        })();
    </script>
@endisset
