<?php
require_once '../includes/db.php';

$result = $conn->query("
    SELECT u.id, u.name, SUM(s.points) AS total 
    FROM users u
    LEFT JOIN scores s ON u.id = s.user_id
    GROUP BY u.id
    ORDER BY total DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Live Scoreboard</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        tr:hover { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Competition Leaderboard</h1>
    
    <table id="scoreboard">
        <thead>
            <tr>
                <th>Participant</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['total'] ?? 0 ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
    // Auto-refresh every 5 seconds
    setInterval(() => {
        fetch(window.location.href)
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const newDoc = parser.parseFromString(data, 'text/html');
                const newTable = newDoc.querySelector('tbody').innerHTML;
                document.querySelector('tbody').innerHTML = newTable;
            });
    }, 5000);
    </script>
</body>
</html>