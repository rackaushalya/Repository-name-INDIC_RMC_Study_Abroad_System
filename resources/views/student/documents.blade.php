<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INDIC RMC - Documents</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f7fb; color: #172033; }
        a { text-decoration: none; color: inherit; }

        .sidebar { position: fixed; left: 0; top: 0; width: 245px; height: 100vh; background: #101a2b; color: white; padding: 25px 15px; overflow-y: auto; }
        .logo { padding: 0 12px; margin-bottom: 35px; }
        .logo-main { font-size: 25px; font-weight: 700; color: #f97316; }
        .logo-main span { color: white; }
        .logo-subtitle { font-size: 8px; letter-spacing: 0.8px; color: #aeb7c7; margin-top: 4px; }
        .menu-section { margin-bottom: 25px; }
        .menu-title { color: #7e8ba1; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin: 0 12px 10px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; margin-bottom: 4px; border-radius: 7px; color: #cbd3df; font-size: 13px; transition: 0.2s; }
        .menu-item:hover { background: #1d2a40; color: white; }
        .menu-item.active { background: #f97316; color: white; }
        .menu-icon { width: 19px; height: 19px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

        .main { margin-left: 245px; min-height: 100vh; }
        .topbar { height: 72px; background: white; border-bottom: 1px solid #e6e9ef; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; position: sticky; top: 0; z-index: 10; }
        .topbar h2 { font-size: 17px; color: #101a2b; }
        .user { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: #f97316; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; }
        .user-info strong { display: block; font-size: 13px; color: #172033; }
        .user-info span { font-size: 11px; color: #8b95a5; }

        .content { padding: 30px; max-width: 1040px; }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; color: #101a2b; margin-bottom: 4px; }
        .page-header p { font-size: 13px; color: #7c8493; }

        .alert { padding: 12px 16px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #eafaf0; color: #1b7a43; border: 1px solid #cdeed9; }
        .alert-error { background: #fff1f1; color: #c0362c; border: 1px solid #f6cfcc; }
        .alert ul { margin: 0; padding-left: 18px; }

        .card { background: white; border: 1px solid #e6e9ef; border-radius: 12px; padding: 24px 26px; margin-bottom: 22px; }
        .card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
        .card-head h3 { font-size: 15px; color: #101a2b; }
        .card-head p { font-size: 12px; color: #9aa2b0; margin-top: 3px; }

        .req-list { display: flex; flex-direction: column; gap: 10px; }
        .req-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 14px; border: 1px solid #eef0f4; border-radius: 8px; font-size: 13px;
        }
        .req-item .name { font-weight: 600; color: #172033; }
        .req-item .desc { font-size: 12px; color: #9aa2b0; margin-top: 2px; }
        .tag { font-size: 10.5px; font-weight: 700; padding: 3px 9px; border-radius: 20px; }
        .tag-mandatory { background: #fff1e8; color: #c2560b; }
        .tag-optional { background: #eef0f4; color: #7c8493; }
        .tag-uploaded { background: #eafaf0; color: #1b7a43; margin-left: 8px; }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 12.5px; font-weight: 600; color: #37415a; margin-bottom: 6px; }
        .field input, .field select {
            width: 100%; padding: 10px 13px; border: 1px solid #dfe4ec; border-radius: 8px;
            font-size: 13.5px; color: #172033; background: #f8fafc; font-family: inherit;
        }
        .field input:focus, .field select:focus { outline: none; border-color: #f97316; background: white; }
        .field-error { color: #c0362c; font-size: 12px; margin-top: 5px; }
        .hint { font-size: 11.5px; color: #9aa2b0; margin-top: -10px; margin-bottom: 16px; }

        .btn-primary { padding: 10px 20px; background: #f97316; color: white; border: none; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; }
        .btn-primary:hover { background: #ea6a0f; }

        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        thead th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #9aa2b0; padding: 10px 12px; border-bottom: 1px solid #e6e9ef; }
        tbody td { padding: 12px; border-bottom: 1px solid #f1f3f7; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .doc-name { font-weight: 600; color: #172033; }
        .doc-meta { font-size: 11.5px; color: #9aa2b0; margin-top: 2px; }
        .status-badge { font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: capitalize; }
        .status-pending { background: #fff7e6; color: #b7791f; }
        .status-verified { background: #eafaf0; color: #1b7a43; }
        .status-rejected { background: #fff1f1; color: #c0362c; }
        .row-actions { display: flex; gap: 10px; }
        .row-actions a, .row-actions button { font-size: 12px; font-weight: 700; color: #f97316; background: none; border: none; cursor: pointer; font-family: inherit; padding: 0; }
        .row-actions .danger { color: #c0362c; }

        .empty-state { font-size: 13px; color: #9aa2b0; padding: 20px 0; text-align: center; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .grid-2 { grid-template-columns: 1fr; }
            table, thead, tbody, tr, td { display: block; width: 100%; }
            thead { display: none; }
            tbody tr { margin-bottom: 12px; border: 1px solid #eef0f4; border-radius: 8px; }
        }

    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">
        <div class="logo-main">INDIC <span>RMC</span></div>
        <div class="logo-subtitle">STUDY ABROAD, BRIGHTER TOMORROWS</div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Main</div>
        <a href="{{ route('student.dashboard') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span></a>
        <a href="{{ route('student.profile') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-person-fill"></i></div><span>My Profile</span></a>
        <a href="{{ route('student.qualifications') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Qualifications</span></a>
        <a href="{{ route('student.preferences') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-sliders"></i></div><span>Study Preferences</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Study Abroad</div>
        <a href="{{ route('student.applications.index') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Consultancy Application</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-star-fill"></i></div><span>Recommendations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-calendar2-check-fill"></i></div><span>Appointments</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-chat-dots-fill"></i></div><span>Consultations</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-arrow-repeat"></i></div><span>Follow-ups</span></a>
        <a href="#" class="menu-item"><div class="menu-icon"><i class="bi bi-cash-coin"></i></div><span>Fund Requirement</span></a>
        <a href="{{ route('student.documents') }}" class="menu-item active"><div class="menu-icon"><i class="bi bi-folder2-open"></i></div><span>Required Documents</span></a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Account</div>
        <a href="{{ route('student.account.edit') }}" class="menu-item"><div class="menu-icon"><i class="bi bi-gear-fill"></i></div><span>Account Settings</span></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;font-family:inherit;">
                <div class="menu-icon"><i class="bi bi-box-arrow-right"></i></div><span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <h2>Documents</h2>
        <a href="{{ route('student.account.edit') }}" class="user" style="text-decoration:none; color:inherit;">
            @if ($student->user->profile_image_url ?? null)
                <img src="{{ $student->user->profile_image_url }}" class="user-avatar" alt="" style="object-fit: cover;">
            @else
                <div class="user-avatar">{{ strtoupper(substr($student->user->first_name ?? 'S', 0, 1)) }}</div>
            @endif
            <div class="user-info">
                <strong>{{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: 'Student' }}</strong>
                <span>Student</span>
            </div>
        </a>
    </header>

    <section class="content">

        <div class="page-header">
            <h1>Document Management</h1>
            <p>Upload the documents your consultant and universities need, and track their review status.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($requiredDocuments->isNotEmpty())
            <div class="card">
                <div class="card-head">
                    <div>
                        <h3>Required Documents</h3>
                        <p>Documents typically requested for your study abroad application</p>
                    </div>
                </div>

                <div class="req-list">
                    @foreach ($requiredDocuments as $required)
                        @php
                            $isUploaded = $documents->contains('required_document_id', $required->required_document_id);
                        @endphp
                        <div class="req-item">
                            <div>
                                <div class="name">{{ $required->document_name }}</div>
                                @if ($required->description)
                                    <div class="desc">{{ $required->description }}</div>
                                @endif
                            </div>
                            <div>
                                <span class="tag {{ $required->is_mandatory ? 'tag-mandatory' : 'tag-optional' }}">
                                    {{ $required->is_mandatory ? 'Mandatory' : 'Optional' }}
                                </span>
                                @if ($isUploaded)
                                    <span class="tag tag-uploaded">Uploaded</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-head">
                <div>
                    <h3>Upload a Document</h3>
                    <p>PDF, JPG, PNG, DOC or DOCX — max 5MB</p>
                </div>
            </div>

            <form method="POST" action="{{ route('student.documents.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid-2">
                    <div class="field">
                        <label for="document_name">Document name</label>
                        <input type="text" id="document_name" name="document_name"
                            value="{{ old('document_name') }}" placeholder="e.g. Passport Copy" required>
                        @error('document_name')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="required_document_id">Related required document (optional)</label>
                        <select id="required_document_id" name="required_document_id">
                            <option value="">Not applicable</option>
                            @foreach ($requiredDocuments as $required)
                                <option value="{{ $required->required_document_id }}" @selected(old('required_document_id') == $required->required_document_id)>
                                    {{ $required->document_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('required_document_id')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="field">
                    <label for="file">Choose file</label>
                    <input type="file" id="file" name="file" required
                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    @error('file')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-primary">Upload Document</button>
            </form>
        </div>

        <div class="card">
            <div class="card-head">
                <div>
                    <h3>My Uploaded Documents</h3>
                    <p>{{ $documents->count() }} file(s)</p>
                </div>
            </div>

            @if ($documents->isEmpty())
                <div class="empty-state">You haven't uploaded any documents yet.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Document</th>
                            <th>Linked To</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>
                                    <div class="doc-name">{{ $document->document_name }}</div>
                                    <div class="doc-meta">{{ $document->original_name }}</div>
                                </td>
                                <td>{{ $document->requiredDocument?->document_name ?? '—' }}</td>
                                <td>{{ optional($document->uploaded_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    <span class="status-badge status-{{ $document->status }}">{{ $document->status }}</span>
                                    @if ($document->status === 'rejected' && $document->remarks)
                                        <div class="doc-meta">{{ $document->remarks }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="row-actions">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" rel="noopener">View</a>
                                        <form method="POST" action="{{ route('student.documents.destroy', $document) }}" onsubmit="return confirm('Remove this document?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </section>

</main>

</body>
</html>
