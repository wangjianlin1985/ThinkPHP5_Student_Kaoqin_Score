<?php
namespace app\front\controller;
use think\Controller;

class Base extends Controller
{
    protected $currentPage = 1;
    protected $request = null;

    //向客户端输出ajax响应结果
    public function writeJsonResponse($success, $message) {
        $response = array(
            "success" => $success,
            "message" => $message,
        );
        echo json_encode($response);
    }

    /**
     * @param $obj:  保存图片路径的对象
     * @param $indexName 索引名称
     * @param $photoFiledName 提交的图片表单名称
     */
    public function uploadPhoto(&$obj,$indexName,$photoFiledName) {
        if($_FILES[$photoFiledName]['tmp_name']){
            $file = $this->request->file($photoFiledName);
            //控制上传的文件类型，大小
            if(!(($_FILES[$photoFiledName]["type"]=="image/jpeg"
                    || $_FILES[$photoFiledName]["type"]=="image/jpg"
                    || $_FILES[$photoFiledName]["type"]=="image/png") && $_FILES[$photoFiledName]["size"] < 1024000)) {
                $message = "图书图片请选择jpg或png格式的图片!";
                $this->writeJsonResponse(false,$message);
                exit;
            }
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    /**
     * @param $obj:  保存文件路径的对象
     * @param $indexName 索引名称
     * @param $resourceFiledName 提交的文件表单名称
     */
    public function uploadFile(&$obj,$indexName,$resourceFiledName) {
        if($_FILES[$resourceFiledName]['tmp_name']){
            $file = $this->request->file($resourceFiledName);
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    //接收提交的TermInfo信息参数
    public function getTermInfoForm($insertFlag) {
        $termInfo = [
            'termId'=> input("termInfo_termId"), //学期编号
            'termName'=> input("termInfo_termName"), //学期名称
        ];
        return $termInfo;
    }

    //接收提交的ClassInfo信息参数
    public function getClassInfoForm($insertFlag) {
        $classInfo = [
            'classNo'=> input("classInfo_classNo"), //班级编号
            'className'=> input("classInfo_className"), //班级名称
            'banzhuren'=> input("classInfo_banzhuren"), //班主任姓名
            'beginDate'=> input("classInfo_beginDate"), //成立日期
        ];
        return $classInfo;
    }

    //接收提交的Student信息参数
    public function getStudentForm($insertFlag) {
        $student = [
            'studentNumber'=> input("student_studentNumber"), //学号
            'studentName'=> input("student_studentName"), //姓名
            'sex'=> input("student_sex"), //性别
            'classInfoId'=> input("student_classInfoId_classNo"), //所在班级
            'birthday'=> input("student_birthday"), //出生日期
            'zzmm'=> input("student_zzmm"), //政治面貌
            'telephone'=> input("student_telephone"), //联系电话
            'address'=> input("student_address"), //家庭地址
            'photoUrl' => $insertFlag==true?"upload/NoImage.jpg":input("student_photoUrl"), //学生照片
        ];
        return $student;
    }

    //接收提交的Course信息参数
    public function getCourseForm($insertFlag) {
        $course = [
            'courseNo'=> input("course_courseNo"), //课程编号
            'courseName'=> input("course_courseName"), //课程名称
            'teacherName'=> input("course_teacherName"), //任课教师
            'coursePlace'=> input("course_coursePlace"), //上课地点
            'courseCount'=> input("course_courseCount"), //总课时
            'courseScore'=> input("course_courseScore"), //总学分
        ];
        return $course;
    }

    //接收提交的ScoreInfo信息参数
    public function getScoreInfoForm($insertFlag) {
        $scoreInfo = [
            'scoreId'=> input("scoreInfo_scoreId"), //成绩编号
            'studentNumber'=> input("scoreInfo_studentNumber_studentNumber"), //学生姓名
            'courseNo'=> input("scoreInfo_courseNo_courseNo"), //课程名称
            'termId'=> input("scoreInfo_termId_termId"), //所在学期
            'score'=> input("scoreInfo_score"), //成绩得分
        ];
        return $scoreInfo;
    }

    //接收提交的Attendance信息参数
    public function getAttendanceForm($insertFlag) {
        $attendance = [
            'attendanceId'=> input("attendance_attendanceId"), //记录编号
            'studentObj'=> input("attendance_studentObj_studentNumber"), //学生
            'courseObj'=> input("attendance_courseObj_courseNo"), //课程
            'timeInfoObj'=> input("attendance_timeInfoObj_timeInfoId"), //时间
            'attendanceStateObj'=> input("attendance_attendanceStateObj_stateId"), //状态
        ];
        return $attendance;
    }

    //接收提交的TimeInfo信息参数
    public function getTimeInfoForm($insertFlag) {
        $timeInfo = [
            'timeInfoId'=> input("timeInfo_timeInfoId"), //记录编号
            'timeInfoName'=> input("timeInfo_timeInfoName"), //学时名称
        ];
        return $timeInfo;
    }

    //接收提交的AttendanceState信息参数
    public function getAttendanceStateForm($insertFlag) {
        $attendanceState = [
            'stateId'=> input("attendanceState_stateId"), //状态编号
            'stateName'=> input("attendanceState_stateName"), //状态名称
        ];
        return $attendanceState;
    }

}

