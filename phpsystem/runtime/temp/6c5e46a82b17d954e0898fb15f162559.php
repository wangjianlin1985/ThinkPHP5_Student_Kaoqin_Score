<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"C:\xampp\htdocs\phpsystem\public/../application/back\view\classInfo\classInfo_query.html";i:1539321737;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/classInfo.css" />

<div id="classInfo_manage"></div>
<div id="classInfo_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="classInfo_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="classInfo_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="classInfo_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="classInfo_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="classInfo_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="classInfoQueryForm" method="post">
			班级编号：<input type="text" class="textbox" id="classNo" name="classNo" style="width:110px" />
			班级名称：<input type="text" class="textbox" id="className" name="className" style="width:110px" />
			班主任姓名：<input type="text" class="textbox" id="banzhuren" name="banzhuren" style="width:110px" />
			成立日期：<input type="text" id="beginDate" name="beginDate" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="classInfo_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="classInfoEditDiv">
	<form id="classInfoEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">班级编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="classInfo_classNo_edit" name="classInfo_classNo" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">班级名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="classInfo_className_edit" name="classInfo_className" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">班主任姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="classInfo_banzhuren_edit" name="classInfo_banzhuren" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">成立日期:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="classInfo_beginDate_edit" name="classInfo_beginDate" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/classInfo/classInfo_manage.js"></script>
