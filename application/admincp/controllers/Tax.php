<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tax extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Tax : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['tax'] = $this->common->get_all_record('tax', '*', 'id', 'ASC');
        $this->load->view('tax/index', $this->data);
    }
       //add tax
       public function add(){
           if ($this->input->method() == 'post') {
		 $check_name = $this->common->select_data_by_id('tax', 'title',$this->input->post('title'), '', array());
		//print_R($check_name); exit();
                    if(!empty($check_name))
			{
				$this->session->set_flashdata('error', 'Tax already exists, please Enter other Tax');
                               redirect('Tax', 'refresh');
			}
            $tax_arr = array(
                'title' => $this->security->xss_clean($this->input->post('title')),
                'percentage' => $this->security->xss_clean($this->input->post('percentage')),
                'created_date' => date('Y-m-d H:i:s'),
                'status'=> 'Disable',
            );
           
           
            $this->common->insert_data($tax_arr, 'tax');
            $this->session->set_flashdata('success', 'Your tax  is successfully submitted.');
            redirect('Tax/index', 'refresh');
        }
       }
    //call edit sem view
    function update($id) {
        $id = base64_decode($id); //echo $sem_id;die();
        if ($this->input->is_ajax_request()) {
            if ($id != '' && $id != 0) {
                $this->data['tax'] = $this->common->selectRecordById('tax', $id, 'id');
                $this->load->view('tax/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
    }

    //update sem setting record
    public function updatesem() {

        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('field_value', 'field_value', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
                $id = base64_decode($this->input->post('id'));
                if ($id != '' && $id != 0) {
                    $fieldvalue = ($this->input->post('field_value', TRUE));
                    $taxdata = array('percentage' => $fieldvalue);
                    $taxInfo = $this->common->selectRecordById('tax', $id, 'id');
                    $taxName = $taxInfo['title'];
                    if ($this->common->update_data($taxdata, "tax", "id", $id)) {
                        $this->session->set_flashdata('success', $taxName . ' updated successfully.');
                        redirect('Tax', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is error in updating ' . $taxName . '. Try later!');
                        redirect('Tax', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('Tax       ', 'refresh');
                }
                return;
            }
        }
    }

    public function enable($semid) {
        $semid = base64_decode($semid);
        if ($semid != '' && $semid != 0) {
            $redirect = '';
            $userdata = array(
                'status' => "Enable",
            );
            $sem = $this->common->select_data_by_id('sem', 'sem_id', $semid);
            if ($this->common->update_data($userdata, "sem", "sem_id", $semid)) {
                $this->session->set_flashdata('success', $sem[0]['field_name'] . ' is enabled.');
                redirect('sem', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error while enabling ' . $sem[0]['field_name'] . ', Try later.');
                redirect('sem', 'refresh');
            }
        }
    }

    public function disable($semid) {
        $semid = base64_decode($semid);
        if ($semid != '' && $semid != 0) {
            $redirect = '';
            $userdata = array(
                'status' => "Disable",
            );
            $sem = $this->common->select_data_by_id('sem', 'sem_id', $semid);
            if ($this->common->update_data($userdata, "sem", "sem_id", $semid)) {
                $this->session->set_flashdata('success', $sem[0]['field_name'] . ' is disabled.');
                redirect('sem', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error while disabling ' . $sem[0]['field_name'] . ', Try later.');
                redirect('sem', 'refresh');
            }
        }
    }

    public function change_status($id = '') {
        $id = base64_decode($id);
        if ($this->input->is_ajax_request()) {
            if ($id != '' && $id != 0) {
                $this->data['tax'] = $this->common->selectRecordById('tax', $id, 'id');
                $this->load->view('tax/confirm', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if ($this->input->method() == 'post') {
            $id = base64_decode($this->input->post('id'));
            $taxdata = $this->common->selectRecordById('tax', $id, 'id');
            $status = array();
            if ($taxdata['status'] == 'Enable') {
                $status['status'] = "Disable";
            } else {
                $status['status'] = "Enable";
            }
            if ($this->common->update_data($status, "tax", "id", $id)) {
                $this->session->set_flashdata('success',  ' status is changed successfully.');
                redirect('Tax', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error while enabling  Try later.');
                redirect('Tax', 'refresh');
            }
        }
    }

}

/* End of file Sem.php */
/* Location: ./application/controllers/Sem.php */
