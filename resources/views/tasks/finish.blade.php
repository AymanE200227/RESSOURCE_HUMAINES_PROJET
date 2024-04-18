<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finish Task</title>
</head>
<body>
    <h1>Finish Task</h1>
    <form action="{{ route('tasks.finish', $task->id) }}" method="POST">
        @csrf
        <button type="submit">Finish Task</button>
    </form>
</body>
</html>
