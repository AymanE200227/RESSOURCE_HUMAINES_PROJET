<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Task</title>
</head>
<body>
    <h1>Start Task</h1>
    <form action="{{ route('tasks.start', $task->id) }}" method="POST">
        @csrf
        <button type="submit">Start Task</button>
    </form>
</body>
</html>
