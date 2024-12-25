<?php
include("../../../conn.php");
$id = $_GET['id'];
$selExaminee = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$id'")->fetch(PDO::FETCH_ASSOC);
if (!$selExaminee) {
    echo "Examinee not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Examinee</title>
    <link rel="stylesheet" type="text/css" href="../../../css/mycss.css">
</head>
<body>
<form method="post" id="updateExamineeFrm">
    <input type="hidden" name="exmne_id" value="<?php echo $id; ?>">
    <label for="fullname">Full Name:</label>
    <input type="text" name="fullname" required value="<?php echo htmlspecialchars($selExaminee['exmne_fullname']); ?>">
    <button type="submit">Update</button>
</form>
</body>
</html>