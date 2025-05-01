<!DOCTYPE html>
<html>
<head>
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            margin: 20px 0;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .footer {
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $name }}!</h1>
        <p>Thank you for using our service. Please confirm your account below:</p>
        
        <a href="https://v-record.resteban.tech/account/verify?code={{ $code }}&email={{ $email }}" class="btn">Click here to continue</a>

        <p>If you did not request this email, please ignore it.</p>
        <p>If you have any questions, feel free to contact us.</p>
        
        <div class="footer">
            <p>We hope you enjoy our service!</p>
        </div>
    </div>
</body>
</html>
