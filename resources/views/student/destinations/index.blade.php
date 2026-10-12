<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Explore Destinations | INDIC RMC</title>

    @include('components.page-style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">

    <style>
        /* ---------- overview strip ---------- */
        .dx-hero {
            border-radius: 16px;
            padding: 22px 26px;
            margin-bottom: 20px;
            color: #fff;
            background: linear-gradient(120deg, #101a2b 0%, #1e3a8a 55%, #f97316 130%);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 18px;
        }
        .dx-hero div { display: flex; flex-direction: column; gap: 2px; }
        .dx-hero strong { font-size: 28px; line-height: 1.1; }
        .dx-hero span { font-size: 11.5px; letter-spacing: .5px; text-transform: uppercase; color: #c7d2fe; }

        /* ---------- map ---------- */
        .dx-map-wrap { position: relative; }
        .dx-map-wrap.is-full { position: fixed; inset: 0; z-index: 2000; background: #fff; }
        .dx-map-wrap.is-full .dx-map { height: 100vh; border-radius: 0; }

        /* zoom toolbar */
        .dx-zoom {
            display: flex; flex-direction: column; align-items: stretch; overflow: hidden; border-radius: 14px;
            background: #fff; box-shadow: 0 6px 20px rgba(16, 26, 43, .25); border: 0 !important; margin: 14px 14px 0 0 !important;
        }
        .dx-zoom button {
            width: 44px; height: 44px; border: 0; background: #fff; color: #101a2b; font-size: 20px; cursor: pointer;
            display: grid; place-items: center; transition: .15s; font-family: inherit;
        }
        .dx-zoom button + button, .dx-zoom .dx-zoom-level { border-top: 1px solid #eef0f4; }
        .dx-zoom button:hover:not(:disabled) { background: #f97316; color: #fff; }
        .dx-zoom button:disabled { color: #c3cad6; cursor: not-allowed; }
        .dx-zoom .dx-zoom-level { text-align: center; font-size: 11px; font-weight: 700; color: #566176; padding: 6px 0; background: #f8fafc; letter-spacing: .3px; }

        .dx-wheel-hint {
            position: absolute; inset: 0; z-index: 450; display: grid; place-items: center; pointer-events: none;
            background: rgba(16, 26, 43, .55); color: #fff; font-size: 15px; font-weight: 700; opacity: 0; transition: opacity .25s;
        }
        .dx-wheel-hint.show { opacity: 1; }
        .dx-map { height: 480px; background: #dbeafe; z-index: 1; border-radius: 0 0 14px 14px; }

        .dx-map-tools { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        .dx-seg { display: inline-flex; background: #f1f4f9; border-radius: 9px; padding: 3px; }
        .dx-seg button {
            border: 0; background: transparent; padding: 6px 12px; border-radius: 7px;
            font-family: inherit; font-size: 12px; font-weight: 600; color: #566176; cursor: pointer;
        }
        .dx-seg button.on { background: #fff; color: #f97316; box-shadow: 0 1px 4px rgba(16, 26, 43, .12); }

        .dx-legend {
            position: absolute; left: 14px; bottom: 14px; z-index: 500;
            background: rgba(255, 255, 255, .94); backdrop-filter: blur(6px);
            border-radius: 12px; padding: 10px 12px; max-width: 210px; max-height: 190px; overflow-y: auto;
            box-shadow: 0 6px 20px rgba(16, 26, 43, .18); font-size: 12px;
        }
        .dx-legend h4 { margin: 0 0 6px; font-size: 10.5px; letter-spacing: .6px; text-transform: uppercase; color: #8791a1; }
        .dx-legend button {
            display: flex; align-items: center; gap: 8px; width: 100%; text-align: left;
            border: 0; background: transparent; padding: 4px 2px; border-radius: 6px;
            font-family: inherit; font-size: 12px; color: #172033; cursor: pointer; text-transform: capitalize;
        }
        .dx-legend button:hover { background: #f1f4f9; }
        .dx-legend i { width: 11px; height: 11px; border-radius: 50%; flex-shrink: 0; box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--c); background: var(--c); }
        .dx-legend .own { margin-top: 6px; padding-top: 6px; border-top: 1px solid #eef0f4; color: #8791a1; display: flex; gap: 6px; align-items: center; }

        /* pins */
        .dx-pin { position: relative; width: 46px; height: 46px; }
        .dx-pin-body {
            position: absolute; inset: 0; border-radius: 50%; background: var(--c); border: 3px solid #fff;
            box-shadow: 0 6px 16px rgba(16, 26, 43, .35); display: grid; place-items: center; overflow: hidden;
            color: #fff; font-weight: 800; font-size: 14px; transition: transform .15s;
        }
        .dx-pin-body img { width: 100%; height: 100%; object-fit: cover; }
        .dx-pin-count {
            position: absolute; right: -6px; bottom: -4px; min-width: 22px; height: 22px; padding: 0 5px; border-radius: 11px;
            background: #101a2b; color: #fff; font-size: 11px; font-weight: 700; display: grid; place-items: center; border: 2px solid #fff;
        }
        .dx-pin.is-own::before {
            content: ""; position: absolute; inset: -9px; border-radius: 50%; border: 3px solid #16a34a;
            animation: dxPulse 1.8s ease-out infinite;
        }
        .dx-pin.hot .dx-pin-body { transform: scale(1.22); }
        @keyframes dxPulse { 0% { transform: scale(.7); opacity: .9; } 100% { transform: scale(1.35); opacity: 0; } }

        /* popups */
        .leaflet-popup-content-wrapper { padding: 0; overflow: hidden; border-radius: 16px; box-shadow: 0 14px 40px rgba(16, 26, 43, .3); }
        .leaflet-popup-content { margin: 0; width: 290px !important; font-family: Arial, Helvetica, sans-serif; }
        .dx-pop-head { display: flex; align-items: center; gap: 12px; padding: 14px 16px; color: #fff; background: linear-gradient(135deg, var(--c), #101a2b 160%); }
        .dx-pop-head img { width: 38px; height: 26px; object-fit: cover; border-radius: 4px; box-shadow: 0 0 0 2px rgba(255, 255, 255, .6); }
        .dx-pop-head strong { font-size: 17px; text-transform: capitalize; display: block; }
        .dx-pop-head small { opacity: .85; font-size: 11px; }
        .dx-pop-body { padding: 14px 16px 16px; }
        .dx-pop-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px; margin-bottom: 12px; }
        .dx-pop-stats div { background: #f6f8fb; border-radius: 9px; padding: 8px 4px; text-align: center; }
        .dx-pop-stats b { display: block; font-size: 16px; color: #101a2b; }
        .dx-pop-stats span { font-size: 9.5px; text-transform: uppercase; letter-spacing: .3px; color: #8791a1; }
        .dx-pop-row { font-size: 12px; color: #4a5568; margin-bottom: 7px; line-height: 1.45; }
        .dx-pop-row i { color: var(--c); margin-right: 6px; }
        .dx-pop-tags { display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 10px; }
        .dx-pop-tags span { font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 20px; background: #eef2ff; color: #3730a3; }
        .dx-pop-actions { display: flex; gap: 8px; margin-top: 12px; }
        .dx-pop-actions a, .dx-pop-actions button {
            flex: 1; text-align: center; padding: 9px 8px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;
            font-family: inherit; border: 1px solid #e1e5ed; background: #fff; color: #374151; text-decoration: none;
        }
        .dx-pop-actions a { background: var(--c); border-color: var(--c); color: #fff; }
        .leaflet-container a.dx-pop-link { color: #fff; }
        .leaflet-tooltip.dx-tip { border: 0; border-radius: 8px; background: #101a2b; color: #fff; font-weight: 700; font-size: 12px; padding: 5px 10px; text-transform: capitalize; box-shadow: 0 4px 14px rgba(0, 0, 0, .3); }
        .leaflet-tooltip.dx-tip::before { display: none; }

        .dx-map-note { padding: 14px 22px; font-size: 12px; color: #8791a1; border-top: 1px solid #eef0f4; }

        /* ---------- country cards ---------- */
        .dx-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 18px; padding: 22px; }

        .dx-card {
            position: relative; border: 1px solid #e7eaf0; border-radius: 16px; background: #fff; overflow: hidden;
            display: flex; flex-direction: column; transition: .18s;
        }
        .dx-card:hover, .dx-card.hot { border-color: var(--c); box-shadow: 0 12px 28px rgba(16, 26, 43, .1); transform: translateY(-2px); }
        .dx-card.is-picked { border-color: var(--c); box-shadow: 0 0 0 3px color-mix(in srgb, var(--c) 25%, transparent); }

        .dx-card-top {
            display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 14px 18px; color: #fff;
            background: linear-gradient(135deg, var(--c), #101a2b 190%);
        }
        .dx-card-top .id { display: flex; align-items: center; gap: 11px; min-width: 0; }
        .dx-card-top img { width: 38px; height: 26px; object-fit: cover; border-radius: 4px; box-shadow: 0 0 0 2px rgba(255, 255, 255, .55); flex-shrink: 0; }
        .dx-card-top .init { width: 38px; height: 26px; border-radius: 4px; background: rgba(255, 255, 255, .25); display: grid; place-items: center; font-weight: 800; font-size: 12px; flex-shrink: 0; }
        .dx-card-top h3 { margin: 0; font-size: 17px; text-transform: capitalize; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dx-card-top h3 a:hover { text-decoration: underline; }
        .dx-card-top .pg-badge { background: rgba(255, 255, 255, .92); color: #166534; }

        .dx-card-body { padding: 16px 18px 18px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
        .dx-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .dx-stats div { background: #f8fafc; border-radius: 10px; padding: 9px 6px; text-align: center; }
        .dx-stats strong { display: block; font-size: 18px; color: #101a2b; }
        .dx-stats span { font-size: 10px; color: #8791a1; text-transform: uppercase; letter-spacing: .3px; }

        .dx-line { font-size: 12.5px; color: #4a5568; display: flex; gap: 8px; line-height: 1.45; }
        .dx-line i { color: var(--c); margin-top: 1px; flex-shrink: 0; }
        .dx-tags { display: flex; gap: 6px; flex-wrap: wrap; }
        .dx-tags span { font-size: 10.5px; font-weight: 700; padding: 3px 9px; border-radius: 20px; background: #f1f4f9; color: #475569; }
        .dx-tags span.lvl { background: color-mix(in srgb, var(--c) 14%, #fff); color: var(--c); }

        .dx-foot { display: flex; justify-content: space-between; align-items: center; gap: 8px; margin-top: auto; padding-top: 4px; }
        .dx-pick { display: inline-flex; align-items: center; gap: 7px; font-size: 12px; font-weight: 600; color: #566176; cursor: pointer; }
        .dx-pick input { accent-color: var(--c); width: 16px; height: 16px; }
        .dx-foot-btns { display: flex; gap: 6px; }

        .dx-compare-bar {
            position: sticky; bottom: 16px; margin: 0 auto; max-width: 560px; background: #101a2b; color: #fff;
            border-radius: 12px; padding: 12px 16px; display: none; align-items: center; justify-content: space-between;
            gap: 12px; box-shadow: 0 10px 30px rgba(16, 26, 43, .3); z-index: 600; font-size: 13px;
        }
        .dx-compare-bar.show { display: flex; }

        .dx-filters { display: flex; gap: 10px; flex-wrap: wrap; width: 100%; align-items: center; }
        .dx-filters .pg-field { width: auto; min-width: 150px; }

        @media (max-width: 700px) {
            .dx-map { height: 340px; }
            .dx-legend { display: none; }
            .dx-zoom button { width: 40px; height: 40px; }
            .dx-filters .pg-field, .dx-filters .pg-search { width: 100%; flex: 1 1 100%; }
            .leaflet-popup-content { width: 250px !important; }
        }
    </style>

    @include('components.sidebar-style')
</head>
<body>

@include('components.student-sidebar')

@php
    $totals = [
        'universities' => $destinations->sum('universities'),
        'courses' => $destinations->sum('courses'),
        'scholarships' => $destinations->sum('scholarships'),
    ];

    $mapPoints = $destinations
        ->filter(fn ($d) => $d['lat'] !== null)
        ->map(fn ($d) => [
            'id' => $d['country']->country_id,
            'name' => $d['country']->country_name,
            'lat' => $d['lat'],
            'lng' => $d['lng'],
            'color' => $d['color'],
            'flag' => $d['flag'],
            'courses' => $d['courses'],
            'universities' => $d['universities'],
            'scholarships' => $d['scholarships'],
            'levels' => $d['levels'],
            'fields' => $d['fields'],
            'top' => $d['top_universities'],
            'fee' => $d['cheapest_fee'] ? $d['cheapest_fee']['currency'] . ' ' . number_format($d['cheapest_fee']['amount']) . ' / year' : null,
            'deadline' => $d['next_deadline']?->format('d M Y'),
            'url' => route('student.destinations.show', $d['country']),
            'own' => $d['country']->country_id === $preferredCountryId,
        ])
        ->values();
@endphp

<main class="main">

    <x-student-topbar current="Explore Destinations" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Explore Study Destinations</h1>
                <p>Find a country on the map, filter by what you want to study, and compare up to three side by side.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('student.preferences') }}" class="pg-btn">
                    <i class="bi bi-sliders"></i> My Preferences
                </a>
            </div>
        </div>

        @if (session('error'))
            <div class="pg-alert error"><i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="pg-alert error"><i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}</div>
        @endif

        {{-- At a glance --}}
        <div class="dx-hero">
            <div><strong>{{ $destinations->count() }}</strong><span>Destinations</span></div>
            <div><strong>{{ $totals['universities'] }}</strong><span>Universities</span></div>
            <div><strong>{{ $totals['courses'] }}</strong><span>Courses</span></div>
            <div><strong>{{ $totals['scholarships'] }}</strong><span>Scholarships</span></div>
        </div>

        {{-- Search + filters --}}
        <div class="pg-card">
            <form method="GET" action="{{ route('student.destinations.index') }}" class="pg-toolbar">
                <div class="dx-filters">
                    <div class="pg-search">
                        <i class="bi bi-search"></i>
                        <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search country, university or course">
                    </div>

                    <select name="level" class="pg-field" aria-label="Course level">
                        <option value="">Any level</option>
                        @foreach ($options['levels'] as $level)
                            <option value="{{ $level }}" @selected(($filters['level'] ?? '') === $level)>{{ $level }}</option>
                        @endforeach
                    </select>

                    <select name="field" class="pg-field" aria-label="Field of study">
                        <option value="">Any field</option>
                        @foreach ($options['fields'] as $field)
                            <option value="{{ $field }}" @selected(mb_strtolower($filters['field'] ?? '') === mb_strtolower($field))>{{ $field }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="budget" min="0" step="100" class="pg-field" style="max-width:190px;"
                           value="{{ $filters['budget'] ?? '' }}" placeholder="Max yearly tuition">

                    <button type="submit" class="pg-btn pg-btn-primary"><i class="bi bi-funnel"></i> Apply</button>

                    @if (array_filter($filters))
                        <a href="{{ route('student.destinations.index') }}" class="pg-btn">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Map --}}
        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-map"></i> World map</h2>

                <div class="dx-map-tools">
                    <div class="dx-seg" id="dxStyles" role="group" aria-label="Map style">
                        <button type="button" data-style="street" class="on">Colour</button>
                        <button type="button" data-style="roads">Streets</button>
                        <button type="button" data-style="satellite">Satellite</button>
                        <button type="button" data-style="light">Light</button>
                        <button type="button" data-style="dark">Dark</button>
                    </div>
                    <button type="button" class="pg-btn pg-btn-sm" id="dxFitAll"><i class="bi bi-arrows-fullscreen"></i> Show all</button>
                </div>
            </div>

            <div class="dx-map-wrap">
                <div id="dxMap" class="dx-map" role="img" aria-label="Map of study destinations"></div>

                <div class="dx-legend" id="dxLegend" hidden>
                    <h4>Destinations</h4>
                    <div id="dxLegendList"></div>
                    @if ($preferredCountryId)
                        <div class="own"><i style="--c:#16a34a;"></i> Your preferred country</div>
                    @endif
                </div>
            </div>

            <div class="dx-map-note" id="dxMapNote">Select a marker for details. Zoom with the + and - buttons, Ctrl + scroll, double-click or pinch. The number on each pin is how many courses it offers.</div>
        </div>

        {{-- Results --}}
        <div class="pg-card">
            <div class="pg-card-head">
                <h2><i class="bi bi-globe-europe-africa"></i> Destinations</h2>
                <small>Tick up to 3 to compare</small>
            </div>

            @if ($destinations->isEmpty())
                <div class="pg-empty">
                    <div class="pg-empty-icon"><i class="bi bi-search"></i></div>
                    <h3>No destinations match</h3>
                    <p>Try removing a filter or searching for something broader.</p>
                    <a href="{{ route('student.destinations.index') }}" class="pg-btn pg-btn-primary">Clear filters</a>
                </div>
            @else
                <div class="dx-grid">
                    @foreach ($destinations as $d)
                        @php $country = $d['country']; @endphp
                        <div class="dx-card" data-id="{{ $country->country_id }}" style="--c: {{ $d['color'] }};">
                            <div class="dx-card-top">
                                <div class="id">
                                    @if ($d['flag'])
                                        <img src="https://flagcdn.com/w80/{{ $d['flag'] }}.png" alt="" loading="lazy" onerror="this.style.display='none'">
                                    @else
                                        <span class="init">{{ strtoupper(mb_substr($country->country_name, 0, 2)) }}</span>
                                    @endif
                                    <h3><a href="{{ route('student.destinations.show', $country) }}">{{ $country->country_name }}</a></h3>
                                </div>

                                @if ($preferredCountryId === $country->country_id)
                                    <span class="pg-badge">Your preference</span>
                                @endif
                            </div>

                            <div class="dx-card-body">
                                <div class="dx-stats">
                                    <div><strong>{{ $d['universities'] }}</strong><span>Universities</span></div>
                                    <div><strong>{{ $d['courses'] }}</strong><span>Courses</span></div>
                                    <div><strong>{{ $d['scholarships'] }}</strong><span>Scholarships</span></div>
                                </div>

                                <div class="dx-line">
                                    <i class="bi bi-cash-coin"></i>
                                    <span>
                                        @if ($d['cheapest_fee'])
                                            Tuition from <strong>{{ $d['cheapest_fee']['currency'] }} {{ number_format($d['cheapest_fee']['amount']) }}</strong> / year
                                        @else
                                            Tuition not published yet
                                        @endif
                                    </span>
                                </div>

                                @if ($d['next_deadline'])
                                    <div class="dx-line">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>Next application deadline <strong>{{ $d['next_deadline']->format('d M Y') }}</strong></span>
                                    </div>
                                @endif

                                @if (count($d['top_universities']))
                                    <div class="dx-line">
                                        <i class="bi bi-building"></i>
                                        <span>{{ implode(' · ', $d['top_universities']) }}</span>
                                    </div>
                                @endif

                                @if (count($d['levels']) || count($d['fields']))
                                    <div class="dx-tags">
                                        @foreach ($d['levels'] as $level)<span class="lvl">{{ $level }}</span>@endforeach
                                        @foreach ($d['fields'] as $field)<span>{{ $field }}</span>@endforeach
                                    </div>
                                @endif

                                <div class="dx-foot">
                                    <label class="dx-pick">
                                        <input type="checkbox" class="dx-check" name="ids[]" value="{{ $country->country_id }}" form="compareForm">
                                        Compare
                                    </label>

                                    <div class="dx-foot-btns">
                                        @if ($d['lat'] !== null)
                                            <button type="button" class="pg-icon-btn dx-locate" data-id="{{ $country->country_id }}" title="Show on map" aria-label="Show {{ $country->country_name }} on map">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </button>
                                        @endif
                                        <a href="{{ route('student.destinations.show', $country) }}" class="pg-btn pg-btn-sm">
                                            Details <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <form id="compareForm" method="GET" action="{{ route('student.destinations.compare') }}"></form>

        <div class="dx-compare-bar" id="dxCompareBar">
            <span><strong id="dxCompareCount">0</strong> selected. Pick 2 or 3.</span>
            <button type="submit" form="compareForm" class="pg-btn pg-btn-primary pg-btn-sm" id="dxCompareBtn" disabled>
                <i class="bi bi-columns-gap"></i> Compare
            </button>
        </div>

    </section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
(function () {
    var points = {!! json_encode($mapPoints) !!};

    var note = document.getElementById('dxMapNote');
    var el = document.getElementById('dxMap');
    var markers = {};   // country id -> { marker, point }
    var map = null;

    function esc(value) {
        var d = document.createElement('div');
        d.textContent = value == null ? '' : String(value);
        return d.innerHTML;
    }

    function flagUrl(code, w) { return 'https://flagcdn.com/w' + w + '/' + code + '.png'; }

    function pinIcon(p) {
        var inner = p.flag
            ? '<img src="' + flagUrl(p.flag, 80) + '" alt="" onerror="this.remove()">'
            : esc(p.name.substring(0, 2).toUpperCase());

        return L.divIcon({
            className: '',
            iconSize: [46, 46],
            iconAnchor: [23, 23],
            popupAnchor: [0, -26],
            html: '<div class="dx-pin' + (p.own ? ' is-own' : '') + '" style="--c:' + esc(p.color) + ';">' +
                  '<div class="dx-pin-body">' + inner + '</div>' +
                  '<b class="dx-pin-count">' + esc(p.courses) + '</b></div>'
        });
    }

    function popupHtml(p) {
        var h = '<div style="--c:' + esc(p.color) + ';">';
        h += '<div class="dx-pop-head">' + (p.flag ? '<img src="' + flagUrl(p.flag, 80) + '" alt="" onerror="this.remove()">' : '') +
             '<div><strong>' + esc(p.name) + '</strong><small>' + (p.own ? 'Your preferred destination' : 'Study destination') + '</small></div></div>';
        h += '<div class="dx-pop-body">';
        h += '<div class="dx-pop-stats"><div><b>' + esc(p.universities) + '</b><span>Universities</span></div>' +
             '<div><b>' + esc(p.courses) + '</b><span>Courses</span></div>' +
             '<div><b>' + esc(p.scholarships) + '</b><span>Scholarships</span></div></div>';

        h += '<div class="dx-pop-row"><i class="bi bi-cash-coin"></i>' + (p.fee ? 'Tuition from <b>' + esc(p.fee) + '</b>' : 'Tuition not published yet') + '</div>';
        if (p.deadline) { h += '<div class="dx-pop-row"><i class="bi bi-calendar-event"></i>Next deadline <b>' + esc(p.deadline) + '</b></div>'; }
        if (p.top && p.top.length) { h += '<div class="dx-pop-row"><i class="bi bi-building"></i>' + p.top.map(esc).join(' · ') + '</div>'; }

        var tags = (p.levels || []).concat(p.fields || []);
        if (tags.length) { h += '<div class="dx-pop-tags">' + tags.map(function (t) { return '<span>' + esc(t) + '</span>'; }).join('') + '</div>'; }

        h += '<div class="dx-pop-actions"><a class="dx-pop-link" href="' + esc(p.url) + '">View details</a>' +
             '<button type="button" class="dx-pop-compare" data-id="' + esc(p.id) + '">Compare</button></div>';
        h += '</div></div>';
        return h;
    }

    function setHot(id, on) {
        var card = document.querySelector('.dx-card[data-id="' + id + '"]');
        if (card) { card.classList.toggle('hot', on); }
        var m = markers[id];
        if (m && m.marker._icon) {
            var pin = m.marker._icon.querySelector('.dx-pin');
            if (pin) { pin.classList.toggle('hot', on); }
            m.marker.setZIndexOffset(on ? 1000 : 0);
        }
    }

    function flyTo(id) {
        var m = markers[id];
        if (!m || !map) { return; }
        map.flyTo([m.point.lat, m.point.lng], Math.max(map.getZoom(), 4), { duration: 1.1 });
        m.marker.openPopup();
        document.getElementById('dxMap').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function fitAll() {
        if (!map || !points.length) { return; }
        if (points.length === 1) { map.setView([points[0].lat, points[0].lng], 4); return; }
        map.fitBounds(points.map(function (p) { return [p.lat, p.lng]; }), { padding: [60, 60], maxZoom: 4 });
    }

    if (typeof L === 'undefined') {
        el.style.display = 'none';
        note.textContent = 'The map could not be loaded. Use the destination cards below instead.';
    } else {
        map = L.map(el, {
            scrollWheelZoom: false,   // handled below: Ctrl/Cmd + scroll, so the page can still scroll
            doubleClickZoom: true,
            touchZoom: true,
            boxZoom: true,
            keyboard: true,
            worldCopyJump: true,
            zoomControl: false,
            zoomSnap: 0.5,
            zoomDelta: 1,
            minZoom: 2,
            maxZoom: 16
        }).setView([25, 10], 2);

        // Every style uses Esri tiles because they label places in English. (OpenStreetMap labels each country
        // in its own language, and CARTO's free tiles now need an API key.)
        var esri = function (path, max) {
            return L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/' + path + '/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: max || 16, attribution: 'Tiles &copy; Esri'
            });
        };

        var layers = {
            street: esri('World_Topo_Map', 18),                       // "Colour": terrain colours, English labels
            roads: esri('World_Street_Map', 18),                      // clean street map, English labels
            satellite: L.layerGroup([
                esri('World_Imagery', 18),
                esri('Reference/World_Boundaries_and_Places', 18)     // English country and city names on top of the photos
            ]),
            light: esri('Canvas/World_Light_Gray_Base'),
            dark: esri('Canvas/World_Dark_Gray_Base')
        };

        var current = 'street';
        layers.street.addTo(map);

        document.querySelectorAll('#dxStyles button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                map.removeLayer(layers[current]);
                current = btn.dataset.style;
                layers[current].addTo(map);
                document.querySelectorAll('#dxStyles button').forEach(function (b) { b.classList.toggle('on', b === btn); });
            });
        });

        // Zoom toolbar: in, level, out, reset, fullscreen
        var wrap = document.querySelector('.dx-map-wrap');
        var ZoomBar = L.Control.extend({
            options: { position: 'topright' },
            onAdd: function () {
                var box = L.DomUtil.create('div', 'dx-zoom leaflet-bar');
                box.innerHTML =
                    '<button type="button" data-act="in" title="Zoom in" aria-label="Zoom in"><i class="bi bi-plus-lg"></i></button>' +
                    '<div class="dx-zoom-level" id="dxZoomLevel" aria-live="polite">1x</div>' +
                    '<button type="button" data-act="out" title="Zoom out" aria-label="Zoom out"><i class="bi bi-dash-lg"></i></button>' +
                    '<button type="button" data-act="reset" title="Reset view" aria-label="Reset view"><i class="bi bi-house"></i></button>' +
                    '<button type="button" data-act="full" title="Full screen" aria-label="Toggle full screen"><i class="bi bi-fullscreen"></i></button>';

                L.DomEvent.disableClickPropagation(box);
                L.DomEvent.disableScrollPropagation(box);

                box.addEventListener('click', function (e) {
                    var b = e.target.closest('button');
                    if (!b) { return; }
                    if (b.dataset.act === 'in') { map.zoomIn(1); }
                    if (b.dataset.act === 'out') { map.zoomOut(1); }
                    if (b.dataset.act === 'reset') { fitAll(); }
                    if (b.dataset.act === 'full') { toggleFull(); }
                });
                return box;
            }
        });
        new ZoomBar().addTo(map);

        function syncZoomUi() {
            var z = map.getZoom();
            var lvl = document.getElementById('dxZoomLevel');
            if (lvl) { lvl.textContent = (Math.round(Math.pow(2, z - 2) * 10) / 10) + 'x'; }
            var inBtn = document.querySelector('.dx-zoom [data-act="in"]');
            var outBtn = document.querySelector('.dx-zoom [data-act="out"]');
            if (inBtn) { inBtn.disabled = z >= map.getMaxZoom(); }
            if (outBtn) { outBtn.disabled = z <= map.getMinZoom(); }
        }
        map.on('zoomend zoomlevelschange layeradd', syncZoomUi);
        syncZoomUi();

        function toggleFull(force) {
            var on = typeof force === 'boolean' ? force : !wrap.classList.contains('is-full');
            wrap.classList.toggle('is-full', on);
            document.body.style.overflow = on ? 'hidden' : '';
            var icon = document.querySelector('.dx-zoom [data-act="full"] i');
            if (icon) { icon.className = on ? 'bi bi-fullscreen-exit' : 'bi bi-fullscreen'; }
            setTimeout(function () { map.invalidateSize(); }, 50);
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && wrap.classList.contains('is-full')) { toggleFull(false); }
        });

        // Ctrl/Cmd + scroll (and trackpad pinch) zooms around the pointer; plain scroll keeps scrolling the page.
        var hint = document.createElement('div');
        hint.className = 'dx-wheel-hint';
        hint.textContent = (navigator.platform.indexOf('Mac') > -1 ? 'Use Cmd' : 'Use Ctrl') + ' + scroll to zoom the map';
        wrap.appendChild(hint);
        var hintTimer = null;

        function clampZoom(z) { return Math.max(map.getMinZoom(), Math.min(map.getMaxZoom(), z)); }

        el.addEventListener('wheel', function (e) {
            var step = e.deltaY < 0 ? 0.5 : -0.5;

            if (e.ctrlKey || e.metaKey || wrap.classList.contains('is-full')) {
                e.preventDefault();
                map.setZoomAround(map.mouseEventToContainerPoint(e), clampZoom(map.getZoom() + step), { animate: true });
                return;
            }

            hint.classList.add('show');
            clearTimeout(hintTimer);
            hintTimer = setTimeout(function () { hint.classList.remove('show'); }, 1100);
        }, { passive: false });

        var legend = document.getElementById('dxLegendList');

        points.forEach(function (p) {
            var marker = L.marker([p.lat, p.lng], { icon: pinIcon(p), riseOnHover: true }).addTo(map);
            marker.bindPopup(popupHtml(p), { maxWidth: 300, minWidth: 250, autoPanPadding: [30, 30] });
            marker.bindTooltip(p.name, { direction: 'top', offset: [0, -26], className: 'dx-tip' });
            marker.on('mouseover', function () { setHot(p.id, true); });
            marker.on('mouseout', function () { setHot(p.id, false); });
            markers[p.id] = { marker: marker, point: p };

            var item = document.createElement('button');
            item.type = 'button';
            item.innerHTML = '<i style="--c:' + esc(p.color) + ';"></i><span>' + esc(p.name) + '</span>';
            item.addEventListener('click', function () { flyTo(p.id); });
            legend.appendChild(item);
        });

        // Compare button inside a popup toggles that country's checkbox.
        map.on('popupopen', function (e) {
            var btn = e.popup.getElement().querySelector('.dx-pop-compare');
            if (!btn) { return; }
            var box = document.querySelector('.dx-check[value="' + btn.dataset.id + '"]');
            function label() { btn.textContent = box && box.checked ? 'Remove from compare' : 'Compare'; }
            label();
            btn.addEventListener('click', function () {
                if (box && !box.disabled) { box.checked = !box.checked; box.dispatchEvent(new Event('change')); label(); }
            });
        });

        if (points.length) {
            document.getElementById('dxLegend').hidden = false;
            fitAll();
        } else {
            note.textContent = 'Map locations are not available for these countries yet. Use the cards below.';
        }

        document.getElementById('dxFitAll').addEventListener('click', fitAll);

        document.querySelectorAll('.dx-locate').forEach(function (btn) {
            btn.addEventListener('click', function () { flyTo(btn.dataset.id); });
        });

        document.querySelectorAll('.dx-card').forEach(function (card) {
            card.addEventListener('mouseenter', function () { setHot(card.dataset.id, true); });
            card.addEventListener('mouseleave', function () { setHot(card.dataset.id, false); });
        });
    }

    // Compare picker (max 3)
    var checks = Array.prototype.slice.call(document.querySelectorAll('.dx-check'));
    var bar = document.getElementById('dxCompareBar');
    var count = document.getElementById('dxCompareCount');
    var btn = document.getElementById('dxCompareBtn');

    function refresh() {
        var picked = checks.filter(function (c) { return c.checked; });
        count.textContent = picked.length;
        bar.classList.toggle('show', picked.length > 0);
        btn.disabled = picked.length < 2;

        checks.forEach(function (c) {
            c.disabled = !c.checked && picked.length >= 3;
            c.closest('.dx-card').classList.toggle('is-picked', c.checked);
        });
    }

    checks.forEach(function (c) { c.addEventListener('change', refresh); });
    refresh();
})();
</script>

</body>
</html>
