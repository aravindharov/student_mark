<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
Class Student_model extends CI_Model
{
    public function insertStudentDetail($student, $image_data=array())
    {
        $this->db->trans_begin();
        $q = $this->db->select('max(studentNo) as last')->from('student')->get();
        $res = $q->result_array();
        $firstNo = 1;
        if(!empty($res[0]['last']))
        {
            $firstNo = $res[0]['last']+1;
        }
        $student['studentNo']=$firstNo;
        $no=cleanData($firstNo,4,0,'prefix');
        $student['regno']='stu'.$no;
        $this->db->insert('student', $student);
        $lastid = $this->db->insert_id();
        
        if (!empty($image_data)) {
            foreach ($image_data as $key => $item) {
                $image_data[$key]['studentId'] = $lastid;
                $this->db->insert('student_files', $image_data[$key]);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function updateStudentDetail($student, $image_data=array(),$id)
    {
        $this->db->trans_begin();
        $this->db->where($id);
        $this->db->update('student', $student);
        
        if (!empty($image_data)) {
            $stu_id=$id['id'];
            foreach ($image_data as $key => $item) {
                $image_data[$key]['studentId'] = $stu_id;
                $this->db->insert('student_files', $image_data[$key]);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function fetch_student()
    {
        $this->db->select('*');
        $this->db->from('student as a');
        $this->db->join('student_files as b','a.id=b.studentId','left');
        $this->db->where('a.removed', 0);
        
        $query = $this->db->get();
        
        $data = $query->result_array();
        if ($query->num_rows()) {
            return $data;
        } else {
            return false;
        }
    }
    public function fetch_mark_details()
    {
        $this->db->select('a.*,b.mark1,b.mark2,b.mark3,b.total,b.avg,b.id as mark_id');
        $this->db->from('student as a');
        $this->db->join('student_mark_list as b','a.id=b.studentId','left');
        $this->db->where('a.removed', 0);
        
        $query = $this->db->get();
        
        $data = $query->result_array();
        if ($query->num_rows()) {
            return $data;
        } else {
            return false;
        }
    }
    public function fetch_mark_details_student()
    {
        $this->db->select('a.*,b.mark1,b.mark2,b.mark3,b.total,b.avg,b.id as mark_id,b.rank');
        $this->db->from('student as a');
        $this->db->join('student_mark_list as b','a.id=b.studentId');
        $this->db->where('a.removed', 0);
        $this->db->order_by('b.rank');
        
        $query = $this->db->get();
        
        $data = $query->result_array();
        if ($query->num_rows()) {
            return $data;
        } else {
            return false;
        }
    }
    public function insert_mark_details($mark_list_insert=array(), $mark_update=array(),$mark_id=array())
    {
        $this->db->trans_begin();
        if (!empty($mark_list_insert)) {
            $this->db->insert_batch('student_mark_list', $mark_list_insert);
        }
        
        if (!empty($mark_id)) {
            foreach ($mark_id as $key => $item) {
                $this->db->where($item);
                $this->db->update('student_mark_list', $mark_update[$key]);
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }   
}
