<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3300UND Job Application</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            color: #1f2937;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #0ea5e9;
            text-align: center;
        }
        p {
            margin: 8px 0;
            font-size: 14px;
            line-height: 20px;
        }
        .details {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin: 16px 0;
            padding: 16px;
            background: #f9fafb;
        }
        .details p {
            margin: 6px 0;
            font-size: 14px;
        }
        .footer {
            font-size: 12px;
            color: #6b7280;
            margin-top: 20px;
            text-align: center;
        }
        strong {
            color: #111827;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Job Application</h1>

        <p>There has been a new job application to your Workopia listing.</p>

        <p><strong>Job Title: </strong> {{ $job->title }}</p>

        <p><strong>Application Details:</strong></p>

        <div class="details">
            <p><strong>Full Name: </strong> {{ $application->full_name }}</p>
            <p><strong>Contact Phone: </strong> {{ $application->contact_phone }}</p>
            <p><strong>Contact Email: </strong> {{ $application->contact_email }}</p>
            <p><strong>Message: </strong> {{ $application->message }}</p>
            <p><strong>Location: </strong> {{ $application->location }}</p>
        </div>

        <p>Login to your Workopia account to view the applications.</p>

        <div class="footer">
            © {{ date('Y') }} 3300UND. All rights reserved.
        </div>
    </div>
</body>
</html>
