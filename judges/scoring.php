<?php
require_once '../includes/db.php';

// Fetch available participants
$users = $conn->query("SELECT * FROM users");

// Handle score submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judge_id = 1; // Hardcoded for demo
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $points = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 100]
    ]);
    
    if ($user_id && $points) {
        $stmt = $conn->prepare("INSERT INTO scores (judge_id, user_id, points) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $judge_id, $user_id, $points);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Judge Scoring</title>
    <style>
        /* Matching admin styling */
        .container { max-width: 600px; margin: 20px auto; padding: 20px; }
        select, input { display: block; margin: 10px 0; padding: 8px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Score Participants</h1>
        
        <form method="POST">
            <select name="user_id" required>
                <?php while($user = $users->fetch_assoc()): ?>
                    <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                <?php endwhile; ?>
            </select>
            
            <input type="number" name="points" min="1" max="100" placeholder="Points (1-100)" required>
            <button type="submit">Submit Score</button>
        </form>
    </div>
</body>
</html>