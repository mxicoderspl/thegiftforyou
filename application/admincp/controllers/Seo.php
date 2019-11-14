<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seo extends My_Controller {

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
    }

    //load listing setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['settings'] = $this->common->get_all_record('seo', '*', 'id', 'ASC');
        $this->load->view('seo/index', $this->data);
    }

    //edit seo form
    public function editform() {
        if ($this->input->is_ajax_request() && $this->input->post('setting_id')) {
            $setting_id = base64_decode($this->input->post('setting_id'));
            if ($setting_id != 0) {
                $setting_id = $setting_id;
                $setting_detail = $this->common->selectRecordById('seo', $setting_id, 'id');
                //create html of edit form
                $editform = '';
                
                if($setting_id==1){
                    
                $editform .= ' <form id="editform" method="post" action="seo/update"><div class="panelt panel-success-head" id="model_header">
                               
                                <div class="modal-header"> 
                                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                                 <h4 class="modal-title">' . ucwords($setting_detail['fieldname']) . '</h4>
                                </div>'   ;
                    
                $editform.='<div class="col-sm-12" style="display:none; color:#f00;" id="errorMsg">Please enter ' . $setting_detail['fieldname'] . '</div>';
                $editform.='</div><div class="modal-body">';
                $editform.='';
                $editform.='<div style="display:none;"><input name="' . $this->security->get_csrf_token_name() . '" value="' . $this->security->get_csrf_hash() . '" /></div>';
                $editform.='<input type="hidden" id="setting_edit" name="setting_edit" value="' . base64_encode($setting_detail['id']) . '" />';
                $editform.='<div class="col-sm-9 col-md-9 col-lg-10">';
                $editform.='<textarea class="form-control" placeholder="Example : UA-XXXXX-X" id="setting_val" name="setting_val" rows="5" >' . $setting_detail['value'] . '</textarea>';
                $editform.='<span class="help-inline" style="display:none;" id="email_err"></span>
                                <span class="help-inline" style="display:none;" id="numeric_err"></span></div>';
                $editform .='</div><div class="clearfix"></div><div class="modal-footer"> 
                                <input class="btn btn-primary" onclick="" type="submit" id="btn_save" name="btn_save" value="Save" />
                            </div>';
                
                //$editform.='<input class="btn btn-success" onclick="validate_submit(event);" type="submit" id="btn_save" name="btn_save" value="Save" />';
                $editform.='</form></div>';
                
                
                }
                else{
                     $editform .= '<form id="editform" method="post" action="seo/update"><div class="panelt panel-success-head" id="model_header">
                                
                                <div class="modal-header"> 
                                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                                 <h4 class="modal-title">' . ucwords($setting_detail['fieldname']) . '</h4>
                                </div>'   ;
                   /*  $editform.='<div class="panelt panel-success-head" id="model_header"><div class="panel-heading">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3 id="setting_title" class="panel-title">' . ucwords($setting_detail['fieldname']) . '</h3></div>';*/
                $editform.='<div class="col-sm-12" style="display:none; color:#f00;" id="errorMsg">Please enter ' . $setting_detail['fieldname'] . '</div>';
                $editform.='</div><div class="modal-body">';
                $editform.='';
                $editform.='<div style="display:none;"><input name="' . $this->security->get_csrf_token_name() . '" value="' . $this->security->get_csrf_hash() . '" /></div>';
                $editform.='<input type="hidden" id="setting_edit" name="setting_edit" value="' . base64_encode($setting_detail['id']) . '" />';
                $editform.='<div class="col-sm-9 col-md-9 col-lg-10">';
                $editform.='<textarea class="form-control" placeholder="" id="setting_val" name="setting_val" rows="5" >' . $setting_detail['value'] . '</textarea>';
                $editform.='<span class="help-inline" style="display:none;" id="email_err"></span>
                                <span class="help-inline" style="display:none;" id="numeric_err"></span></div>';
                $editform .='</div><div class="clearfix"></div><div class="modal-footer"> 
                                <input class="btn btn-primary" onclick="" type="submit" id="btn_save" name="btn_save" value="Save" />
                            </div>';
//$editform.='<input class="btn btn-success" onclick="validate_submit(event);" type="submit" id="btn_save" name="btn_save" value="Save" />';
                $editform.='</form></div>';  
                }
                
                
                //  $editform.='<script><script>';
                echo $editform;
                die();
            } else {
                redirect('Dashboard', 'refresh');
            }
        } else {
            redirect('Dashboard', 'refresh');
        }
    }

    //Updating the record
    public function update() {
        if ($this->input->post('setting_edit')) {
            //Getting settingid
            $settingid = base64_decode($this->input->post('setting_edit'));

            //Getting value
            $fieldvalue = ($this->input->post('setting_val', TRUE));
            $settingdata = array('value' => $fieldvalue);
            $settingInfo = $this->common->selectRecordById('seo', $settingid, 'id');
            $settingName = $settingInfo['fieldname'];

            if ($this->common->update_data($settingdata, "seo", "id", $settingid)) {
                $this->session->set_flashdata('success', $settingName . ' updated successfully.');
                redirect('Seo', 'refresh');
            } else {

                $this->session->set_flashdata('error', 'There is error in updating ' . $settingName . '. Try later!');
                redirect('Seo', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
            redirect('Seo', 'refresh');
        }
    }

}

/* End of file Seo.php */
/* Location: ./application/controllers/Seo.php */
