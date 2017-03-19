<?php

/**
 * Class Order
 */
class Order extends CI_Model
{

    /**
     *
     */
    public function all()
    {
        $query = $this->db->query("SELECT `id`,`geplaatst`,`aanhef`,`naam`, `achternaam`, `tussenvoegsel`, `bedrijfsnaam`, `email`,
                `telefoonnummer`, `straat`, `huisnummer`, `postcode`, `woonplaats`,
                (
                  SELECT SUM(`p`.`price` * `op`.`amount`) as totalprice FROM order_products as `op`
                  INNER JOIN products as `p` ON `op`.`product_id` = `p`.`id`
                  WHERE `op`.`order_id` = `o`.`id`
                  GROUP BY `o`.`id`
                ) as `total_price`
                FROM `orders` as `o`
                ORDER BY `geplaatst` DESC;");

        $orders = array();
        foreach ($query->result() as $order) {
            $orders[$order->id] = (array)$order;
        }

        return $orders;
    }

    /**
     * @param $order_id
     */
    public function get_by_id($order_id)
    {
        $query = $this->db->query("SELECT `id`,`geplaatst`,`aanhef`,`naam`, `achternaam`, `tussenvoegsel`, `bedrijfsnaam`, `email`,
                `telefoonnummer`, `straat`, `huisnummer`, `postcode`, `woonplaats`,
                (
                  SELECT SUM(`p`.`price` * `op`.`amount`) as totalprice FROM order_products as `op`
                  INNER JOIN products as `p` ON `op`.`product_id` = `p`.`id`
                  WHERE `op`.`order_id` = `o`.`id`
                  GROUP BY `o`.`id`
                ) as `total_price`
                FROM `orders` as `o`
                WHERE `o`.`id` = ?
                ORDER BY `geplaatst` DESC;", array(
            $order_id
        ));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $aanhef
     * @param $naam
     * @param $achternaam
     * @param $tussenvoegsel
     * @param $bedrijfsnaam
     * @param $email
     * @param $telefoonnummer
     * @param $straat
     * @param $huisnummer
     * @param $postcode
     * @param $woonplaats
     * @return mixed
     */
    public function add($id, $aanhef, $naam, $achternaam, $tussenvoegsel, $bedrijfsnaam, $email, $telefoonnummer, $straat, $huisnummer, $postcode, $woonplaats)
    {
        $query = $this->db->query("INSERT INTO `orders` (`id`,`aanhef`,`naam`, `achternaam`, `tussenvoegsel`, `bedrijfsnaam`, `email`, `telefoonnummer`, `straat`, `huisnummer`, `postcode`, `woonplaats`) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",
            array($id, $aanhef, $naam, $achternaam, $tussenvoegsel, $bedrijfsnaam, $email, $telefoonnummer, $straat, $huisnummer, $postcode, $woonplaats));

        // return the resutlts
        return $query;
    }

    /**
     * @param $order_id
     * @param $product_id
     */
    public function remove($order_id, $product_id)
    {
        return $this->db->query("DELETE FROM `orders` WHERE `id` = ?",
            array($order_id, $product_id));
    }
}