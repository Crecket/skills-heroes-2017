<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public function index()
    {
        // Load view
        $this->load->view("template", array(
            "page_title"  => "Contact",
            "view"        => "pages/contact",
        ));
    }
}
