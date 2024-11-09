<?php
// Database connection
$host = 'localhost';
$db = 'exam_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions and answers
$questions = $conn->query("SELECT * FROM questions");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Exam</h2>
        <form action="process_exam.php" method="POST" class="space-y-6">
            <?php $question_number = 1; // Initialize question counter ?>
            <?php while ($question = $questions->fetch_assoc()): ?>
                <div class="mb-4 p-4 border rounded-lg shadow-sm bg-gray-50">
                    <p class="font-medium mb-2"><?php echo $question_number . '. ' . $question['question_text']; ?></p>
                    <?php
                    $question_id = $question['question_id'];
                    $answers = $conn->query("SELECT * FROM answers WHERE question_id = $question_id");
                    ?>
                    <div class="space-y-2">
                        <?php while ($answer = $answers->fetch_assoc()): ?>
                            <label class="block">
                                <input type="radio" name="answers[<?php echo $question_id; ?>]"
                                    value="<?php echo $answer['answer_id']; ?>" required class="mr-2">
                                <?php echo $answer['answer_text']; ?>
                            </label>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php $question_number++; // Increment question counter ?>
            <?php endwhile; ?>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Submit Exam
            </button>
        </form>
    </div>
</body>

</html>