<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sem extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Settings : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['settings'] = $this->common->get_all_record('sem', '*', 'sem_id', 'ASC');
        $this->load->view('sem/index', $this->data);
    }

    //call edit sem view
    function update($sem_id) {
        $sem_id = base64_decode($sem_id); //echo $sem_id;die();
        if ($this->input->is_ajax_request()) {
            if ($sem_id != '' && $sem_id != 0) {
                $this->data['sem'] = $this->common->selectRecordById('sem', $sem_id, 'sem_id');
                $this->load->view('sem/edit', $this->data);
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
                $sem_id = base64_decode($this->input->post('sem_id'));
                if ($sem_id != '' && $sem_id != 0) {
                    $fieldvalue = ($this->input->post('field_value', TRUE));
                    $semdata = array('field_value' => $fieldvalue);
                    $semInfo = $this->common->selectRecordById('sem', $sem_id, 'sem_id');
                    $semName = $semInfo['field_name'];
                    if ($this->common->update_data($semdata, "sem", "sem_id", $sem_id)) {
                        $this->session->set_flashdata('success', $semName . ' updated successfully.');
                        redirect('sem', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is error in updating ' . $semName . '. Try later!');
                        redirect('sem', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('sem', 'refresh');
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

    public function change_status($sem_id = '') {
        $sem_id = base64_decode($sem_id);
        if ($this->input->is_ajax_request()) {
            if ($sem_id != '' && $sem_id != 0) {
                $this->data['sem'] = $this->common->selectRecordById('sem', $sem_id, 'sem_id');
                $this->load->view('sem/confirm', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if ($this->input->method() == 'post') {
            $sem_id = base64_decode($this->input->post('sem_id'));
            $semdata = $this->common->selectRecordById('sem', $sem_id, 'sem_id');
            $status = array();
            if ($semdata['status'] == 'Enable') {
                $status['status'] = "Disable";
            } else {
                $status['status'] = "Enable";
            }
            if ($this->common->update_data($status, "sem", "sem_id", $sem_id)) {
                $this->session->set_flashdata('success', $semdata['field_name'] . ' status is changed successfully.');
                redirect('sem', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error while enabling ' . $semdata['field_name'] . ', Try later.');
                redirect('sem', 'refresh');
            }
        }
    }

}

/* End of file Sem.php */
/* Location: ./application/controllers/Sem.php */
