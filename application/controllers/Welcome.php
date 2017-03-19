<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        // Load view
        $this->load->view("template", array(
            "page_title"  => "Home",
            "view"        => "pages/home",
        ));
    }
}
