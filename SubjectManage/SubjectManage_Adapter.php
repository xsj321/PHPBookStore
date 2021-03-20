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
       $subjectIDtag = $subjectID."info";
       $subjectIDSelltag = $subjectID."sell";
       $subjectI_Delete = $subjectID."D";
       $subjectI_Delete_tag = $subjectI_Delete."D";

       echo <<<EOF
<div class="grid_item">
<div class="grid_item_header">
    <div>
    <form id="$subjectIDtag" action="SubjectManage_update/BookManage_sell.php" method="post">
    <input name="subjectID" type="hidden" value="$subjectID">
    <input name="subjectName" type="hidden" value="$subjectName">
    <input name="subjectTerm" type="hidden" value="$subjectTerm">
    <input name="subjectTime" type="hidden" value="$subjectTime">
    </form>
    
    <form id="$subjectIDSelltag" action="BookManage_sell/BookManage_sell.php" method="post">
    <input name="subjectID" type="hidden" value="$subjectID">
    <input name="subjectName" type="hidden" value="$subjectName">
    <input name="subjectTerm" type="hidden" value="$subjectTerm">
    <input name="subjectTime" type="hidden" value="$subjectTime">
    </form>
    
    
    <form id="$subjectI_Delete_tag" action="SubjectManage_delete/SubjectManage_delete.php" method="post">
    <input name="subjectID" type="hidden" value="$subjectID">
   </form>
        <img id="$subjectI_Delete" onclick="OnDelete(this);" src="Res/delete.png" alt="删除">
        书籍编号:<br><span>$subjectID</span><br>
        书籍名称:<br><span>$subjectName</span>
    </div>
</div>
<div class="grid_item_message">
    书籍数量:<span>$subjectTerm</span>册<br><br>
    售出数量:<span>$subjectTime</span>册<br><br>
    
</div>
<div id="$subjectID" onclick="OnUpdateClick(this);" class="update">
<a>修改</a>
</div>
<div id="$subjectID" onclick="OnSellClick(this);" class="update">
<a>出售</a>
</div>
</div>
EOF;

   }
}