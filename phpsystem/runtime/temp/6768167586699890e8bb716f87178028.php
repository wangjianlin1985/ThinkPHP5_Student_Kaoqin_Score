<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"C:\xampp\htdocs\phpsystem\public/../application/back\view\attendance\attendance_add.html";i:1539321739;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/attendance.css" />
<div id="attendanceAddDiv">
	<form id="attendanceAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学生:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="attendance_studentObj_studentNumber" name="attendance.studentObj.studentNumber" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">课程:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="attendance_courseObj_courseNo" name="attendance.courseObj.courseNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="attendance_timeInfoObj_timeInfoId" name="attendance.timeInfoObj.timeInfoId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">状态:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="attendance_attendanceStateObj_stateId" name="attendance.attendanceStateObj.stateId" style="width: auto"/>
			</span>
		</div>
		<div class="operation">
			<a id="attendanceAddButton" class="easyui-linkbutton">添加</a>
			<a id="attendanceClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/attendance/attendance_add.js"></script>
