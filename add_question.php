<?php
// Database connection
$host = 'localhost';
$db = 'exam_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $answers = $_POST['answers'];
    $correct_answer = $_POST['correct_answer'];

    // Insert the question
    $conn->query("INSERT INTO questions (question_text) VALUES ('$question_text')");
    $question_id = $conn->insert_id;

    // Insert the answers
    foreach ($answers as $key => $answer_text) {
        $is_correct = ($key == $correct_answer) ? 1 : 0;
        $conn->query("INSERT INTO answers (question_id, answer_text, is_correct) VALUES ('$question_id', '$answer_text', '$is_correct')");
    }

    echo "<div class='p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded'>Question and answers added successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Add a New Question</h2>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-lg font-semibold mb-2">Question:</label>
                <input type="text" name="question_text" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-lg font-semibold mb-2">Answers (mark the correct one):</label>
                <div class="flex items-center mb-2">
                    <input type="text" name="answers[]" placeholder="Answer 1" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="radio" name="correct_answer" value="0" class="ml-2">
                </div>
                <div class="flex items-center mb-2">
                    <input type="text" name="answers[]" placeholder="Answer 2" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="radio" name="correct_answer" value="1" class="ml-2">
                </div>
                <div class="flex items-center mb-2">
                    <input type="text" name="answers[]" placeholder="Answer 3" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="radio" name="correct_answer" value="2" class="ml-2">
                </div>
                <div class="flex items-center mb-2">
                    <input type="text" name="answers[]" placeholder="Answer 4" required
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="radio" name="correct_answer" value="3" class="ml-2">
                </div>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Add
                Question</button>
        </form>
    </div>
</body>

</html>