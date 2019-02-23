<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->dbutil();
        $this->lang->load('portal/database');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_database_utility'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_database_utility'), 'portal/database');
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
            $this->data['list_tables'] = $this->db->list_tables();
            $this->data['platform']    = $this->db->platform();
            $this->data['version']     = $this->db->version();

            /* Load Template */
            $this->template->admin_render('portal/database/index', $this->data);
        }
	}
}
