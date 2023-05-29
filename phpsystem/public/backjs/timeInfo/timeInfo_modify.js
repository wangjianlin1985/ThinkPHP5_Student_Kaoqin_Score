$(function () {
	$.ajax({
		url :  backURL + getVisitPath("TimeInfo") + "/update",
		type : "get",
		data : {
			timeInfoId : $("#timeInfo_timeInfoId_edit").val(),
		},
		dataType: "json",
		beforeSend : function () {
			$.messager.progress({
				text : "正在获取中...",
			});
		},
		success : function (timeInfo, response, status) {
			$.messager.progress("close");
			if (timeInfo) { 
				$("#timeInfo_timeInfoId_edit").val(timeInfo.timeInfoId);
				$("#timeInfo_timeInfoId_edit").validatebox({
					required : true,
					missingMessage : "请输入记录编号",
					editable: false
				});
				$("#timeInfo_timeInfoName_edit").val(timeInfo.timeInfoName);
				$("#timeInfo_timeInfoName_edit").validatebox({
					required : true,
					missingMessage : "请输入学时名称",
				});
			} else {
				$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#timeInfoModifyButton").click(function(){ 
		if ($("#timeInfoEditForm").form("validate")) {
			$("#timeInfoEditForm").form({
			    url: backURL + getVisitPath("TimeInfo") + "/update",
			    onSubmit: function(){
					if($("#timeInfoEditForm").form("validate"))  {
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
                	var obj = jQuery.parseJSON(data);
                    if(obj.success){
                        $.messager.alert("消息","信息修改成功！");
                        $(".messager-window").css("z-index",10000);
                        //location.href="frontlist";
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    } 
			    }
			});
			//提交表单
			$("#timeInfoEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
