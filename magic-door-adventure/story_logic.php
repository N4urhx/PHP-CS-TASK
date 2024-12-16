<?php
// Riddle setup: Each riddle has a question, the correct answer (door), and an explanation
$riddles = [
    1 => [
        "question" => "I speak without a mouth and hear without ears. I have no body, but I come alive with wind. What am I?",
        "answer" => 2, // Correct door for the first riddle
        "message" => "An echo!"
    ],
    2 => [
        "question" => "The more of this you take, the more you leave behind. What is it?",
        "answer" => 3, // Correct door for the second riddle
        "message" => "Footsteps!"
    ],
    3 => [
        "question" => "I am not alive, but I can grow. I don’t have lungs, but I need air. What am I?",
        "answer" => 1, // Correct door for the third riddle
        "message" => "Fire!"
    ]
];

// Get the selected door and the current riddle number from the URL
$door = isset($_GET['door']) ? $_GET['door'] : null;
$riddle_number = isset($_GET['riddle']) ? $_GET['riddle'] : 1;

if (!$door) {
    // Redirect to the homepage if no door is selected
    header("Location: index.php");
    exit;
}

// Check the correct answer for the current riddle
$correct_answer = $riddles[$riddle_number]['answer'];

// Prepare the response message
if ($door == $correct_answer) {
    $riddle_number++;
    if ($riddle_number > count($riddles)) {
        // All riddles solved, redirect to the treasure page
        header("Location: treasure.php");
        exit;
    } else {
        $message = "Correct! " . $riddles[$riddle_number - 1]['message'] . " Here is your next riddle:";
    }
} else {
    $message = "Wrong! Try again.";
    $retry_riddle = $riddles[$riddle_number];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Door Adventure</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Magic Door Adventure</h1>
        <div class="story-box">
            <p><?php echo $message; ?></p>
            <?php if ($door == $correct_answer && isset($riddles[$riddle_number])): ?>
                <p><strong>Next Riddle:</strong> <?php echo $riddles[$riddle_number]['question']; ?></p>
            <?php elseif ($door != $correct_answer): ?>
                <p><strong>Riddle:</strong> <?php echo $retry_riddle['question']; ?></p>
            <?php endif; ?>
        </div>
        <div class="doors">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <a href="story_logic.php?door=<?php echo $i; ?>&riddle=<?php echo $riddle_number; ?>">
                    <img src="door<?php echo $i; ?>.png" alt="Door <?php echo $i; ?>">
                </a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
