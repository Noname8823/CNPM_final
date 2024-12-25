<?php
include("../../../conn.php");
$id = $_GET['id'];
$selCourse = $conn->query("SELECT * FROM course_tbl WHERE cou_id='$id'")->fetch(PDO::FETCH_ASSOC);
if (!$selCourse) {
    echo "Course not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Course</title>
    <link rel="stylesheet" type="text/css" href="../../../../css/mycss.css">
</head>
<body>
<form method="post" id="updateCourseFrm">
    <input type="hidden" name="cou_id" value="<?php echo $id; ?>">
    <label for="course_name">Course Name:</label>
    <input type="text" name="course_name" required value="<?php echo htmlspecialchars($selCourse['cou_name']); ?>">
    <button type="submit">Update</button>
</form>
</body>
</html>