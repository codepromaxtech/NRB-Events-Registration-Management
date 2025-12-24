<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Approved</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .header {
            background: linear-gradient(135deg, #00793A 0%, #005a2b 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
            line-height: 1.6;
        }
        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }
        .status-badge {
            display: inline-block;
            background-color: #d1fae5;
            color: #065f46;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 25px;
        }
        .attachment-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }
        .attachment-icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .btn {
            display: inline-block;
            background-color: #EC1C24;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #c9181f;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .footer a {
            color: #00793A;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>NRB Global Convention 2025</h1>
        </div>
        <div class="content">
            <div class="greeting">Hello {{ $registration->name }},</div>
            
            <div class="status-badge">✓ Registration Approved</div>
            
            <p class="message">
                We are delighted to inform you that your registration for the <strong>NRB Global Convention 2025</strong> has been successfully approved.
            </p>
            
            <p class="message">
                Your official <strong>Visiting Card</strong> has been generated and is attached to this email. Please keep it safe as it will serve as your entry pass.
            </p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ config('app.url') }}/dashboard" class="btn">View Dashboard</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} NRB Global Convention. All rights reserved.</p>
            <p>Developed by <a href="https://codepromax.com.de/" target="_blank">CodeProMax Tech</a></p>
        </div>
    </div>
</body>
</html>
