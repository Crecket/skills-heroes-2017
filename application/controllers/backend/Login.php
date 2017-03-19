<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends CI_Controller
{
    /**
     * Login constructor.
     */
    public function __construct()
    {
        // Construct parent
        parent::__construct();

        // Load User model
        $this->load->model("user");
        $this->load->helper("crypto_helper");
    }

    /**
     *
     */
    public function index()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Inloggen",
            "view" => "backend/login",
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     * Het admin wachtwoord is momenteel: 1234
     */
    public function check()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        // check if either a email or username exists for the input
        $results = $this->user->get_by_username($username);

        if ($results) {
            if (password_verify_alt($password, $results['password'])) {
                // valid password, store user info into the session
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $results;

                // display a message
                $_SESSION['notifications'][] = array(
                    'message' => 'U bent successvol ingelogd.',
                    'type' => 'success'
                );
                redirect("/backend");
                exit;
            }
        }

        $_SESSION['notifications'][] = array(
            'message' => 'De naam of wachtwoord combinatie die u heeft ingevuld is verkeerd.',
            'type' => 'danger'
        );
        redirect("/backend/login");
    }

    /**
     *
     */
    public function logout()
    {
        // unset values
        unset($_SESSION["logged_in"]);
        unset($_SESSION["user"]);

        redirect("backend");
    }
}
