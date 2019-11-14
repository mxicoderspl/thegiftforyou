<?php

class Testimonial extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Testimonials: ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {

        $this->data['testimonials'] = $this->common->select_data_by_condition('testimonial', array(), '*', '', '', '', '', array());
        $this->load->view('testimonial/index', $this->data);
    }

    public function addnew() {
        $this->load->view('testimonial/add', $this->data);
    }

    public function add() {
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('cname', 'cname', 'required');
            $this->form_validation->set_rules('location', 'location', 'required');
            $this->form_validation->set_rules('testimonial', 'testimonial', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('Testimonial', 'refresh');
            } else {

                $name = $this->input->post('cname');
                $testimonial = $this->input->post('testimonial');

                $location = $this->input->post('location');

                $show = $this->input->post('home');

                if ($show == "off" && $show == "null") {
                    $show = 0;
                } else {
                    $show = 1;
                }
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_testimonial');
                    $config['allowed_types'] = $this->config->item('upload_testimonial_allowed_types');
                    $config['file_name'] = rand(10, 99) . time();
                    $this->load->library('upload');
                    $this->load->library('image_lib');
// Initialize the new config
                    $this->upload->initialize($config);
//Uploading Image
                    $this->upload->do_upload('image');
//Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();

                    if ($imgerror == '') {

                        $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                        $config['new_image'] = $this->config->item('upload_path_testimonial_thumb') . $imgdata['file_name'];
//$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
//$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('testimonial_thumb_width');
                        $config['height'] = $this->config->item('testimonial_thumb_height');

//Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

//Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {

                        $this->session->set_flashdata('error', $imgerror);
                        redirect('Testimonial', 'refresh');
                    }
                } else {

                    $this->session->set_flashdata('error', 'Image can not to be null.');
                    redirect('Testimonial', 'refresh');
                }
                $Data = array(
                    "client_name" => $name,
                    "testimonial" => $testimonial,
                    "location" => $location,
                    "on_home" => $show,
                    "status" => 'Enable',
                    "image" => $dataimage,
                    "created_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );

                $re = $this->common->insert_data($Data, 'testimonial');

                if ($re) {
                    $this->session->set_flashdata('success', 'Testimoonial is added successfully.');
                    redirect('Testimonial', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect('Testimonial', 'refresh');
                }
            }
        }
    }

    public function edit() {
        $pid = base64_decode($this->uri->segment(3));


        $page = $this->common->select_data_by_condition('testimonial', array('id' => $pid), '*', '', '', '', '', array());


        $this->data['page_info'] = $page[0];

        $this->load->view('testimonial/edit', $this->data);
    }

    public function update_test() {
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('cname', 'cname', 'required');
            $this->form_validation->set_rules('location', 'location', 'required');
            $this->form_validation->set_rules('testimonial', 'testimonial', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('Testimonial', 'refresh');
            } else {
                $id = $this->input->post('testid');

                $name = $this->input->post('cname');
                $testimonial = $this->input->post('testimonial');
               
                $location = $this->input->post('location');
                $show = $this->input->post('home');
                if ($show == "on") {
                    $show = 1;
                } else {
                    $show = 0;
                }
                $page = $this->common->select_data_by_condition('testimonial', array('id' => $id), '*', '', '', '', '', array());

                $dataimage = $page[0]['image'];
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_testimonial');
                    $config['allowed_types'] = $this->config->item('upload_testimonial_allowed_types');
                    $config['file_name'] = rand(10, 99) . time();
                    $this->load->library('upload');
                    $this->load->library('image_lib');
                    // Initialize the new config
                    $this->upload->initialize($config);
                    //Uploading Image
                    $this->upload->do_upload('image');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();

                    // print_r($imgerror);die();
                    if ($imgerror == '') {
                        $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                        $config['new_image'] = $this->config->item('upload_path_testimonial_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('testimonial_thumb_width');
                        $config['height'] = $this->config->item('testimonial_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();


                        // delete previous images
                        if ($page[0]['image'] != '') {
                            if (file_exists($this->config->item('upload_path_testimonial') . $page[0]['image'])) {
                                @unlink($this->config->item('upload_path_testimonial') . $page[0]['image']);
                            }
                            if (file_exists($this->config->item('upload_path_testimonial_thumb') . $page[0]['image'])) {
                                @unlink($this->config->item('upload_path_testimonial_thumb') . $page[0]['image']);
                            }
                        }
                    } else {
                        $this->session->set_flashdata('error', $imgerror);
                        redirect('Testimonial', 'refresh');
                    }
                }

                $Data = array(
                    "client_name" => $name,
                    "testimonial" => $testimonial,
                    "location" => $location,
                    "on_home" => $show,
                    "status" => 'Enable',
                    "image" => $dataimage,
                    "created_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );

                if ($this->common->update_data($Data, 'testimonial', 'id', $page[0]['id'])) {

                    $this->session->set_flashdata('success', 'Testimonial is updated successfully.');
                    redirect('Testimonial', 'refresh');
                } else {

                    $this->session->set_flashdata('error', 'Sorry! something went wrong please try later!');
                    redirect('Testimonial', 'refresh');
                }
            }
        }
    }

    public function update_status() {
        if ($this->input->method() == 'post') {

            $id = $this->input->post('testid');

            $old_status = $this->input->post('old_status');

            if ($old_status == 'Enable') {
                $status = 'Disable';
            } else {
                $status = 'Enable';
            }
            $pagecat = $this->common->select_data_by_condition('testimonial', array('id' => $id), '*', '', '', '', '', array());

            if (empty($pagecat)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(site_url() . 'Testimonial', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'testimonial', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(site_url() . 'Testimonial', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(site_url() . 'Testimonial', 'refresh');
                }
            }
        }
    }

    function delete() {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('deletetestid');

            $tpage = $this->common->select_data_by_condition('testimonial', array('id' => $id), '*', '', '', '', '', array());

            if (empty($tpage)) {
                $this->session->set_flashdata('error', 'No information Found !');
                redirect(base_url() . 'Testimonial', 'refresh');
            }

            if ($tpage[0]['image'] != '') {
                if (file_exists($this->config->item('upload_path_testimonial') . $tpage[0]['image'])) {
                    @unlink($this->config->item('upload_path_page') . $tpage[0]['image']);
                }
                if (file_exists($this->config->item('upload_path_testimonial_thumb') . $tpage[0]['image'])) {
                    @unlink($this->config->item('upload_path_testimonial_thumb') . $tpage[0]['image']);
                }
            }

            $res = $this->common->delete_data('testimonial', 'id', $id);

            if ($res) {
                $this->session->set_flashdata('success', 'Testimonial is deleted successfully.');
                redirect(site_url() . 'Testimonial', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(site_url() . 'Testimonial', 'refresh');
            }
        }
    }

}
