<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
</head>
<body>
<h2>Password Reset</h2>
<p>Hello there,</p>
<p>We received a request to reset your password for your Paradox Management System account. If you did not make this request, you can ignore this email.</p>
<p>To reset your password, click the button below:</p>
<a href="{{route('resetPassword',$user->password_reset_token)}}" class="btn btn-sm btn-success">Reset Password</a>
<p>If the button doesn't work, you can also copy and paste the following link into your web browser:</p>
<p>{{route('resetPassword',$user->password_reset_token)}}</p>
<p>If you have any questions or concerns, please don't hesitate to contact us.</p>
<p>Best regards,<br>Your Paradox Management System Team</p>
</body>
</html>
