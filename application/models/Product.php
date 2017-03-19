<?php

class Product extends CI_Model
{
    /**
     * @return array
     */
    public function all()
    {
        $products = array();

        $query = $this->db->query("SELECT products.id, categories.id as category_id, `name`, `products`.`url`, `products`.`description`, `ean`, `price`, `title` FROM `products`
            LEFT JOIN categories ON categories.id = products.category_id
            WHERE products.removed = 0");
        foreach ($query->result() as $product) {
            $products[$product->id] = array(
                "id" => $product->id,
                "name" => $product->name,
                "url" => $product->url,
                "description" => $product->description,
                "price" => $product->price,
                "category_title" => $product->title,
            );
        }

        return $products;
    }

    /**
     * @param $id
     * @param $category_id
     * @param $name
     * @param $url
     * @param $ean
     * @param $price
     * @param $description
     * @return mixed
     */
    public function add($id, $category_id, $name, $url, $ean, $price, $description)
    {
        $query = $this->db->query("INSERT INTO products (id,`category_id`, `name`, `url`, `description`, `ean`, `price`) 
                                    VALUES (?,?,?,?,?,?,?)",
            array(
                $id, $category_id, $name, $url, $description, $ean, $price
            ));

        return $query;
    }

    /**
     * @param $id
     * @param $category_id
     * @param $name
     * @param $url
     * @param $ean
     * @param $price
     * @param $description
     * @return mixed
     */
    public function edit($id, $category_id, $name, $url, $ean, $price, $description)
    {
        $query = $this->db->query("UPDATE products SET category_id = ?, `name` = ?, url = ?, description = ?, 
                                    ean = ?, price = ? WHERE id = ?",
            array(
                $category_id, $name, $url, $description, $ean, $price, $id
            ));

        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $query = $this->db->query("UPDATE products SET removed = 1 WHERE id = ?",
            array($id));

        return $query;
    }

    /**
     * @param $url
     * @return bool
     */
    public function get_by_url($url)
    {
        $query = $this->db->query("SELECT `id`, `category_id`, `name`, `url`, `description`, `ean`, `price` FROM `products` 
            WHERE LOWER(`url`) = LOWER(?) AND removed = 0", array(
            $url
        ));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    /**
     * @param $name
     * @return bool
     */
    public function get_by_name($name)
    {
        $query = $this->db->query("SELECT `id`, `category_id`, `name`, `url`, `description`, `ean`, `price` FROM `products` 
            WHERE LOWER(`name`) = LOWER(?) AND removed = 0", array(
            $name
        ));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * @param $category_id
     * @return array
     */
    public function get_for_category($category_id)
    {
        $products = array();

        $query = $this->db->query("SELECT `id`, `category_id`, `name`, `url`, `description`, `ean`, `price` FROM `products` 
            WHERE `category_id` = ? AND removed = 0 ORDER BY `name`", array(
            $category_id
        ));
        foreach ($query->result() as $product) {
            $products[$product->id] = array(
                "id" => $product->id,
                "name" => $product->name,
                "url" => $product->url,
                "description" => $product->description,
                "price" => $product->price
            );
        }

        return $products;
    }

    /**
     * @param $product_id
     * @return bool
     */
    public function get_for_id($product_id)
    {
        $query = $this->db->query("SELECT `id`, `category_id`, `name`, `url`, `description`, `ean`, `price` FROM `products` 
            WHERE `id` = ? AND removed = 0 ORDER BY `name`", array(
            $product_id
        ));
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}