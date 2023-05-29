<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\xampp\htdocs\phpsystem\public/../application/back\view\timeInfo\timeInfo_add.html";i:1539321740;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/timeInfo.css" />
<div id="timeInfoAddDiv">
	<form id="timeInfoAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学时名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="timeInfo_timeInfoName" name="timeInfo_timeInfoName" style="width:200px" />

			</span>

		</div>
		<div class="operation">
			<a id="timeInfoAddButton" class="easyui-linkbutton">添加</a>
			<a id="timeInfoClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/timeInfo/timeInfo_add.js"></script>
