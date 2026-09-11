<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - INDIC RMC</title>

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
            background: #172554;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
            text-align: center;
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
            background: #2563eb;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .top {
            margin-bottom: 30px;
        }

        .top h1 {
            color: #172554;
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
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
            color: #172554;
            font-size: 28px;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 15px;
            color: #172554;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 20px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <div class="logo">
        INDIC RMC
    </div>

    <a href="/student/dashboard">Dashboard</a>
    <a href="#">My Profile</a>
    <a href="#">Qualifications</a>
    <a href="#">Preferences</a>
    <a href="#">Documents</a>
    <a href="#">Recommendations</a>
    <a href="#">Applications</a>
    <a href="#">Appointments</a>
    <a href="#">Notifications</a>
    <a href="#">Settings</a>

</div>

<div class="main">

    <div class="top">
        <h1>Student Dashboard</h1>
        <p>Welcome back, Student 👋</p>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Profile Completion</h3>
            <h2>80%</h2>
        </div>

        <div class="card">
            <h3>Recommendations</h3>
            <h2>12</h2>
        </div>

        <div class="card">
            <h3>Applications</h3>
            <h2>3</h2>
        </div>

        <div class="card">
            <h3>Appointments</h3>
            <h2>2</h2>
        </div>

    </div>

    <div class="section">
        <h2>Application Status</h2>
        <p>Your consultancy application is currently:</p>
        <br>
        <span class="status">Under Review</span>
    </div>

    <div class="section">
        <h2>Latest Recommendations</h2>

        <p>🎓 University of Melbourne - Master of Information Technology</p>
        <br>
        <p>🎓 University of Toronto - Computer Science</p>
        <br>
        <p>🎓 University of Auckland - Software Engineering</p>

    </div>

</div>

</body>
</html>
