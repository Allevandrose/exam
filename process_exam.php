<?php
session_start();
$host = 'localhost';
$db = 'exam_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $score = 0;

        foreach ($_POST['answers'] as $question_id => $selected_answer_id) {
            $result = $conn->query("SELECT is_correct FROM answers WHERE answer_id = $selected_answer_id");
            $is_correct = $result->fetch_assoc()['is_correct'];
            if ($is_correct) {
                $score++;
            }
        }

        $stmt = $conn->prepare("INSERT INTO user_scores (user_id, score) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $score);

        if ($stmt->execute()) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Exam Completed!',
                        text: 'Your score is $score.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
            ";
        } else {
            $error = $stmt->error;
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error: $error',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
            ";
        }

        $stmt->close();
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'User Not Logged In',
                    text: 'Please log in to complete the exam.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
    }
}
