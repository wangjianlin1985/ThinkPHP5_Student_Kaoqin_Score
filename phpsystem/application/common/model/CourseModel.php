<?php
namespace app\common\model;
use think\Model;

class CourseModel extends Model {
    /*关联表名*/
    protected $table  = 't_course';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加课程信息记录*/
    public function addCourse($course) {
        $this->insert($course);
    }

    /*更新课程信息记录*/
    public function updateCourse($course) {
        $this->update($course);
    }

    /*删除多条课程信息信息*/
    public function deleteCourses($courseNos){
        $courseNoArray = explode(",",$courseNos);
        foreach ($courseNoArray as $courseNo) {
            $this->courseNo = $courseNo;
            $this->delete();
        }
        return count($courseNoArray);
    }
    /*根据主键获取课程信息记录*/
    public function getCourse($courseNo) {
        $course = CourseModel::where("courseNo",$courseNo)->find();
        return $course;
    }

    /*按照查询条件分页查询课程信息信息*/
    public function queryCourse($courseNo, $courseName, $teacherName, $coursePlace, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($courseNo != "") $where['courseNo'] = array('like','%'.$courseNo.'%');
        if($courseName != "") $where['courseName'] = array('like','%'.$courseName.'%');
        if($teacherName != "") $where['teacherName'] = array('like','%'.$teacherName.'%');
        if($coursePlace != "") $where['coursePlace'] = array('like','%'.$coursePlace.'%');
        $courseRs = CourseModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = CourseModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $courseRs;
    }

    /*按照查询条件查询所有课程信息记录*/
  public function queryOutputCourse( $courseNo,  $courseName,  $teacherName,  $coursePlace) {
        $where = null;
        if($courseNo != "") $where['courseNo'] = array('like','%'.$courseNo.'%');
        if($courseName != "") $where['courseName'] = array('like','%'.$courseName.'%');
        if($teacherName != "") $where['teacherName'] = array('like','%'.$teacherName.'%');
        if($coursePlace != "") $where['coursePlace'] = array('like','%'.$coursePlace.'%');
        $courseRs = CourseModel::where($where)->select();
        return $courseRs;
    }

    /*查询所有课程信息记录*/
    public function queryAllCourse(){
        $courseRs = CourseModel::where(null)->select();
        return $courseRs;

    }

}
