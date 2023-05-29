$(function () {
	$("#attendance_studentObj_studentNumber").combobox({
	    url: backURL + getVisitPath("Student") + '/listAll',
	    valueField: "studentNumber",
	    textField: "studentName",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#attendance_studentObj_studentNumber").combobox("getData"); 
            if (data.length > 0) {
                $("#attendance_studentObj_studentNumber").combobox("select", data[0].studentNumber);
            }
        }
	});
	$("#attendance_courseObj_courseNo").combobox({
	    url: backURL + getVisitPath("Course") + '/listAll',
	    valueField: "courseNo",
	    textField: "courseName",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#attendance_courseObj_courseNo").combobox("getData"); 
            if (data.length > 0) {
                $("#attendance_courseObj_courseNo").combobox("select", data[0].courseNo);
            }
        }
	});
	$("#attendance_timeInfoObj_timeInfoId").combobox({
	    url: backURL + getVisitPath("TimeInfo") + '/listAll',
	    valueField: "timeInfoId",
	    textField: "timeInfoName",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#attendance_timeInfoObj_timeInfoId").combobox("getData"); 
            if (data.length > 0) {
                $("#attendance_timeInfoObj_timeInfoId").combobox("select", data[0].timeInfoId);
            }
        }
	});
	$("#attendance_attendanceStateObj_stateId").combobox({
	    url: backURL + getVisitPath("AttendanceState") + '/listAll',
	    valueField: "stateId",
	    textField: "stateName",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#attendance_attendanceStateObj_stateId").combobox("getData"); 
            if (data.length > 0) {
                $("#attendance_attendanceStateObj_stateId").combobox("select", data[0].stateId);
            }
        }
	});
	//单击添加按钮
	$("#attendanceAddButton").click(function () {
		//验证表单 
		if(!$("#attendanceAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#attendanceAddForm").form({
			    url: backURL + getVisitPath("Attendance") + "/add",
			    onSubmit: function(){
					if($("#attendanceAddForm").form("validate"))  { 
	                	$.messager.progress({
							text : "正在提交数据中...",
						}); 
	                	return true;
	                } else {
	                    return false;
	                }
			    },
			    success:function(data){
			    	$.messager.progress("close");
                    //此处data={"Success":true}是字符串
                	var obj = jQuery.parseJSON(data); 
                    if(obj.success){ 
                        $.messager.alert("消息","保存成功！");
                        $(".messager-window").css("z-index",10000);
                        $("#attendanceAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#attendanceAddForm").submit();
		}
	});

	//单击清空按钮
	$("#attendanceClearButton").click(function () { 
		$("#attendanceAddForm").form("clear"); 
	});
});
