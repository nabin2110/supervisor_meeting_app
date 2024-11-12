<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Create Meeting Date Time</h2>
    <form action="{{ route('meeting.store') }}" method="post">
        @csrf
        <div>
            <label for="meeting_subject">Meeting Subject</label>
            <input type="text" name="meeting_subject">
        </div>
        <div>
            <label for="meeting_time">Meeting Time</label>
            <input type="time" name="meeting_time">
        </div>
        <button type="submit">Create Meeting</button>
    </form>
</body>
</html>
