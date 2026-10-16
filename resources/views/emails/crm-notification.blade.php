<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f7fb; color: #172033; margin: 0; padding: 0; }
        .wrapper { max-width: 480px; margin: 0 auto; padding: 30px 20px; }
        .card { background: #ffffff; border: 1px solid #e4e7ec; border-radius: 9px; padding: 28px; }
        .logo { font-size: 20px; font-weight: 800; margin-bottom: 20px; }
        .logo .indic { color: #172033; }
        .logo .rmc { color: #f97316; }
        h1 { font-size: 17px; margin: 0 0 12px; color: #111827; }
        p { font-size: 13px; line-height: 1.6; color: #4b5565; margin: 0 0 8px; }
        .footer { font-size: 10px; color: #8a93a3; margin-top: 22px; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="logo"><span class="indic">INDIC</span> <span class="rmc">RMC</span></div>

            <h1>{{ $notification->title }}</h1>

            <p>{{ $notification->message }}</p>
        </div>

        <div class="footer">
            This is an automated message from the INDIC RMC Study Abroad Consultancy system.
        </div>
    </div>
</body>
</html>
