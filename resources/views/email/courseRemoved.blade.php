<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Removal Notification</title>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <h2 style="text-align: center;">Course Removal Notification</h2>
    <p>Dear Student,</p>
    <p>We regret to inform you that you have been removed from the course "<strong>{{$course->course_name}}</strong>." Here are the details:</p>
    <ul>
        <li><strong>Course Title:</strong>{{$course->course_name}}</li>
        <li><strong>Teacher:</strong>{{$course->teacher->teacher_name}}</li>
        <li><strong>Date Removed:</strong> {{now()}}</li>
    </ul>
    <p>If you have any questions or concerns regarding this matter, please feel free to reach out to us.</p>
    <p>Best regards,</p>
</div>
</body>
</html>
