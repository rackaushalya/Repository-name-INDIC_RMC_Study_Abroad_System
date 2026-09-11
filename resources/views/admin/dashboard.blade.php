<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - INDIC RMC</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            display: flex;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #111827;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #374151;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        h1 {
            color: #111827;
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

        .card h3 {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .card h2 {
            font-size: 28px;
            color: #111827;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            color: #6b7280;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">INDIC RMC</div>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="#">Students</a>
    <a href="#">Consultants</a>
    <a href="#">Countries</a>
    <a href="#">Universities</a>
    <a href="#">Courses</a>
    <a href="#">Scholarships</a>
    <a href="#">Applications</a>
    <a href="#">Appointments</a>
    <a href="#">Reports</a>
    <a href="#">Settings</a>

</div>

<div class="main">

    <h1>Admin Dashboard</h1>
    <p>Welcome back, Admin 👋</p>

    <div class="cards">

        <div class="card">
            <h3>Total Students</h3>
            <h2>1,250</h2>
        </div>

        <div class="card">
            <h3>Consultants</h3>
            <h2>18</h2>
        </div>

        <div class="card">
            <h3>Universities</h3>
            <h2>145</h2>
        </div>

        <div class="card">
            <h3>Applications</h3>
            <h2>325</h2>
        </div>

    </div>

    <div class="section">

        <h2>Recent Applications</h2>

        <table>

            <tr>
                <th>Student</th>
                <th>Country</th>
                <th>Course</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>Kasun Perera</td>
                <td>Australia</td>
                <td>Software Engineering</td>
                <td>Pending</td>
            </tr>

            <tr>
                <td>Amal Silva</td>
                <td>Canada</td>
                <td>Computer Science</td>
                <td>Approved</td>
            </tr>

            <tr>
                <td>Nimal Fernando</td>
                <td>New Zealand</td>
                <td>Information Technology</td>
                <td>Under Review</td>
            </tr>

        </table>

    </div>

</div>

</body>
</html>
