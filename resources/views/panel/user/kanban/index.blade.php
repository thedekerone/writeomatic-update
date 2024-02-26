@extends('panel.layout.app')
@section('title', 'Kanban')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Blogs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="bulk-schedule">
        <label for="bulk-day">Day:</label>
        <select id="bulk-day">
            <option value="">Select Day</option>
            <option value="monday">Monday</option>
            <!-- Add other days here -->
        </select>

        <label for="bulk-time">Time:</label>
        <select id="bulk-time">
            <option value="">Select Time</option>
            <option value="morning">Morning</option>
            <!-- Add other time options here -->
        </select>

        <button onclick="bulkSchedule()">Bulk Schedule</button>
    </div>

    <div class="blogs-list">
        <!-- Repeat this section for each blog -->
        <div class="blog">
            <input type="checkbox" class="bulk-select">
            <span class="blog-title">Blog Title</span>
            <select class="day">
                <option value="">Select Day</option>
                <option value="monday">Monday</option>
                <!-- Add other days here -->
            </select>
            <select class="time">
                <option value="">Select Time</option>
                <option value="morning">Morning</option>
                <!-- Add other time options here -->
            </select>
            <button onclick="schedule()">Schedule</button>
            <span class="status"></span>
        </div>
        <!-- End of blog section -->
    </div>

    <script src="script.js"></script> <!-- We'll add the JavaScript code later -->
</body>
</html>












@endsection