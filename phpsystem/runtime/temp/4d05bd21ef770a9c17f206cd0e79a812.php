<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:93:"C:\xampp\htdocs\phpsystem\public/../application/front\view\scoreInfo\scoreInfo_frontlist.html";i:1539321738;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1539324983;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>成绩信息查询</title>
<link href="__PUBLIC__/plugins/bootstrap.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-dashen.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/font-awesome.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/animate.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body style="margin-top:70px;">
<div class="container">
<!--导航开始-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!--小屏幕导航按钮和logo-->
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="__PUBLIC__/index.php" class="navbar-brand">php设计网</a>
        </div>
        <!--小屏幕导航按钮和logo-->
        <!--导航-->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="__PUBLIC__/index.php">首页</a></li>
                <li><a href="<?php echo url('TermInfo/frontlist'); ?>">学期信息</a></li>
                <li><a href="<?php echo url('ClassInfo/frontlist'); ?>">班级信息</a></li>
                <li><a href="<?php echo url('Student/frontlist'); ?>">学生信息</a></li>
                <li><a href="<?php echo url('Course/frontlist'); ?>">课程信息</a></li>
                <li><a href="<?php echo url('ScoreInfo/frontlist'); ?>">成绩信息</a></li>
                <li><a href="<?php echo url('Attendance/frontlist'); ?>">学生点名</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(\think\Session::get('user_name') == null): ?>
                <li><a href="#" onclick="register();" style="display:none;"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;注册</a></li>
                <li><a href="#" onclick="login();" style="display:none;"><i class="fa fa-user"></i>&nbsp;&nbsp;登录</a></li>
                    <?php else: ?>
                <li class="dropdown">
                    <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo \think\Session::get('user_name'); ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="__PUBLIC__/index.php"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;首页</a></li>
                        <li><a href="<?php echo url('BookType/frontlist'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;发布信息</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;我发布的信息</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;修改个人资料</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;我的收藏</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('Index/logout'); ?>"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;退出</a></li>
                <?php endif; ?>
            </ul>

        </div>
        <!--导航-->
    </div>
</nav>
<!--导航结束-->


<div id="loginDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-key"></i>&nbsp;系统登录</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="loginForm" id="loginForm" enctype="multipart/form-data" method="post"  class="mar_t15">

                    <div class="form-group">
                        <label for="userName" class="col-md-3 text-right">用户名:</label>
                        <div class="col-md-9">
                            <input type="text" id="userName" name="userName" class="form-control" placeholder="请输入用户名">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3 text-right">密码:</label>
                        <div class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control" placeholder="登录密码">
                        </div>
                    </div>

                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxLogin();">登录</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div id="registerDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-sign-in"></i>&nbsp;用户注册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="registerForm" id="registerForm" enctype="multipart/form-data" method="post"  class="mar_t15">



                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxRegister();">注册</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<script>

    function register() {
        $("#registerDialog input").val("");
        $("#registerDialog textarea").val("");
        $('#registerDialog').modal('show');
    }
    function ajaxRegister() {
        $("#registerForm").data('bootstrapValidator').validate();
        if(!$("#registerForm").data('bootstrapValidator').isValid()){
            return;
        }

        jQuery.ajax({
            type : "post" ,
            url : basePath + "UserInfo/add",
            dataType : "json" ,
            data: new FormData($("#registerForm")[0]),
            success : function(obj) {
                if(obj.success){
                    alert("注册成功！");
                    $("#registerForm").find("input").val("");
                    $("#registerForm").find("textarea").val("");
                }else{
                    alert(obj.message);
                }
            },
            processData: false,
            contentType: false,
        });
    }


    function login() {
        $("#loginDialog input").val("");
        $('#loginDialog').modal('show');
    }
    function ajaxLogin() {
        $.ajax({
            url : "<?php echo url('Index/frontLogin'); ?>",
            type : 'post',
            dataType: "json",
            data : {
                "userName" : $('#userName').val(),
                "password" : $('#password').val(),
            },
            success : function (obj, response, status) {
                if (obj.success) {
                    location.href = "__PUBLIC__/index.php";
                } else {
                    alert(obj.msg);
                }
            }
        });
    }


