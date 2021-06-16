<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
	 	parent::__construct();
        $this->load->model('student_model');
	}
	public function index()
	{
        $data['title']='Home'.title_tag; 
        $data['menu']=1; 
        $data['students']=$this->common_model->__fetch_contents1('student',array('removed'=>0));
        if($data['students']!=false){
            foreach($data['students'] as $key=>$val){
                $data['students'][$key]['file']=$this->common_model->__fetch_contents1('student_files',array('studentId'=>$val['id'],'studentFileRemoved'=>0));
            }
        }

        $this->load->view('main_menu',$data);
 	}
    public function add_student_process()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required|max_length[150]');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|xss_clean|required|max_length[12]');
            $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'trim|xss_clean|required|max_length[10]');
            if ($this->form_validation->run()) {
                $data=$this->input->post();
                $student=array();
                $imageData=array();
                if (isset($data['fileName'])) {
                    $fileName   = $data['fileName'];
                    $clientName = $data['clientName'];
                    $fileExt    = $data['fileExtension'];
                    $fileSize   = $data['fileSize'];
                    $fType      = $data['fileType'];
                    $height     = $data['imageHeight'];
                    $width      = $data['imageWidth'];
                    $imType     = $data['imageType'];
                    $isImg      = $data['isImage'];
                    $orName     = $data['origName'];
                    $raName     = $data['rawName'];
                    $iDesc      = $data['imgDesc'];
                }
                
                if (isset($fileName) && !empty($fileName)) {
                    foreach ($fileName as $key => $item) {
                        if (copy(temp_upload_path . $item, student_file_upload . $item)) {
                            $upload                            = 1;
                            $imageData[$key]['studentFileName']      = $item;
                            $imageData[$key]['studentFileClient']    = $clientName[$key];
                            $imageData[$key]['studentFileExt']       = $fileExt[$key];
                            $imageData[$key]['studentFileSize']      = $fileSize[$key];
                            $imageData[$key]['studentFileFileType'] = $fType[$key];
                            $imageData[$key]['studentFileHeight']    = $height[$key];
                            $imageData[$key]['studentFileWidth']     = $width[$key];
                            $imageData[$key]['studentFileType']      = $imType[$key];
                            $imageData[$key]['studentFileIsImage']   = $isImg[$key];
                            $imageData[$key]['studentFileOrigName']  = $orName[$key];
                            $imageData[$key]['studentFileRawName']   = $raName[$key];
                            $imageData[$key]['studentFileDesc']        = $iDesc[$key];
                        }
                    }
                }

                $today = date("Y-m-d");
                $dateOfBirth = dateFormatter($data['dob'],'d/m/Y','d-m-Y');            
                $diff=date_diff(date_create($dateOfBirth), date_create($today));
                $your_age=$diff->format('%y');
                $student['name']=$data['name'];
                $student['dob']=$data['dob'];
                $student['mobile_no']=$data['mobile_no'];
                $student['age']=$your_age;
                if ($data['id']==0) {
                    $insert=$this->student_model->insertStudentDetail($student,$imageData);
                    if ($insert!=false) {
                        $message = 'Added Student Successfully';
                        $report  = array(
                            'status' => 1,
                            'message' => $message
                        );
                        echo json_encode($report);
                        exit;
                    }
                    else{
                        $message = 'Something went worng';
                        $report  = array(
                            'status' => 0,
                            'message' => $message
                        );
                        echo json_encode($report);
                        exit;
                    }
                }
                else{
                    $where['id']=$data['id'];
                    $where_file['studentId']=$data['id'];
                    $file['studentFileRemoved']=1;
                    if (!empty($imageData)) {
                        $this->common_model->__update_table('student_files',$file,$where_file);
                    }
                    $insert=$this->student_model->updateStudentDetail($student,$imageData,$where);
                    if ($insert!=false) {
                        $message = 'Update Student Successfully';
                        $report  = array(
                            'status' => 1,
                            'message' => $message
                        );
                        echo json_encode($report);
                        exit;
                    }
                    else{
                        $message = 'Something went worng';
                        $report  = array(
                            'status' => 0,
                            'message' => $message
                        );
                        echo json_encode($report);
                        exit;
                    }
                }
            }
            else{
                $message = $this->form_validation->error_array();
                    $report  = array(
                        'status' => 0,
                        'message' => $message
                    );
                    echo json_encode($report);
                    exit;
            }
        }
        else{
            show_error("No direct accees allowed");
        }
    }
    public function edit_student()
    {
        if ($this->input->is_ajax_request()) {
            $data=$this->input->post();
            $fetch=$this->common_model->__fetch_contents1('student',$data);
            if ($fetch!=false) {
                $data = $fetch[0];
                $report  = array(
                    'status' => 1,
                    'data' => $data
                );
                echo json_encode($report);
                exit;
            }
            else{
                $message = 'Something went worng';
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
                exit;
            }
        }
    }
    public function delete_student()
    {
        if ($this->input->is_ajax_request()) {
            $data=$this->input->post();
            $fetch=$this->common_model->__fetch_contents1('student',$data);
            if ($fetch!=false) {
                $delete_data['removed']=1;
                $update=$this->common_model->__update_table('student',$delete_data,$data);
                if ($update!=false) {
                    $message = 'Student Deleted!';
                    $report  = array(
                        'status' => 1,
                        'message' => $message
                    );
                    echo json_encode($report);
                    exit;
                }
                else{
                    $message = 'Something went worng in update';
                    $report  = array(
                        'status' => 0,
                        'message' => $message
                    );
                    echo json_encode($report);
                    exit;
                }
            }
            else{
                $message = 'Something went worng';
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
                exit;
            }
        }
    }
    public function uploadfile()
    {
        // die;
        if ($this->input->is_ajax_request()) {
            $config['upload_path']   = temp_upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ttf|mp4|mp3|mkv|mov|zip|rar|doc|docx|3gp|ogg|wmv|webm|flv|avi|pdf|txt|srt|rtf|';
            $config['max_size'] = '0';  
            /*$config['max_width']  = '1024';
            $config['max_height']  = '768';*/
            $new_name                = strtotime(date('Y-m-d H:i:s')) . '_' . md5(uniqid(rand(), true)) . '_Student';
            $new_name                = substr($new_name, 0, 300);
            $config['file_name']     = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('upl')) {
                $error = array(
                    'status' => 'error',
                    'error' => $this->upload->display_errors()
                );
                echo json_encode($error);
                exit;
            } else {
                
                $data = array(
                    'status' => 'success',
                    'upload_data' => $this->upload->data()
                );
                echo json_encode($data);
                exit;
            }
        } else {
            show_error("No direct access allowed");
            //or redirect to wherever you would like
        }
    }
    public function mark_entry()
    {
        $data['title']='Mark List'.title_tag; 
        $data['menu']=2;
        $data['students']=$this->student_model->fetch_mark_details();
        $this->load->view('mark_entry',$data);
    }
    public function add_marklist_process()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->library('form_validation');
            $data=$this->input->post();
            if(!empty($data)){
                foreach ($data['id'] as $key => $value) {
                    $this->form_validation->set_rules('id['.$key.']', 'Student Id', 'trim|xss_clean|required|max_length[150]');
                    $this->form_validation->set_rules('mark1['.$key.']', 'mark1', 'trim|xss_clean|required|max_length[150]');
                    $this->form_validation->set_rules('mark2['.$key.']', 'mark2', 'trim|xss_clean|required|max_length[150]');
                    $this->form_validation->set_rules('mark3['.$key.']', 'mark3', 'trim|xss_clean|required|max_length[150]');
                    $this->form_validation->set_rules('total['.$key.']', 'total', 'trim|xss_clean|required|max_length[150]');
                    $this->form_validation->set_rules('avg['.$key.']', 'avg', 'trim|xss_clean|required|max_length[150]');
                }
            }
            if ($this->form_validation->run()) {
                $mark_list=array();
                $mark_update=array();
                $mark_id=array();
                if (!empty($data)) {
                    foreach ($data['id'] as $key => $value) {
                        if ($data['mark_id'][$key]=='') {
                            $mark_list[$key]['studentId']=$data['id'][$key];
                            $mark_list[$key]['mark1']=$data['mark1'][$key];
                            $mark_list[$key]['mark2']=$data['mark2'][$key];
                            $mark_list[$key]['mark3']=$data['mark3'][$key];
                            $mark_list[$key]['total']=$mark_list[$key]['mark1']+$mark_list[$key]['mark2']+$mark_list[$key]['mark3'];
                            $mark_list[$key]['avg']=$mark_list[$key]['total']/3;
                        }
                        else{
                            $mark_id[$key]['id']=$data['mark_id'][$key];
                            $mark_update[$key]['studentId']=$data['id'][$key];
                            $mark_update[$key]['mark1']=$data['mark1'][$key];
                            $mark_update[$key]['mark2']=$data['mark2'][$key];
                            $mark_update[$key]['mark3']=$data['mark3'][$key];
                            $mark_update[$key]['total']=$mark_update[$key]['mark1']+$mark_update[$key]['mark2']+$mark_update[$key]['mark3'];
                            $mark_update[$key]['avg']=$mark_update[$key]['total']/3;
                        }
                    }
                }
                $insert=$this->student_model->insert_mark_details($mark_list,$mark_update,$mark_id);
                if ($insert!=false) {
                    $fetch=$this->common_model->__fetch_contents1('student_mark_list',array('removed'=>0),'','','total desc');
                    if ($fetch!=false) {
                        $temp_total=0;
                        $rank_inc=1;
                        foreach ($fetch as $fet_key => $fet_val) {
                            $rank['rank']=$rank_inc;
                            $rank_id['id']=$fet_val['id'];
                            if ($temp_total!=$fet_val['total']) {
                                $rank_inc++;
                            }
                            $temp_total=$fet_val['total'];
                            $updated=$this->common_model->__update_table('student_mark_list',$rank,$rank_id);
                            if ($updated==false) {
                                $message = 'something update wrong';
                                $report  = array(
                                    'status' => 2,
                                    'message' => $message
                                );
                                echo json_encode($report);
                                exit;
                            }
                        }
                    }
                    $message = 'Mark updated Successfully';
                    $report  = array(
                        'status' => 1,
                        'message' => $message
                    );
                    echo json_encode($report);
                    exit;
                }
                else{
                    $message = 'something wrong';
                    $report  = array(
                        'status' => 2,
                        'message' => $message
                    );
                    echo json_encode($report);
                    exit;
                }
            }
            else{
                $message = $this->form_validation->error_array();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
                exit;
            }
        }
        else{
            show_error("No direct accees allowed");
        }
    }
    public function rank_list()
    {
        $data['title']='Rank List'.title_tag; 
        $data['menu']=3;
        $data['students']=$this->student_model->fetch_mark_details_student();
        $this->load->view('rank_list',$data);
    }
}