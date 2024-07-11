<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment Confirmation</title>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <h2 style="text-align: center;">Course Enrollment Confirmation</h2>
    <p>Dear [Student's Name],</p>
    <p>We are pleased to inform you that you have been successfully enrolled in the course "<strong>[Course Title]</strong>." Here are the details:</p>
    <ul>
        <li><strong>Course Title:</strong> [Course Title]</li>
        <li><strong>Teacher:</strong> [Teacher's Name]</li>
        <li><strong>Date Enrolled:</strong> [Current Date]</li>
        <li><strong>Description:</strong> [Course Description]</li>
        <li><strong>Meeting Time:</strong> [Meeting Time, if applicable]</li>
        <li><strong>Location:</strong> [Location, if applicable]</li>
        <li><strong>Materials Required:</strong> [List of materials required]</li>
    </ul>
    <p>Please make sure to review the course materials and schedule. If you have any questions or need further assistance, don't hesitate to reach out to us.</p>
    <p>We wish you the best of luck in your studies!</p>
    <p>Best regards,</p>
    <p>[Your Name]<br>[Your Position]<br>[Your Contact Information]</p>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment Confirmation</title>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <h2 style="text-align: center;">Course Enrollment Confirmation</h2>
    <p>Dear Student,</p>
    <p>We are pleased to inform you that you have been successfully enrolled in the course "<strong>{{$course->course_name}}</strong>." Here are the details:</p>
    <ul>
        <li><strong>Course Title:</strong> {{$course->course_name}}</li>
        <li><strong>Teacher:</strong> {{$course->teacher->teacher_name}}</li>
        <li><strong>Course Code:</strong> {{$course->course_code}}</li>
        <li><strong>Credit Hours:</strong> {{$course->credit_hours}}</li>
        <li><strong>Date Enrolled:</strong> {{now()}}</li>

    </ul>
    <p>Please make sure to review the course materials and schedule. If you have any questions or need further assistance, don't hesitate to reach out to us.</p>
    <p>We wish you the best of luck in your studies!</p>
    <p>Best regards,</p>
</div>
</body>
</html>
