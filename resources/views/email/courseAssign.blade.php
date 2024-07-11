<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Course Assignment: {{$course->course_name}}</title>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <h2 style="text-align: center;">New Course Assignment: {{$course->course_name}}</h2>
    <p>Dear {{$teacher->user->teacher_name}},</p>
    <p>I hope this email finds you well. I am writing to inform you that a new course, "{{$course->course_name}}" has been assigned to you for teaching. Below are the details of the course:</p>
    <ul>
        <li><strong>Course Title:</strong>{{$course->course_name}}</li>
        <li><strong>Date Assigned:</strong> {{now()}}</li>
         </ul>
    <p>Your expertise and experience make you an excellent fit for this subject, and I am confident that you will deliver engaging and informative lessons to our students.</p>
    <p>If you have any questions or need further assistance regarding the course, please feel free to reach out to me.</p>
    <p>Thank you for your dedication to our students' education.</p>
    <p>Best regards,</p>
</div>
</body>
</html>
