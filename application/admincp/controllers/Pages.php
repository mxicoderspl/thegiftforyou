<?php

class Pages extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');


        $this->data['adminID'] = $this->session->userdata('csgo_admin');
        $this->data['title'] = 'Pages : ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {
        $this->data['page_data'] = $this->common->select_data_by_condition('pages',array(), '*', '', '', '', '', array()); //$this->common->get_all_record('settings', '*', 'setting_id', 'ASC');
         $this->load->view('pages/index', $this->data);
    }

    //call edit view
    public function edit() {
        $pageid = base64_decode($this->uri->segment(3));


        $this->data['page_data'] = $page_data = $this->common->select_data_by_id('pages', 'page_id', $pageid, $data = '*', $join_str = array());
        //$this->load->helper('ckeditor');
        if (empty($page_data)) {
            $this->session->set_flashdata('error', 'Admin successfully added.');
            redirect('Dashboard', 'refresh');
        }

        $this->load->view('pages/edit', $this->data);
    }

    //update page record
    public function update($pageid) {
        $pageid = base64_decode($pageid);
        $page_data = $this->common->select_data_by_id('pages', 'page_id', $pageid, $data = '*', array());
        if (!empty($page_data)) {
            $this->form_validation->set_rules('page_title', 'page_title', 'required');
            if ($page_data[0]['page'] == 1) {
                $this->form_validation->set_rules('metakey', 'meta_keywords', 'required');
                $this->form_validation->set_rules('metadesc', 'meta_description', 'required');
            }
            $this->form_validation->set_rules('description', 'description', 'required');

            if ($this->form_validation->run() == FALSE) { //echo "false";exit;
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect('pages', 'refresh');
            } else { //echo "true";exit;
                $page_title = $this->input->post('page_title');
                $metakey = $this->input->post('metakey');
                $metadesc = $this->input->post('metadesc');
                $description = $this->input->post('description');

                $update_array = array(
                    'pagetitle' => $page_title,
                    'description' => $description,
                    'modified_at' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address()
                );
                if ($page_data[0]['page'] == 1) {
                    $update_array['meta_keywords'] = $metakey;
                    $update_array['meta_description'] = $metadesc;
                }

                $result_update = $this->common->update_data($update_array, 'pages', 'page_id', $pageid);
                if ($result_update == true) {
                    $success_msg = $update_array['pagetitle'] . " CMS updated sucessfully";
                    $this->session->set_flashdata('success', $success_msg);
                    redirect('pages', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry! No information found!');
            redirect('pages', 'refresh');
        }
    }

    //view page
    public function view() {
        $pageid = base64_decode($this->uri->segment(3));
        $this->data['page_data'] = $this->common->select_data_by_id('pages', 'pageid', $pageid, $data = '*', $join_str = array());
        $this->load->view('pages/view', $this->data);
    }

}
