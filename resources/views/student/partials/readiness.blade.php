{{-- Smart Readiness Hub: weighted readiness score + next best actions (dashboard). --}}
<style>
    .rd-card { background: #fff; border: 1px solid #e6e9ef; border-radius: 14px; padding: 24px 26px; margin-bottom: 24px; }
    .rd-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
    .rd-head h3 { font-size: 16px; color: #101a2b; }
    .rd-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }
    .rd-body { display: grid; grid-template-columns: 200px 1fr 1.1fr; gap: 28px; align-items: center; }

    .rd-ring { width: 150px; height: 150px; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;
        background: conic-gradient(#f97316 calc(var(--rd-pct) * 1%), #eef0f4 0); }
    .rd-ring-inner { width: 114px; height: 114px; border-radius: 50%; background: #fff; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .rd-ring-value { font-size: 30px; font-weight: 700; color: #101a2b; line-height: 1; }
    .rd-ring-label { font-size: 11px; color: #7c8493; margin-top: 5px; text-align: center; padding: 0 8px; }

    .rd-sections { display: flex; flex-direction: column; gap: 13px; }
    .rd-section-row { font-size: 12.5px; color: #37415a; }
    .rd-section-top { display: flex; justify-content: space-between; margin-bottom: 5px; font-weight: 600; }
    .rd-section-top span:last-child { color: #7c8493; font-weight: 700; }
    .rd-bar { height: 7px; border-radius: 10px; background: #eef0f4; overflow: hidden; }
    .rd-bar > div { height: 100%; border-radius: 10px; background: #f97316; }
    .rd-bar.is-full > div { background: #22a05a; }

    .rd-actions h4 { font-size: 12px; text-transform: uppercase; letter-spacing: 0.6px; color: #9aa2b0; margin-bottom: 10px; }
    .rd-action { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px 12px; border: 1px solid #eef0f4; border-radius: 9px; margin-bottom: 8px; color: inherit; text-decoration: none; transition: 0.15s; }
    .rd-action:hover { border-color: #f97316; background: #fff8f3; }
    .rd-action strong { display: block; font-size: 13px; color: #172033; }
    .rd-action span { display: block; font-size: 11.5px; color: #9aa2b0; margin-top: 2px; }
    .rd-points { flex-shrink: 0; font-size: 11.5px; font-weight: 700; color: #1b7a43; background: #eafaf0; padding: 4px 9px; border-radius: 20px; }
    .rd-done { display: flex; align-items: center; gap: 10px; padding: 14px; border-radius: 9px; background: #eafaf0; color: #1b7a43; font-size: 13px; font-weight: 600; }

    @media (max-width: 1100px) { .rd-body { grid-template-columns: 1fr; } }
</style>

<div class="rd-card">
    <div class="rd-head">
        <div>
            <h3>Application Readiness</h3>
            <p>Complete the steps below to raise your score and be ready to apply.</p>
        </div>
    </div>

    <div class="rd-body">
        <div>
            <div class="rd-ring" style="--rd-pct: {{ $readiness['percentage'] }};">
                <div class="rd-ring-inner">
                    <div class="rd-ring-value">{{ $readiness['percentage'] }}%</div>
                    <div class="rd-ring-label">{{ $readiness['label'] }}</div>
                </div>
            </div>
        </div>

        <div class="rd-sections">
            @foreach ($readiness['sections'] as $section)
                <div class="rd-section-row">
                    <div class="rd-section-top">
                        <span><i class="bi {{ $section['icon'] }}"></i> {{ $section['label'] }}</span>
                        <span>{{ $section['percent'] }}%</span>
                    </div>
                    <div class="rd-bar {{ $section['percent'] >= 100 ? 'is-full' : '' }}">
                        <div style="width: {{ $section['percent'] }}%;"></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="rd-actions">
            <h4>Next best actions</h4>

            @forelse ($readiness['actions'] as $action)
                <a href="{{ $action['url'] }}" class="rd-action">
                    <div>
                        <strong>{{ $action['label'] }}</strong>
                        <span>{{ $action['hint'] }}</span>
                    </div>
                    <div class="rd-points">+{{ $action['points'] }}%</div>
                </a>
            @empty
                <div class="rd-done">
                    <i class="bi bi-patch-check-fill"></i>
                    Everything is complete. You are ready to apply!
                </div>
            @endforelse
        </div>
    </div>
</div>
