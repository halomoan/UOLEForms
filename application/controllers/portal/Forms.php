<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->model('portal/forms_model');
        $this->lang->load('portal/forms');


        /* Title Page :: Common */
        $this->page_title->push(lang('menu_forms'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_forms'), 'portal/forms');

    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

                /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();

                /* Data */
                $this->data['error'] = NULL;

                /* JS */
                $this->data['loadjs'] = TRUE;
                $this->data['js_name'] = 'forms.js';

                /* Forms Data */
                $this->data['form1'] =  $this->forms_model->get_form('1');

                /* Load Template */
                $this->template->admin_render('portal/forms/index', $this->data);



        }
	}

    public function update($form = NULL)
    {

            if($form == 'form1') {
                $this->form_validation->set_rules('reporter', 'lang:form1_reporter', 'required');
                $this->form_validation->set_rules('email', 'lang:form1_email', 'required');
                if ($this->form_validation->run() == TRUE) {

                    //vdebug($this->input->post());
                    $data = array(
                        'reporter' => $this->input->post('reporter'),
                        'email' => $this->input->post('email'),
                    );
                    $this->forms_model->update_form($data);

                }
            }

            redirect('portal/forms', 'refresh');

    }

	public function do_upload()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Conf */
            $config['upload_path']      = './upload/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = 2048;
            $config['max_width']        = 1024;
            $config['max_height']       = 1024;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

            /* Breadcrumbs */
            //$this->breadcrumbs->unshift(2, lang('menu_files'), 'portal/files');
            $this->breadcrumbs->push(0,lang('menu_forms'),'portal/forms');
            $this->data['breadcrumb'] = $this->breadcrumbs->xshow();

            if ( ! $this->upload->do_upload('userfile'))
            {
                /* Data */
                $this->data['error'] = $this->upload->display_errors();

                /* Load Template */
                $this->template->admin_render('portal/files/index', $this->data);
            }
            else
            {
                /* Data */
                $this->data['upload_data'] = $this->upload->data();

                /* Load Template */
                $this->template->admin_render('portal/files/upload', $this->data);
            }
        }
	}
}
