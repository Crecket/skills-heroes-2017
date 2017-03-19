<?php

/**
 * Class User
 */
class User extends CI_Model
{

    /**
     * @param $username
     */
    public function get_by_username($username)
    {
        $query = $this->db->query("SELECT `id`,`username`,`password`,`email` FROM `users` WHERE `username` = ?", array($username));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * @param $email
     */
    public function get_by_email($email)
    {
        $query = $this->db->query("SELECT `id`,`username`,`password`,`email` FROM `users` WHERE `email` = ?", array($email));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $username
     * @param $password
     * @param $email
     * @return mixed
     */
    public function update($id, $username, $email, $password)
    {
        $query = $this->db->query("UPDATE `users` SET `username` = ? , `password` = ? , `email` = ? WHERE `id` = ?",
            array($username, $password, $email, $id));

        return $query;
    }

}