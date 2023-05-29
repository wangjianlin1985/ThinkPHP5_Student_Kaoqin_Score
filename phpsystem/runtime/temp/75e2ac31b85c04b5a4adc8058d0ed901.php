<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"C:\xampp\htdocs\phpsystem\public/../application/back\view\scoreInfo\scoreInfo_add.html";i:1539321738;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/scoreInfo.css" />
<div id="scoreInfoAddDiv">
	<form id="scoreInfoAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学生姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_studentNumber_studentNumber" name="scoreInfo.studentNumber.studentNumber" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">课程名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_courseNo_courseNo" name="scoreInfo.courseNo.courseNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">所在学期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_termId_termId" name="scoreInfo.termId.termId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">成绩得分:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_score" name="scoreInfo_score" style="width:80px" />

			</span>

		</div>
		<div class="operation">
			<a id="scoreInfoAddButton" class="easyui-linkbutton">添加</a>
			<a id="scoreInfoClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/scoreInfo/scoreInfo_add.js"></script>
