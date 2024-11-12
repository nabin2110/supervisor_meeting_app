<!DOCTYPE html>
<html>
<head>
    <title>Meeting Reminder</title>
</head>
<body>
    <h1>Meeting Reminder</h1>
    <p>Subject: {{ $meetingSubject }}</p>
    <p>Time: {{ $meetingTime }}</p>
    <p>This is a reminder for your upcoming meeting.</p>
    <form action="{{ route('meeting.response') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden"  name="email" value="nabinthapa2110@gmail.com">
        <button type="submit" name="response" value="accept" >Accept</button>
        <button type="submit" name="response" value="reject">Reject</button>
    </form>
</body>
</html>
