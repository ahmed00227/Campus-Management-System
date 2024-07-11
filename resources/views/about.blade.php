<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Paradox Campus Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
        }

        p {
            color: #333;
            line-height: 1.6;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    @include('authentication.layout.header')
    <div class="container">
        <h1>About Paradox Campus Management</h1>
    </div>
</header>

<div class="container">
    <p>Welcome to Paradox Campus Management, your comprehensive solution for managing all aspects of campus life. Our platform is designed to streamline administrative tasks, enhance communication, and provide valuable resources to students, faculty, and staff.</p>
    <p>With Paradox, students can easily access academic information, manage their schedules, and collaborate with peers. Faculty members have tools to efficiently organize courses, track student progress, and communicate with students.</p>
    <p>We understand the importance of a well-equipped campus, which is why Paradox also provides information about campus facilities, events, and resources. Whether you're a student, faculty member, or administrator, Paradox is here to support your academic journey.</p>
</div>

<footer>
    <p class="text-white">&copy; 2024 Paradox Campus Management</p>
</footer>
</body>
</html>
