<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('public/home');
        /* Title Page :: Common */
        $this->page_title->push(lang('home_title'));
        $this->data['pagetitle'] = $this->page_title->show();

    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }else{
            /* Load Template */
            $this->template->admin_render('public/home', $this->data);
        }
	}
}
