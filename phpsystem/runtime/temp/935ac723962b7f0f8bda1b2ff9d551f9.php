<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\xampp\htdocs\phpsystem\public/../application/back\view\attendance\attendance_query.html";i:1539321739;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/attendance.css" />

<div id="attendance_manage"></div>
<div id="attendance_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="attendance_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="attendance_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="attendance_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="attendance_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="attendance_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="attendanceQueryForm" method="post">
			学生：<input class="textbox" type="text" id="studentObj_studentNumber_query" name="studentObj.studentNumber" style="width: auto"/>
			课程：<input class="textbox" type="text" id="courseObj_courseNo_query" name="courseObj.courseNo" style="width: auto"/>
			时间：<input class="textbox" type="text" id="timeInfoObj_timeInfoId_query" name="timeInfoObj.timeInfoId" style="width: auto"/>
			状态：<input class="textbox" type="text" id="attendanceStateObj_stateId_query" name="attendanceStateObj.stateId" style="width: auto"/>
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="attendance_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="attendanceEditDiv">
	<form id="attendanceEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">记录编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="attendance_attendanceId_edit" name="attendance_attendanceId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">学生:</span>
			<span class="inputControl">
				<input class="textbox"  id="attendance_studentObj_studentNumber_edit" name="attendance_studentObj_studentNumber" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">课程:</span>
			<span class="inputControl">
				<input class="textbox"  id="attendance_courseObj_courseNo_edit" name="attendance_courseObj_courseNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">时间:</span>
			<span class="inputControl">
				<input class="textbox"  id="attendance_timeInfoObj_timeInfoId_edit" name="attendance_timeInfoObj_timeInfoId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">状态:</span>
			<span class="inputControl">
				<input class="textbox"  id="attendance_attendanceStateObj_stateId_edit" name="attendance_attendanceStateObj_stateId" style="width: auto"/>
			</span>
		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/attendance/attendance_manage.js"></script>
