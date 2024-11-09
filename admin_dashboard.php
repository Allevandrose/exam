<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="admin_dashboard.php" class="text-white font-bold text-xl">Admin Dashboard</a>
            <a href="logout.php" class="text-white">Logout</a>
        </div>
    </nav>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Welcome, Admin</h1>
        <a href="add_question.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New
            Question</a>
    </div>
</body>

</html>