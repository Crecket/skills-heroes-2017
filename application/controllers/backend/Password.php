<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 */
class Password extends CI_Controller
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

        // hash the new password
//        $new_hash = password_hash_alt(1234);
//
//        echo $new_hash;
//        exit;

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Wachtwoord aanpassen",
            "view" => "backend/password",
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     * Het admin wachtwoord is momenteel: 1234
     */
    public function update()
    {
        $current_password = $this->input->post("current_password");
        $new_password = $this->input->post("new_password");
        $password_repeat = $this->input->post("password_repeat");

        $user_check = $this->user->get_by_username($_SESSION['user']['username']);
        if (!$user_check) {
            // remove user details
            $_SESSION['logged_in'] = false;
            unset($_SESSION['user']);
            redirect('/');
            exit;
        }
        $_SESSION['user'] = $user_check;

        // verify if the current password is correct
        if (!password_verify_alt($current_password, $user_check['password'])) {
            $_SESSION['notifications'][] = array(
                'message' => 'Het huidige wachtwoord wat u heeft ingevuld is niet correct!',
                'type' => 'danger'
            );
            redirect('/backend/password');
            exit;
        }

        // verify if both new passwords are the same
        if ($new_password !== $password_repeat) {
            $_SESSION['notifications'][] = array(
                'message' => 'Uw nieuwe wachtwoord en wachtwoord controle komen niet overeen!',
                'type' => 'danger'
            );
            redirect('/backend/password');
            exit;
        }

        // verify if both new passwords are the same
        if (mb_strlen($new_password) < 7) {
            $_SESSION['notifications'][] = array(
                'message' => 'De minimale vereiste lengte staat momenteel op 7 karakters!',
                'type' => 'danger'
            );
            redirect('/backend/password');
            exit;
        }

        // hash the new password
        $new_hash = password_hash_alt($new_password);

        // attempt to update the password
        $update = $this->user->update($user_check['id'], $user_check['username'], $user_check['email'], $new_hash);

        // check the results
        if ($update) {
            // update in session aswell just to be sure
            $_SESSION['user']['password '] = $new_hash;

            $_SESSION['notifications'][] = array(
                'message' => 'Uw wachtwoord is successvol aangepast!',
                'type' => 'success'
            );
        } else {
            $_SESSION['notifications'][] = array(
                'message' => 'Uw wachtwoord is helaas niet successvol aangepast!',
                'type' => 'danger'
            );
        }

        // redirect back
        redirect("/backend/password");
    }

}
