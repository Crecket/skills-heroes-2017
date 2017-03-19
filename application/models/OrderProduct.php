<?php

/**
 * Class OrderProduct
 */
class OrderProduct extends CI_Model
{
    /**
     * @param $order_id
     */
    public function get_by_order_id($order_id)
    {
        $query = $this->db->query("SELECT `order_id`,`product_id`,`amount`, `p`.`id`, `p`.`price`, `p`.* FROM `order_products` 
                INNER JOIN `products` as `p` ON `order_products`.`product_id` = `p`.`id`
                WHERE `order_id` = ?", array($order_id));

        $orders = array();
        foreach ($query->result() as $order) {
            $orders[$order->id] = (array)$order;
        }
        return $orders;
    }

    /**
     *
     */
    public function all()
    {
        $query = $this->db->query("SELECT `order_id`,`order_id`,`amount` FROM `order_products`");
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return;
        }
    }

    /**
     * @param $order_id
     * @return array
     */
    public function add($order_id, $product_id, $amount)
    {
        $query = $this->db->query("INSERT INTO `order_products` (`order_id`,`product_id`, `amount`) VALUES (?, ?, ?)",
            array($order_id, $product_id, $amount));
        return $query;
    }

    /**
     * @param $order_id
     * @param $product_id
     */
    public function remove($order_id, $product_id)
    {
        return $this->db->query("DELETE FROM `order_products` WHERE `order_id` = ? AND `product_id` = ?",
            array($order_id, $product_id));
    }
}