</script>

	<div class="row"> 
		<div class="col-md-9 wow fadeInDown" data-wow-duration="0.5s">
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
			    	<li><a href="__PUBLIC__/index.php">首页</a></li>
			    	<li role="presentation" class="active"><a href="#scoreInfoListPanel" aria-controls="scoreInfoListPanel" role="tab" data-toggle="tab">成绩信息列表</a></li>
			    	<li role="presentation" ><a href="<?php echo url('ScoreInfo/frontAdd'); ?>" style="display:none;">添加成绩信息</a></li>
				</ul>
			  	<!-- Tab panes -->
			  	<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="scoreInfoListPanel">
				    		<div class="row">
				    			<div class="col-md-12 top5">
				    				<div class="table-responsive">
				    				<table class="table table-condensed table-hover">
				    					<tr class="success bold"><td>序号</td><td>成绩编号</td><td>学生姓名</td><td>课程名称</td><td>所在学期</td><td>成绩得分</td><td>操作</td></tr>
				    					<?php
				    						/*计算起始序号*/
				    	            		$startIndex = ($currentPage-1) * $rows;
				    	            		$currentIndex = $startIndex+1;
				    	            		/*遍历记录*/
				    					if(is_array($scoreInfoRs) || $scoreInfoRs instanceof \think\Collection): $i = 0; $__LIST__ = $scoreInfoRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scoreInfo): $mod = ($i % 2 );++$i;?>
 										<tr>
 											<td><?php echo $currentIndex++; ?></td>
 											<td><?php echo $scoreInfo['scoreId']; ?></td>
 											<td><?php echo $scoreInfo['studentNumberF']['studentName']; ?></td>
 											<td><?php echo $scoreInfo['courseNoF']['courseName']; ?></td>
 											<td><?php echo $scoreInfo['termIdF']['termName']; ?></td>
 											<td><?php echo $scoreInfo['score']; ?></td>
 											<td>
 												<a href="<?php echo url('ScoreInfo/frontshow',array('scoreId'=>$scoreInfo['scoreId'])); ?>"><i class="fa fa-info"></i>&nbsp;查看</a>&nbsp;
 												<a href="#" onclick="scoreInfoEdit('<?php echo $scoreInfo['scoreId']; ?>');" style="display:none;"><i class="fa fa-pencil fa-fw"></i>编辑</a>&nbsp;
 												<a href="#" onclick="scoreInfoDelete('<?php echo $scoreInfo['scoreId']; ?>');" style="display:none;"><i class="fa fa-trash-o fa-fw"></i>删除</a>
 											</td> 
 										</tr>
 										<?php endforeach; endif; else: echo "" ;endif; ?>
				    				</table>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="row">
					            <div class="col-md-12">
						            <nav class="pull-left">
						                <ul class="pagination">
						                    <li><a href="#" onclick="GoToPage(<%=currentPage-1 %>,<%=totalPage %>);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						                     <?php
						                    	$startPage = $currentPage - 5;
						                    	$endPage = $currentPage + 5;
						                    	if($startPage < 1) $startPage=1;
						                    	if($endPage > $totalPage) $endPage = $totalPage;
						                    	for($i=$startPage;$i<=$endPage;$i++) {
						                    ?>
						                    <li class="<?php echo $currentPage==$i?"active":""; ?>"><a href="#"  onclick="GoToPage(<?php echo $i; ?>,<?php echo $totalPage; ?>);"><?php echo $i; ?></a></li>
						                    <?php } ?>
						                    <li><a href="#" onclick="GoToPage(<?php echo $currentPage + 1; ?>,<?php echo $totalPage; ?>);"><span aria-hidden="true">&raquo;</span></a></li>
						                </ul>
						            </nav>
						            <div class="pull-right" style="line-height:75px;" >共有<?php echo $recordNumber; ?>条记录，当前第<?php echo $currentPage; ?>/<?php echo $totalPage; ?>页</div>
					            </div>
				            </div> 
				    </div>
				</div>
			</div>
		</div>
	<div class="col-md-3 wow fadeInRight">
		<div class="page-header">
    		<h1>成绩信息查询</h1>
		</div>
		<form name="scoreInfoQueryForm" id="scoreInfoQueryForm" action="<?php echo url('ScoreInfo/frontlist'); ?>" class="mar_t15" method="post">
            <div class="form-group">
            	<label for="studentNumber_studentNumber">学生姓名：</label>
                <select id="studentNumber_studentNumber" name="studentNumber_studentNumber" class="form-control">
                	<option value="">不限制</option>
	 				<?php
	 				foreach($studentList as $student) {
	 					$selected = "";
 					if($studentNumber['studentNumber'] == $student['studentNumber'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $student['studentNumber']; ?>" <?php echo $selected; ?>><?php echo $student['studentName']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
            <div class="form-group">
            	<label for="courseNo_courseNo">课程名称：</label>
                <select id="courseNo_courseNo" name="courseNo_courseNo" class="form-control">
                	<option value="">不限制</option>
	 				<?php
	 				foreach($courseList as $course) {
	 					$selected = "";
 					if($courseNo['courseNo'] == $course['courseNo'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $course['courseNo']; ?>" <?php echo $selected; ?>><?php echo $course['courseName']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
            <div class="form-group">
            	<label for="termId_termId">所在学期：</label>
                <select id="termId_termId" name="termId_termId" class="form-control">
                	<option value="0">不限制</option>
	 				<?php
	 				foreach($termInfoList as $termInfo) {
	 					$selected = "";
 					if($termId['termId'] == $termInfo['termId'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $termInfo['termId']; ?>" <?php echo $selected; ?>><?php echo $termInfo['termName']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
            <input type=hidden name=currentPage id="currentPage" value="<%=currentPage %>" />
            <button type="submit" class="btn btn-primary" onclick="$('#currentPage').val(1);return true;">查询</button>
        </form>
	</div>

		</div>
	</div> 
<div id="scoreInfoEditDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;成绩信息信息编辑</h4>
      </div>
      <div class="modal-body" style="height:450px; overflow: scroll;">
      	<form class="form-horizontal" name="scoreInfoEditForm" id="scoreInfoEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="scoreInfo_scoreId_edit" class="col-md-3 text-right">成绩编号:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="scoreInfo_scoreId_edit" name="scoreInfo.scoreId" class="form-control" placeholder="请输入成绩编号" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="scoreInfo_studentNumber_studentNumber_edit" class="col-md-3 text-right">学生姓名:</label>
		  	 <div class="col-md-9">
			    <select id="scoreInfo_studentNumber_studentNumber_edit" name="scoreInfo_studentNumber_studentNumber" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="scoreInfo_courseNo_courseNo_edit" class="col-md-3 text-right">课程名称:</label>
		  	 <div class="col-md-9">
			    <select id="scoreInfo_courseNo_courseNo_edit" name="scoreInfo_courseNo_courseNo" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="scoreInfo_termId_termId_edit" class="col-md-3 text-right">所在学期:</label>
		  	 <div class="col-md-9">
			    <select id="scoreInfo_termId_termId_edit" name="scoreInfo_termId_termId" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="scoreInfo_score_edit" class="col-md-3 text-right">成绩得分:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="scoreInfo_score_edit" name="scoreInfo_score" class="form-control" placeholder="请输入成绩得分">
			 </div>
		  </div>
		</form> 
	    <style>#scoreInfoEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
      <div class="modal-footer"> 
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      	<button type="button" class="btn btn-primary" onclick="ajaxScoreInfoModify();">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="http://www.baidu.com" target=_blank>© 大神开发网 from 2020</a> |
                <a href="http://www.baidu.com">本站招聘</a> |
                <a href="http://www.baidu.com">联系站长</a> |
                <a href="http://www.baidu.com">意见与建议</a> |
                <a href="http://www.baidu.com" target=_blank>蜀ICP备0343346号</a> |
                <a href="__PUBLIC__/back/login">后台登录</a>
            </div>
        </div>
    </div>
</footer>
<!--footer-->





<script src="__PUBLIC__/plugins/jquery.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap.js"></script>
<script src="__PUBLIC__/plugins/wow.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap-datetimepicker.min.js"></script>
<script src="__PUBLIC__/plugins/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jsdate.js"></script>
<script>
/*跳转到查询结果的某页*/
function GoToPage(currentPage,totalPage) {
    if(currentPage==0) return;
    if(currentPage>totalPage) return;
    document.scoreInfoQueryForm.currentPage.value = currentPage;
    document.scoreInfoQueryForm.submit();
}

/*可以直接跳转到某页*/
function changepage(totalPage)
{
    var pageValue=document.scoreInfoQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.scoreInfoQueryForm.currentPage.value = pageValue;
    documentscoreInfoQueryForm.submit();
}

/*弹出修改成绩信息界面并初始化数据*/
function scoreInfoEdit(scoreId) {
	$.ajax({
		url :  "<?php echo url('ScoreInfo/update'); ?>?scoreId=" + scoreId ,
		type : "get",
		dataType: "json",
		success : function (scoreInfo, response, status) {
			if (scoreInfo) {
				$("#scoreInfo_scoreId_edit").val(scoreInfo.scoreId);
				$.ajax({
					url: "<?php echo url('ScoreInfo/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(students,response,status) { 
						$("#scoreInfo_studentNumber_studentNumber_edit").empty();
						var html="";
		        		$(students).each(function(i,student){
		        			html += "<option value='" + student.studentNumber + "'>" + student.studentName + "</option>";
		        		});
		        		$("#scoreInfo_studentNumber_studentNumber_edit").html(html);
		        		$("#scoreInfo_studentNumber_studentNumber_edit").val(scoreInfo.studentNumber);
					}
				});
				$.ajax({
					url: "<?php echo url('ScoreInfo/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(courses,response,status) { 
						$("#scoreInfo_courseNo_courseNo_edit").empty();
						var html="";
		        		$(courses).each(function(i,course){
		        			html += "<option value='" + course.courseNo + "'>" + course.courseName + "</option>";
		        		});
		        		$("#scoreInfo_courseNo_courseNo_edit").html(html);
		        		$("#scoreInfo_courseNo_courseNo_edit").val(scoreInfo.courseNo);
					}
				});
				$.ajax({
					url: "<?php echo url('ScoreInfo/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(termInfos,response,status) { 
						$("#scoreInfo_termId_termId_edit").empty();
						var html="";
		        		$(termInfos).each(function(i,termInfo){
		        			html += "<option value='" + termInfo.termId + "'>" + termInfo.termName + "</option>";
		        		});
		        		$("#scoreInfo_termId_termId_edit").html(html);
		        		$("#scoreInfo_termId_termId_edit").val(scoreInfo.termId);
					}
				});
				$("#scoreInfo_score_edit").val(scoreInfo.score);
				$('#scoreInfoEditDialog').modal('show');
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*删除成绩信息信息*/
function scoreInfoDelete(scoreId) {
	if(confirm("确认删除这个记录")) {
		$.ajax({
			type : "POST",
			url: "<?php echo url('ScoreInfo/deletes'); ?>",
			data : {
				scoreIds : scoreId,
			},
			dataType: "json",
			success : function (obj) {
				if (obj.success) {
					alert("删除成功");
					$("#scoreInfoQueryForm").submit();
					//location.href="<?php echo url('ScoreInfo/frontlist'); ?>";
				}
				else 
					alert(obj.message);
			},
		});
	}
}

/*ajax方式提交成绩信息信息表单给服务器端修改*/
function ajaxScoreInfoModify() {
	$.ajax({
		url :  "<?php echo url('ScoreInfo/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#scoreInfoEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                $("#scoreInfoQueryForm").submit();
            }else{
                alert(obj.message);
            } 
		},
		processData: false,
		contentType: false,
	});
}

$(function(){
	/*小屏幕导航点击关闭菜单*/
    $('.navbar-collapse a').click(function(){
        $('.navbar-collapse').collapse('hide');
    });
    new WOW().init();

})
</script>
</body>
</html>

