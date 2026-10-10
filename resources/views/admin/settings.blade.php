<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>System Settings | INDIC RMC</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .page {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 35px;
        }

        /* PAGE HEADER */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 30px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 15px;
        }

        .add-button {
            background: #2563eb;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        /* ALERTS */

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert ul {
            margin-top: 8px;
            padding-left: 20px;
        }

        /* SETTINGS CARD */

        .settings-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            vertical-align: top;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .setting-key {
            font-weight: 600;
            color: #111827;
        }

        .setting-value {
            color: #4b5563;
            max-width: 280px;
            word-break: break-word;
        }

        .description {
            color: #6b7280;
            max-width: 280px;
            word-break: break-word;
        }

        .updated-by {
            color: #4b5563;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-edit {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-edit:hover {
            background: #bfdbfe;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state h3 {
            margin-bottom: 8px;
            color: #374151;
        }

        /* MODAL */

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: #ffffff;
            width: 100%;
            max-width: 550px;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 22px;
            color: #111827;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 25px;
            cursor: pointer;
            color: #6b7280;
        }

        .close-button:hover {
            color: #111827;
        }

        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            outline: none;
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* MODAL FOOTER */

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-cancel:hover {
            background: #d1d5db;
        }

        .btn-save {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-save:hover {
            background: #1d4ed8;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {

            .page {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .actions {
                flex-direction: column;
                align-items: flex-start;
            }

        }

    </style>

@include('components.sidebar-style')
</head>


<body>

@include('components.admin-sidebar')

<div class="main">


<div class="page">


    <!-- =====================================================
         PAGE HEADER
    ====================================================== -->

    <div class="page-header">

        <div>

            <h1>
                System Settings
            </h1>

            <p>
                Manage system-wide configuration settings for INDIC RMC.
            </p>

        </div>


        <button
            type="button"
            class="add-button"
            onclick="openCreateModal()"
        >
            + Add Setting
        </button>

    </div>


    <!-- =====================================================
         SUCCESS MESSAGE
    ====================================================== -->

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <!-- =====================================================
         ERROR MESSAGE
    ====================================================== -->

    @if(session('error'))

        <div class="alert alert-error">

            {{ session('error') }}

        </div>

    @endif


    <!-- =====================================================
         VALIDATION ERRORS
    ====================================================== -->

    @if($errors->any())

        <div class="alert alert-error">

            <strong>
                Please fix the following errors:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- =====================================================
         SETTINGS TABLE
    ====================================================== -->

    <div class="settings-card">

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Setting Key
                        </th>

                        <th>
                            Value
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Last Updated By
                        </th>

                        <th>
                            Updated At
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($settings as $setting)


                        <tr>


                            <!-- SETTING KEY -->

                            <td>

                                <span class="setting-key">

                                    {{ $setting->setting_key }}

                                </span>

                            </td>


                            <!-- VALUE -->

                            <td>

                                <div class="setting-value">

                                    {{ $setting->setting_value ?? '—' }}

                                </div>

                            </td>


                            <!-- DESCRIPTION -->

                            <td>

                                <div class="description">

                                    {{ $setting->description ?? '—' }}

                                </div>

                            </td>


                            <!-- UPDATED BY -->

                            <td>

                                <span class="updated-by">

                                    @if($setting->updatedBy)

                                        {{ $setting->updatedBy->first_name ?? '' }}

                                        {{ $setting->updatedBy->last_name ?? '' }}

                                    @else

                                        System

                                    @endif

                                </span>

                            </td>


                            <!-- UPDATED DATE -->

                            <td>

                                @if($setting->updated_at)

                                    {{ $setting->updated_at->format('d M Y, h:i A') }}

                                @else

                                    —

                                @endif

                            </td>


                            <!-- ACTIONS -->

                            <td>

                                <div class="actions">


                                    <!-- EDIT -->

                                    <button
                                        type="button"
                                        class="btn btn-edit edit-setting-btn"
                                        data-id="{{ $setting->setting_id }}"
                                        data-key="{{ $setting->setting_key }}"
                                        data-value="{{ $setting->setting_value }}"
                                        data-description="{{ $setting->description }}"
                                    >
                                        Edit
                                    </button>


                                    <!-- DELETE -->

                                    <form
                                        method="POST"
                                        action="{{ route('admin.settings.destroy', $setting->setting_id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this setting?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>


                                </div>

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    <h3>
                                        No System Settings Found
                                    </h3>

                                    <p>
                                        Click "Add Setting" to create your first system setting.
                                    </p>

                                </div>

                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>

    </div>


</div>


<!-- =====================================================
     CREATE SETTING MODAL
====================================================== -->

<div
    id="createModal"
    class="modal"
>

    <div class="modal-content">


        <div class="modal-header">

            <h2>
                Add System Setting
            </h2>

            <button
                type="button"
                class="close-button"
                onclick="closeCreateModal()"
            >
                &times;
            </button>

        </div>


        <form
            method="POST"
            action="{{ route('admin.settings.store') }}"
        >

            @csrf


            <!-- SETTING KEY -->

            <div class="form-group">

                <label for="create_setting_key">
                    Setting Key
                </label>

                <input
                    type="text"
                    id="create_setting_key"
                    name="setting_key"
                    class="form-control"
                    placeholder="Example: company_name"
                    maxlength="100"
                    required
                >

            </div>


            <!-- SETTING VALUE -->

            <div class="form-group">

                <label for="create_setting_value">
                    Setting Value
                </label>

                <textarea
                    id="create_setting_value"
                    name="setting_value"
                    class="form-control"
                    placeholder="Enter setting value"
                ></textarea>

            </div>


            <!-- DESCRIPTION -->

            <div class="form-group">

                <label for="create_description">
                    Description
                </label>

                <textarea
                    id="create_description"
                    name="description"
                    class="form-control"
                    placeholder="Describe this setting"
                    maxlength="500"
                ></textarea>

            </div>


            <!-- FOOTER -->

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-cancel"
                    onclick="closeCreateModal()"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Save Setting
                </button>

            </div>


        </form>

    </div>

</div>


<!-- =====================================================
     EDIT SETTING MODAL
====================================================== -->

<div
    id="editModal"
    class="modal"
>

    <div class="modal-content">


        <div class="modal-header">

            <h2>
                Edit System Setting
            </h2>

            <button
                type="button"
                class="close-button"
                onclick="closeEditModal()"
            >
                &times;
            </button>

        </div>


        <form
            method="POST"
            id="editSettingForm"
        >

            @csrf

            @method('PUT')


            <!-- SETTING KEY -->

            <div class="form-group">

                <label for="edit_setting_key">
                    Setting Key
                </label>

                <input
                    type="text"
                    id="edit_setting_key"
                    name="setting_key"
                    class="form-control"
                    maxlength="100"
                    required
                >

            </div>


            <!-- SETTING VALUE -->

            <div class="form-group">

                <label for="edit_setting_value">
                    Setting Value
                </label>

                <textarea
                    id="edit_setting_value"
                    name="setting_value"
                    class="form-control"
                ></textarea>

            </div>


            <!-- DESCRIPTION -->

            <div class="form-group">

                <label for="edit_description">
                    Description
                </label>

                <textarea
                    id="edit_description"
                    name="description"
                    class="form-control"
                    maxlength="500"
                ></textarea>

            </div>


            <!-- FOOTER -->

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-cancel"
                    onclick="closeEditModal()"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="btn btn-save"
                >
                    Update Setting
                </button>

            </div>


        </form>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>


    /* =====================================================
       CREATE MODAL
    ====================================================== */

    function openCreateModal()
    {
        document
            .getElementById('createModal')
            .classList
            .add('show');
    }


    function closeCreateModal()
    {
        document
            .getElementById('createModal')
            .classList
            .remove('show');
    }


    /* =====================================================
       EDIT MODAL
    ====================================================== */

    function openEditModal(
        id,
        key,
        value,
        description
    )
    {

        document
            .getElementById('editModal')
            .classList
            .add('show');


        document
            .getElementById('edit_setting_key')
            .value = key || '';


        document
            .getElementById('edit_setting_value')
            .value = value || '';


        document
            .getElementById('edit_description')
            .value = description || '';


        document
            .getElementById('editSettingForm')
            .action =
            "{{ url('/admin/settings') }}/" + id;

    }


    function closeEditModal()
    {

        document
            .getElementById('editModal')
            .classList
            .remove('show');

    }


    /* =====================================================
       EDIT BUTTON EVENTS
    ====================================================== */

    document
        .querySelectorAll('.edit-setting-btn')
        .forEach(function(button)
        {

            button.addEventListener(
                'click',
                function()
                {

                    openEditModal(
                        this.dataset.id,
                        this.dataset.key,
                        this.dataset.value,
                        this.dataset.description
                    );

                }
            );

        });


    /* =====================================================
       CLOSE MODALS WHEN CLICKING OUTSIDE
    ====================================================== */

    window.addEventListener(
        'click',
        function(event)
        {

            const createModal =
                document.getElementById('createModal');

            const editModal =
                document.getElementById('editModal');


            if(event.target === createModal)
            {
                closeCreateModal();
            }


            if(event.target === editModal)
            {
                closeEditModal();
            }

        }
    );


</script>


</div>

</body>

</html>