<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\course\course_add.html";i:1539321737;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/course.css" />
<div id="courseAddDiv">
	<form id="courseAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">课程编号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_courseNo" name="course_courseNo" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">课程名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_courseName" name="course_courseName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">任课教师:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_teacherName" name="course_teacherName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">上课地点:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_coursePlace" name="course_coursePlace" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">总课时:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_courseCount" name="course_courseCount" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">总学分:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="course_courseScore" name="course_courseScore" style="width:80px" />

			</span>

		</div>
		<div class="operation">
			<a id="courseAddButton" class="easyui-linkbutton">添加</a>
			<a id="courseClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/course/course_add.js"></script>
