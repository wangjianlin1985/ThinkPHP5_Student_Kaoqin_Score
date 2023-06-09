<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\ClassInfoModel;
use app\common\model\StudentModel;

class Student extends BackBase {
    protected $classInfoModel;
    protected $studentModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->classInfoModel = new ClassInfoModel();
        $this->studentModel = new StudentModel();
    }

    /*添加学生信息信息*/
    public function add(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $student = $this->getStudentForm(true);
            $this->uploadPhoto($student,"photoUrl","photoUrlFile"); //处理学生照片上传
            try {
                $this->studentModel->addStudent($student);
                $message = "学生信息添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学生信息添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return view('student/student_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("studentNumber",input("studentNumber"));
        return view("student/student_modify");
    }

    /*ajax方式按照查询条件分页查询学生信息信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->studentModel->setRows($this->request->param("rows"));
            $studentNumber = input("studentNumber")==null?"":input("studentNumber");
            $studentName = input("studentName")==null?"":input("studentName");
            $classInfoId["classNo"] = input("classInfoId_classNo")==null?"":input("classInfoId_classNo");
            $birthday = input("birthday")==null?"":input("birthday");
            $telephone = input("telephone")==null?"":input("telephone");
            $studentRs = $this->studentModel->queryStudent($studentNumber, $studentName, $classInfoId, $birthday, $telephone, $this->currentPage);
            $expTableData = [];
            foreach($studentRs as $studentRow) {
                $studentRow["classInfoId"] = $this->classInfoModel->getClassInfo($studentRow["classInfoId"])["className"];
                $expTableData[] = $studentRow;
            }
            $data["rows"] = $studentRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->studentModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("student/student_query");
        }
    }

    /*ajax方式查询学生信息信息*/
    public function listAll() {
        $studentRs = $this->studentModel->queryAllStudent();
        echo json_encode($studentRs);
    }
    /*更新学生信息信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $student = $this->getStudentForm(false);
            $this->uploadPhoto($student,"photoUrl","photoUrlFile"); //处理学生照片上传
            try {
                $this->studentModel->updateStudent($student);
                $message = "学生信息更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学生信息更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取学生信息对象*/
            $studentNumber = input("studentNumber");
            $student = $this->studentModel->getStudent($studentNumber);
            echo json_encode($student);
        }
    }

    /*删除多条学生信息记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $studentNumbers = input("studentNumbers");
        try {
            $count = $this->studentModel->deleteStudents($studentNumbers);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

    /*按照查询条件导出学生信息信息到Excel*/
    public function outToExcel() {
        $studentNumber = input("studentNumber")==null?"":input("studentNumber");
        $studentName = input("studentName")==null?"":input("studentName");
        $classInfoId["classNo"] = input("classInfoId_classNo")==null?"":input("classInfoId_classNo");
        $birthday = input("birthday")==null?"":input("birthday");
        $telephone = input("telephone")==null?"":input("telephone");
        $studentRs = $this->studentModel->queryOutputStudent($studentNumber,$studentName,$classInfoId,$birthday,$telephone);
        $expTableData = [];
        foreach($studentRs as $studentRow) {
            $studentRow["classInfoId"] = $this->classInfoModel->getClassInfo($studentRow["classInfoId"])["className"];
            $expTableData[] = $studentRow;
        }
        $xlsName = "Student";
        $xlsCell = array(
            array('studentNumber','学号','string'),
            array('studentName','姓名','string'),
            array('sex','性别','string'),
            array('classInfoId','所在班级','string'),
            array('birthday','出生日期','string'),
            array('zzmm','政治面貌','string'),
            array('telephone','联系电话','string'),
            array('photoUrl','学生照片','photo'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

