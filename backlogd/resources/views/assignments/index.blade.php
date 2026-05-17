<!DOCTYPE html>
<html>
<head>
    <title>Backlogd</title>
</head>
<body>

<h1>Backlogd Assignment Tracker</h1>

<form method="POST" action="/assignments">
    @csrf

    <input type="text" name="title" placeholder="Assignment Title">

    <input type="text" name="course" placeholder="Course">

    <select name="category">
        <option value="Final Exam">Final Exam</option>
        <option value="Long Exam">Long Exam</option>
        <option value="Quiz">Quiz</option>
        <option value="Homework">Homework</option>
    </select>

    <select name="status">
        <option value="Not Started">Not Started</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
        <option value="Abandoned">Abandoned</option>
    </select>

    <input type="datetime-local" name="deadline">

    <button type="submit">Save</button>
</form>

@if(count($assignments) > 0)
    <ul>
        @foreach($assignments as $assignment)
            <li>
                {{ $assignment['title'] }}
                - {{ $assignment['course'] }}
                - {{ $assignment['status'] }}
            </li>
        @endforeach
    </ul>
@endif

</body>
</html>