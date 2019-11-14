<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Slider extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Slider : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {
        $this->data['slidedata'] = $this->common->get_all_record('slider', '*', '', '');
        $this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('slider/index', $this->data);
    }

    // Add Slider-Image

    public function add() {

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('title', 'title', 'required');
            //$this->form_validation->set_rules('link', 'link', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('Slider', 'refresh');
            } else {
                $title = $this->input->post('title');
               // $link = $this->input->post('link');
                 $desc = $this->input->post('description');
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_slider');
                    $config['allowed_types'] = $this->config->item('upload_slider_allowed_types');
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
                        $config['new_image'] = $this->config->item('upload_path_slider_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('slider_thumb_width');
                        $config['height'] = $this->config->item('slider_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                        $dataimage = '';
                    }
                } else {
                    $this->session->set_flashdata('error', $imgerror);
                    redirect('Slider', 'refresh');
                }
                $Data = array(
                    "title" => $title,
                   "description" => $desc,
                    "image" => $dataimage,
                    "created_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );
                if ($this->common->insert_data($Data, 'slider')) {
                    $this->session->set_flashdata('success', 'Slider is added successfully.');
                    redirect('Slider', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect('Slider', 'refresh');
                }
            }
        }
        $this->load->view('slider/add', $this->data);
    }

    public function update() {
        
        
        $slide_id = base64_decode($this->input->post('slide_id'));
        if ($this->input->is_ajax_request()) {
            if ($slide_id != '' && $slide_id != 0) {
                $this->data['slide'] = $this->common->selectRecordById('slider', $slide_id, 'id');
                $this->load->view('slider/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('etitle', 'etitle', 'required');
           // $this->form_validation->set_rules('elink', 'elink', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {

                $title = $this->input->post('etitle', TRUE);
               // $link = $this->input->post('elink', TRUE);
                $status = $this->input->post('estatus', TRUE);
		$description = $this->input->post('edescription',TRUE);
                $slider = $this->common->select_data_by_condition('slider', array('id' => $slide_id), '*', '', '', '', '', array());
                $dataimage = $slider[0]['image'];
                if (isset($_FILES['eimage']['name']) && $_FILES['eimage']['name'] != null && $_FILES['eimage']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_slider');
                    $config['allowed_types'] = $this->config->item('upload_slider_allowed_types');
                    $config['file_name'] = rand(10, 99) . time();
                    $this->load->library('upload');
                    $this->load->library('image_lib');
                    // Initialize the new config
                    $this->upload->initialize($config);
                    //Uploading Image
                    $this->upload->do_upload('eimage');
                    //Getting Uploaded Image File Data
                    $imgdata = $this->upload->data();
                    $imgerror = $this->upload->display_errors();

                    // print_r($imgerror);die();
                    if ($imgerror == '') {
                        $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                        $config['new_image'] = $this->config->item('upload_path_slider_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('slider_thumb_width');
                        $config['height'] = $this->config->item('slider_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                        $dataimage = '';
                    }
                } 
                $data = array(
                    'title' => $title,
                    'image' => $dataimage,
                    'description' => $description,
                    'status' => $status,
                    'modified_date' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address(),
                );

                if ($this->common->update_data($data, 'slider', 'id', $slider[0]['id'])) {
                    $this->session->set_flashdata('success', $title . ' updated successfully.');
                    redirect('Slider', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating ' . $title . '. Try later!');
                    redirect('Slider', 'refresh');
                }
            }
        }
    }
// check valid link
function valid_link(){
    $str = $this->input->post('link');
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)){
          //  $this->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
            echo 'false';
                die();
        }
 
        echo 'true';
                die();
    }
    // delete slider image
    function delete() {
        if ($this->input->method() == 'post') {
        $id = $this->input->post('deleteslideid');

            $slider = $this->common->select_data_by_condition('slider', array('id' => $id), '*', '', '', '', '', array());
        
            if (empty($slider)) {
                $this->session->set_flashdata('error', 'No information Found !');
                redirect(base_url() . 'Slider', 'refresh');
            }

            if ($slider[0]['image'] != '') {
                if (file_exists($this->config->item('upload_path_slider') . $slider[0]['image'])) {
                    @unlink($this->config->item('upload_path_slider') . $slider[0]['image']);
                }
                if (file_exists($this->config->item('upload_path_slider_thumb') . $slider[0]['image'])) {
                    @unlink($this->config->item('upload_path_slider_thumb') . $slider[0]['image']);
                }
            }

            $res = $this->common->delete_data('slider', 'id', $id);

            if ($res) {
                $this->session->set_flashdata('success', $slider[0]['title'] . ' is deleted successfully.');
                redirect(base_url() . 'Slider', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Slider', 'refresh');
            }
        }
    }

    public function update_status() {
        if ($this->input->method() == 'post') {

            $id = $this->input->post('slideid');

            $old_status = $this->input->post('old_status');

            if ($old_status == 'Enable') {
                $status = 'Disable';
            } else {
                $status = 'Enable';
            }
            $slide = $this->common->select_data_by_condition('slider', array('id' => $id), '*', '', '', '', '', array());

            if (empty($slide)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Slider', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'slider', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(base_url() . 'Slider', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'Slider', 'refresh');
                }
            }
        }
    }

}
