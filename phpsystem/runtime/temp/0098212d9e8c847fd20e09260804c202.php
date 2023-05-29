<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"C:\xampp\htdocs\phpsystem\public/../application/back\view\scoreInfo\scoreInfo_query.html";i:1539321738;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/scoreInfo.css" />

<div id="scoreInfo_manage"></div>
<div id="scoreInfo_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="scoreInfo_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="scoreInfo_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="scoreInfo_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="scoreInfo_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="scoreInfo_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="scoreInfoQueryForm" method="post">
			学生姓名：<input class="textbox" type="text" id="studentNumber_studentNumber_query" name="studentNumber.studentNumber" style="width: auto"/>
			课程名称：<input class="textbox" type="text" id="courseNo_courseNo_query" name="courseNo.courseNo" style="width: auto"/>
			所在学期：<input class="textbox" type="text" id="termId_termId_query" name="termId.termId" style="width: auto"/>
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="scoreInfo_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="scoreInfoEditDiv">
	<form id="scoreInfoEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">成绩编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_scoreId_edit" name="scoreInfo_scoreId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">学生姓名:</span>
			<span class="inputControl">
				<input class="textbox"  id="scoreInfo_studentNumber_studentNumber_edit" name="scoreInfo_studentNumber_studentNumber" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">课程名称:</span>
			<span class="inputControl">
				<input class="textbox"  id="scoreInfo_courseNo_courseNo_edit" name="scoreInfo_courseNo_courseNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">所在学期:</span>
			<span class="inputControl">
				<input class="textbox"  id="scoreInfo_termId_termId_edit" name="scoreInfo_termId_termId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">成绩得分:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="scoreInfo_score_edit" name="scoreInfo_score" style="width:80px" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/scoreInfo/scoreInfo_manage.js"></script>
