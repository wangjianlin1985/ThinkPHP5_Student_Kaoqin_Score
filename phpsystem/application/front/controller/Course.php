<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\CourseModel;

class Course extends Base {
    protected $courseModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->courseModel = new CourseModel();
    }

    /*添加课程信息信息*/
    public function frontAdd(){
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
            return $this->fetch('course/course_frontAdd');
        }
    }

    /*前台修改课程信息信息*/
    public function frontModify() {
        $this->assign("courseNo",input("courseNo"));
        return $this->fetch("course/course_frontModify");
    }

    /*前台按照查询条件分页查询课程信息信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $courseNo = input("courseNo")==null?"":input("courseNo");
        $courseName = input("courseName")==null?"":input("courseName");
        $teacherName = input("teacherName")==null?"":input("teacherName");
        $coursePlace = input("coursePlace")==null?"":input("coursePlace");
        $courseRs = $this->courseModel->queryCourse($courseNo, $courseName, $teacherName, $coursePlace, $this->currentPage);
        $this->assign("courseRs",$courseRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->courseModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->courseModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->courseModel->rows);
        $this->assign("courseNo",$courseNo);
        $this->assign("courseName",$courseName);
        $this->assign("teacherName",$teacherName);
        $this->assign("coursePlace",$coursePlace);
        return $this->fetch('course/course_frontlist');
    }

    /*ajax方式查询课程信息信息*/
    public function listAll() {
        $courseRs = $this->courseModel->queryAllCourse();
        echo json_encode($courseRs);
    }
    /*前台查询根据主键查询一条课程信息信息*/
    public function frontshow() {
        $courseNo = input("courseNo");
        $course = $this->courseModel->getCourse($courseNo);
       $this->assign("course",$course);
        return $this->fetch("course/course_frontshow");
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

}

