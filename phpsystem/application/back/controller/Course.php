<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\CourseModel;

class Course extends BackBase {
    protected $courseModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->courseModel = new CourseModel();
    }

    /*添加课程信息信息*/
    public function add(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $course = $this->getCourseForm(true);
            try {
                $this->courseModel->addCourse($course);
                $message = "课程信息添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "课程信息添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return view('course/course_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("courseNo",input("courseNo"));
        return view("course/course_modify");
    }

    /*ajax方式按照查询条件分页查询课程信息信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->courseModel->setRows($this->request->param("rows"));
            $courseNo = input("courseNo")==null?"":input("courseNo");
            $courseName = input("courseName")==null?"":input("courseName");
            $teacherName = input("teacherName")==null?"":input("teacherName");
            $coursePlace = input("coursePlace")==null?"":input("coursePlace");
            $courseRs = $this->courseModel->queryCourse($courseNo, $courseName, $teacherName, $coursePlace, $this->currentPage);
            $expTableData = [];
            foreach($courseRs as $courseRow) {
                $expTableData[] = $courseRow;
            }
            $data["rows"] = $courseRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->courseModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("course/course_query");
        }
    }

    /*ajax方式查询课程信息信息*/
    public function listAll() {
        $courseRs = $this->courseModel->queryAllCourse();
        echo json_encode($courseRs);
    }
    /*更新课程信息信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $course = $this->getCourseForm(false);
            try {
                $this->courseModel->updateCourse($course);
                $message = "课程信息更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "课程信息更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取课程信息对象*/
            $courseNo = input("courseNo");
            $course = $this->courseModel->getCourse($courseNo);
            echo json_encode($course);
        }
    }

    /*删除多条课程信息记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $courseNos = input("courseNos");
        try {
            $count = $this->courseModel->deleteCourses($courseNos);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

    /*按照查询条件导出课程信息信息到Excel*/
    public function outToExcel() {
        $courseNo = input("courseNo")==null?"":input("courseNo");
        $courseName = input("courseName")==null?"":input("courseName");
        $teacherName = input("teacherName")==null?"":input("teacherName");
        $coursePlace = input("coursePlace")==null?"":input("coursePlace");
        $courseRs = $this->courseModel->queryOutputCourse($courseNo,$courseName,$teacherName,$coursePlace);
        $expTableData = [];
        foreach($courseRs as $courseRow) {
            $expTableData[] = $courseRow;
        }
        $xlsName = "Course";
        $xlsCell = array(
            array('courseNo','课程编号','string'),
            array('courseName','课程名称','string'),
            array('teacherName','任课教师','string'),
            array('coursePlace','上课地点','string'),
            array('courseCount','总课时','int'),
            array('courseScore','总学分','float'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

