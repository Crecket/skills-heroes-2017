<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('format_shopping_cart')) {
    function format_shopping_cart($str, $replace = array(), $delimiter = '-')
    {
        $_SESSION['shopping_cart'] = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : array();
        $shopping_cart = array();
        foreach ($_SESSION['shopping_cart'] as $key => $cart_item) {
            $product_info = $this->product->get_for_id($cart_item['product_id']);
            if (!$product_info) {
                echo 1;
                unset($_SESSION['shopping_cart'][$key]);
                continue;
            }
            // add amount value to the product info
            $product_info['amount'] = $cart_item['amount'];

            // add to list
            $shopping_cart[] = $product_info;
        }
        return $shopping_cart;
    }
}