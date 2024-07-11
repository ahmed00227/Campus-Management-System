
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradox Campus Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
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

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .feature {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            flex: 1;
        }

        .feature i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .feature h2 {
            margin: 0;
        }

        .feature p {
            color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>
@include('authentication.layout.header')
@if(session('note'))
    <div class="alert alert-warning  w-25  text-center">
        {{session('note')}}
    </div>
@endif

<header>
    <div class="container">
        <h1>Welcome to Paradox Campus Management</h1>
    </div>
</header>

<div class="container">
    <div class="features">
        <div class="feature">
            <i class="fas fa-graduation-cap"></i>
            <h2>Academic Programs</h2>
            <p>Explore our wide range of academic programs.</p>
        </div>
        <div class="feature">
            <i class="fas fa-users"></i>
            <h2>Student Portal</h2>
            <p>Access student resources and manage your profile.</p>
        </div>
        <div class="feature">
            <i class="fas fa-chalkboard-teacher"></i>
            <h2>Faculty Portal</h2>
            <p>Tools and resources for our esteemed faculty members.</p>
        </div>
        <div class="feature">
            <i class="fas fa-building"></i>
            <h2>Campus Facilities</h2>
            <p>Explore our state-of-the-art campus facilities.</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Paradox Campus Management</p>
</footer>
</body>
</html>

