<?php

class Emailformat extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');


        $this->data['adminID'] = $this->session->userdata('thegiftsforyou_admin');
        $this->data['title'] = 'Emailformat : ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }
	// frontend email formants list page
    public function index() {
         $selected = "email_format.*";
         $email_join=array();
        
         $con_arr = array('mailtype' => 'Frontend');
        
        $this->data['emailformats'] =  $this->common->select_data_by_condition('email_format', $con_arr, $selected, 'id', '', '', '', $email_join);

        $this->load->view('emailformats/index', $this->data);
    }
	// backend email formant list page
     public function backend() {
        $selected = "email_format.*";
         $email_join=array();
        
         $con_arr = array('mailtype' => 'Backend');
        
        $this->data['emailformats'] =  $this->common->select_data_by_condition('email_format', $con_arr, $selected, 'id', '', '', '', $email_join);

        $this->load->view('emailformats/backendindex', $this->data);
    }

    //call edit view
    public function edit() {
	
        $temp_id = base64_decode($this->uri->segment(3));
        $this->data['email_template'] = $this->common->select_data_by_id('email_format', 'id', $temp_id, $data = '*', $join_str = array());
        /*$this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'description',
            'path' => '../ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "auto", //a custom width
                'height' => "300px" //a custom height
            )
        );
*/
        $this->load->view('emailformats/edit', $this->data);
    }

    //update emailformat record
    public function update($id) {

        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect($this->data['redirect_url'], 'refresh');
        } else {
            $temp_id = base64_decode($id);
            $subject = $this->input->post('subject');
            $format = $this->input->post('description');

            $update_array = array(
                'subject' => $subject,
                'emailformat' => $format,
            );

            $result_update = $this->common->update_data($update_array, 'email_format', 'id', $temp_id);
            if ($result_update == true) {
                $this->session->set_flashdata('success', 'E-mail format updated successfully');
                redirect('emailformat', 'refresh');
		 //$this->redirect_back();
		
            }
        }
    }

}
