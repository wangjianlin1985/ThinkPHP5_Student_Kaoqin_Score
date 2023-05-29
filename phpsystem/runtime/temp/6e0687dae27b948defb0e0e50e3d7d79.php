<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\xampp\htdocs\phpsystem\public/../application/back\view\termInfo\termInfo_add.html";i:1539321736;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/termInfo.css" />
<div id="termInfoAddDiv">
	<form id="termInfoAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学期名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="termInfo_termName" name="termInfo_termName" style="width:200px" />

			</span>

		</div>
		<div class="operation">
			<a id="termInfoAddButton" class="easyui-linkbutton">添加</a>
			<a id="termInfoClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/termInfo/termInfo_add.js"></script>
