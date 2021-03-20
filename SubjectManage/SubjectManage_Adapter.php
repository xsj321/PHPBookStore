<?php
require_once "Subject.php";
class SubjectManage_Adapter
{
   public function __construct(array $subject_list)
   {
       foreach ($subject_list as $item) {
           $this->display($item);
       }
   }

   private function display(Subject $subject){
       $subjectID = $subject->getClassID();
       $subjectName = $subject->getClassName();
       $subjectTerm = $subject->getClassTerm();
       $subjectTime = $subject->getClassTime();
       $subjectMark = $subject->getClassMark();
       $subjectIDtag = $subjectID."info";
       $subjectI_Delete = $subjectID."D";
       $subjectI_Delete_tag = $subjectI_Delete."D";

       echo <<<EOF
<div class="grid_item">
<div class="grid_item_header">
    <div>
    <form id="$subjectIDtag" action="SubjectManage_update/SubjectManage_update.php" method="post">
    <input name="subjectID" type="hidden" value="$subjectID">
    <input name="subjectName" type="hidden" value="$subjectName">
    <input name="subjectTerm" type="hidden" value="$subjectTerm">
    <input name="subjectTime" type="hidden" value="$subjectTime">
    <input name="subjectMark" type="hidden" value="$subjectMark">
    </form>
    <form id="$subjectI_Delete_tag" action="SubjectManage_delete/SubjectManage_delete.php" method="post">
    <input name="subjectID" type="hidden" value="$subjectID">
   </form>
        <img id="$subjectI_Delete" onclick="OnDelete(this);" src="Res/delete.png" alt="删除">
        课程号:<br><span>$subjectID</span><br>
        课程名称:<br><span>$subjectName</span>
    </div>
</div>
<div class="grid_item_message">
    开课学期:<span>$subjectTerm</span>学期<br><br>
    课程学时:<span>$subjectTime</span>学时<br><br>
    课程学分:<span>$subjectMark</span>分<br><br>
    
</div>
<div id="$subjectID" onclick="OnUpdateClick(this);" class="update">
<a>修改</a>
</div>
</div>
EOF;

   }
}