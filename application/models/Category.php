<?php

class Category extends CI_Model
{
    public function get_by_id($id)
    {
        $query = $this->db->query("SELECT `id`,`title`,`url`,`description` FROM `categories` WHERE removed = 0 AND `id` = ?", array(
            $id
        ));
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return;
        }
    }

    public function get_by_url($url)
    {
        $query = $this->db->query("SELECT `id`,`title`,`url`,`description` FROM `categories`  WHERE removed = 0 AND `url` = ?", array(
            $url
        ));
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return;
        }
    }

    /**
     * @return array
     */
    public function get_categories()
    {
        $categories = array();

        $query = $this->db->query("SELECT `id`,`title`,`url`,`description` FROM `categories` WHERE removed = 0 ORDER BY `title`");
        foreach ($query->result() as $category) {
            $categories[$category->id] = array(
                "id" => $category->id,
                "title" => $category->title,
                "url" => $category->url,
                "description" => $category->description
            );
        }

        return $categories;
    }

    /**
     * @param $title
     * @param $url
     * @param $description
     * @return mixed
     */
    public function add($title, $url, $description)
    {
        return $this->db->query("INSERT INTO `categories` (`title`,`url`,`description`) VALUES(:title, :url, :description);", array(
            $title, $url, $description
        ));
    }

    public function edit($id, $title, $url, $description)
    {
        return $this->db->query("UPDATE `categories` SET `title` = ?, `url` = ?, `description` = ? WHERE `id` = ?;", array(
            $title, $url, $description, $id
        ));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $query = $this->db->query("UPDATE categories SET removed = 1 WHERE id = ?",
            array($id));
        return $query;
    }

}
