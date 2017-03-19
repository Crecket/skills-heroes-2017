<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends Sessioned_Controller
{

    public function index()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title"  => "Home",
            "view"        => "backend/home",
        ));
    }
}
