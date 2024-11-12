<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome BCC Organization Portal</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="message">
        <p>We have created an account for you. Please find your login details below:</p>
        <p>Email: {{$email}}</p>
        <p>Temporary Password: {{$password}}</p>
        <p>For security reasons, we strongly recommend logging in and updating your password as soon as possible.</p>
        <p>Login here: {{url('/login')}}</p>
    </div>

</div>
</body>

</html>