<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consultant Dashboard - INDIC RMC</title>

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
            background: #064e3b;
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
            background: #059669;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        h1 {
            color: #064e3b;
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
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .card h2 {
            color: #064e3b;
            font-size: 28px;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .section h2 {
            color: #064e3b;
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
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <div class="logo">INDIC RMC</div>

    <a href="/consultant/dashboard">Dashboard</a>
    <a href="#">My Students</a>
    <a href="#">Applications</a>
    <a href="#">Appointments</a>
    <a href="#">Consultations</a>
    <a href="#">Follow Ups</a>
    <a href="#">Availability</a>
    <a href="#">Settings</a>

</div>

<div class="main">

    <h1>Consultant Dashboard</h1>
    <p>Welcome back, Consultant 👋</p>

    <div class="cards">

        <div class="card">
            <h3>Assigned Students</h3>
            <h2>24</h2>
        </div>

        <div class="card">
            <h3>Pending Applications</h3>
            <h2>8</h2>
        </div>

        <div class="card">
            <h3>Today's Appointments</h3>
            <h2>5</h2>
        </div>

        <div class="card">
            <h3>Follow Ups</h3>
            <h2>7</h2>
        </div>

    </div>

    <div class="section">

        <h2>Today's Appointments</h2>

        <table>

            <tr>
                <th>Student</th>
                <th>Time</th>
                <th>Country</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>Kasun Perera</td>
                <td>10:00 AM</td>
                <td>Australia</td>
                <td>Confirmed</td>
            </tr>

            <tr>
                <td>Amal Silva</td>
                <td>1:00 PM</td>
                <td>Canada</td>
                <td>Pending</td>
            </tr>

            <tr>
                <td>Nimal Fernando</td>
                <td>3:30 PM</td>
                <td>New Zealand</td>
                <td>Confirmed</td>
            </tr>

        </table>

    </div>

</div>

</body>
</html>
