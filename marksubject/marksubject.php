<?php
$studentID = "";
$subjectID = "";
$subjectName = "";
$studentName = "";
$subjectGrade = "";
if ($_POST){
    $studentID = $_POST['studentID'];
    $subjectID = $_POST['subjectID'];
    $subjectName = " ".$_POST["subjectName"]." ";
    $studentName = " ".$_POST['studentName']." ";
    $subjectGrade = $_POST['subjectGrade'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>为<?php echo $studentName?>打分</title>
    <style>
        @import "marksubject.css";
    </style>
</head>
<body>
<form id="form" action="marksubject_submit.php" method="post">
    <div class="mid_pos">
        <div class="input">
            <a>为:<span><?php echo $studentName ?></span>打分：</a><br>
            <a>当前科目:<span><?php echo $subjectName ?></span></a><br>
            <input name="grade" type="number" value="<?php echo $subjectGrade?>"><span class="wei">分</span>
            <input name="subjectID" type="hidden" value="<?php echo $subjectID?>">
            <input name="studentID" type="hidden" value="<?php echo $studentID?>">
        </div>
        <div class="accept" onclick="OnClick()">
        √
        </div>
    </div>


</form>
<script>
    function OnClick() {
        let form =  document.getElementById("form");
        form.submit();
    }
</script>
</body>
</html>