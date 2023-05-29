<?php
namespace app\back\controller;
use think\Controller;

class BackBase extends Controller
{
    protected $currentPage = 1;
    protected $request = null;

    public function _initialize(){
        if(!session('username')){
            $this->error('请先登录系统！','Login/index');
        }
    }

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

    /** * 公共数据导出实现功能
     * @param $expTitle 导出文件名
     * @param $expCellName 导出文件列名称
     * @param $expTableData 导出数据
     */
    public function export_excel($expTitle,$expCellName,$expTableData) {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle . date('_Ymd');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        //这些文件需要下载phpexcel，然后放在vendor文件里面。具体参考上一篇数据导出。
        vendor("PHPExcel.PHPExcel");
        //vendor("PHPExcel.PHPExcel.Writer.IWriter");
        //vendor("PHPExcel.PHPExcel.Writer.Abstract");
        //vendor("PHPExcel.PHPExcel.Writer.Excel5");
        //vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        $objPHPExcel = new \PHPExcel();//方法一
        $cellName = array('A','B', 'C','D', 'E', 'F','G','H','I', 'J', 'K','L','M', 'N', 'O', 'P', 'Q','R','S', 'T','U','V', 'W', 'X','Y', 'Z', 'AA',    'AB', 'AC','AD','AE', 'AF','AG','AH','AI', 'AJ', 'AK', 'AL','AM','AN','AO','AP','AQ','AR', 'AS', 'AT','AU', 'AV','AW', 'AX', 'AY', 'AZ');
        //设置头部导出时间备注
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//合并单元格
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . ' 导出时间:' . date('Y-m-d H:i:s'));
        //设置列名称
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
            $objPHPExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(20); //设置每列宽度
            $objPHPExcel->getActiveSheet()->getStyle($cellName[$i].'2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($cellName[$i])->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER); //垂直居中对齐
        }
        //赋值
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet()->getStyle($cellName[$j].($i + 3))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                if($expCellName[$j][2] == 'photo') {
                    try {
                        // 表格高度
                        $objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(80);
                        // 图片生成
                        $objDrawing = new \PHPExcel_Worksheet_Drawing();
                        $objDrawing->setPath(PUBLIC_PATH.$expTableData[$i][$expCellName[$j][0]]);
                        // 设置宽度高度
                        $objDrawing->setHeight(80);//照片高度
                        $objDrawing->setWidth(80); //照片宽度
                        /*设置图片要插入的单元格*/
                        $objDrawing->setCoordinates($cellName[$j].($i + 3));
                        // 图片偏移距离
                        $objDrawing->setOffsetX(5);
                        $objDrawing->setOffsetY(5);
                        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                    } catch (\Exception $ex) {}
                } else {
                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i + 3), $expTableData[$i][$expCellName[$j][0]]);
                }
            }
        }
        ob_end_clean();//这一步非常关键，用来清除缓冲区防止导出的excel乱码
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//"xls"参考下一条备注
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'  );//"Excel2007"生成2007版本的xlsx，"Excel5"生成2003版本的xls
        $objWriter->save('php://output');
    }
}

