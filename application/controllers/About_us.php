<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About_us extends CI_Controller
{
    public function index()
    {
        // Load view
        $this->load->view("template", array(
            "page_title"  => "Over Ons",
            "view"        => "pages/about_us",
        ));
    }
}
