<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Student Dashboard</title>
</head>

<body class="bg-gray-100">
    <nav class="bg-green-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="student_dashboard.php" class="text-white font-bold text-xl">Student Dashboard</a>
            <a href="logout.php" class="text-white">Logout</a>
        </div>
    </nav>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Welcome, Student</h1>
        <a href="exam.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Take Exam</a>
        <a href="view_results.php"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4">View Results</a>
    </div>
</body>

</html>