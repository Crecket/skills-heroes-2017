<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_form_field')) {
    /**
     * returns a stored field from the session or null
     * @param $field
     * @return null
     */
    function get_form_field($field)
    {
        return !empty($_SESSION['saved_form_fields'][$field]) ? $_SESSION['saved_form_fields'][$field] : null;
    }
}

if (!function_exists('store_form_fields')) {
    /**
     * Clears the stored form fields
     */
    function store_form_fields()
    {
        // store fields in session
        $_SESSION['saved_form_fields'] = $_POST;
    }
}

if (!function_exists('clear_form_fields')) {
    /**
     * Clears the stored form fields
     */
    function clear_form_fields()
    {
        $_SESSION['saved_form_fields'] = array();
    }
}
