<?php
include("../../../conn.php");
$id = $_GET['id'];
$selQuestion = $conn->query("SELECT * FROM question_tbl WHERE ques_id='$id'")->fetch(PDO::FETCH_ASSOC);
if (!$selQuestion) {
    echo "Question not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Question</title>
    <link rel="stylesheet" type="text/css" href="../../../css/mycss.css">
</head>
<body>
<form method="post" id="updateQuestionFrm">
    <input type="hidden" name="ques_id" value="<?php echo $id; ?>">
    <label for="question">Question:</label>
    <textarea name="question" required><?php echo htmlspecialchars($selQuestion['question_text']); ?></textarea>
    <button type="submit">Update</button>
</form>
</body>
</html>