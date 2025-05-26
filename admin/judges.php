<?php
require_once '../includes/db.php';

// Add new judge
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $display_name = htmlspecialchars($_POST['display_name']);
    
    $stmt = $conn->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $display_name);
    
    if ($stmt->execute()) {
        $success = "Judge added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Judge Management</title>
    <style>
        /* Basic styling */
        .container { max-width: 600px; margin: 20px auto; padding: 20px; }
        .alert { padding: 10px; margin: 10px 0; }
        .success { background: #dff0d8; }
        .error { background: #f2dede; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Judge</h1>
        
        <?php if(isset($success)): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>
        
        <?php if(isset($error)): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Unique Username" required>
            <input type="text" name="display_name" placeholder="Display Name" required>
            <button type="submit">Add Judge</button>
        </form>
    </div>
</body>
</html>