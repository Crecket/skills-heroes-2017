<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingCart extends CI_Controller
{
    public function __construct()
    {
        // Construct parent
        parent::__construct();

        // Load product modal
        $this->load->model("product");
    }

    public function index()
    {

        $_SESSION['shopping_cart'] = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : array();
        $shopping_cart = array();
        foreach ($_SESSION['shopping_cart'] as $key => $cart_item) {
            $product_info = $this->product->get_for_id($cart_item['product_id']);
            if (!$product_info) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Een van de producten is helaas niet meer beschikbaar.',
                    'type' => 'danger'
                );
                unset($_SESSION['shopping_cart'][$key]);
                redirect('/shoppingcart');
                exit;
            }
            // add amount value to the product info
            $product_info['amount'] = $cart_item['amount'];

            // add to list
            $shopping_cart[] = $product_info;
        }

        // Load view
        $this->load->view("template", array(
            "page_title" => "Webshop",
            "view" => "pages/shopping_cart.php",
            "shopping_cart" => $shopping_cart,
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    public function remove($product_id)
    {
        if (!empty($_SESSION['shopping_cart'][$product_id])) {
            unset($_SESSION['shopping_cart'][$product_id]);
            $_SESSION['notifications'][] = array(
                'message' => 'Het product is successvol verwijderd uit de winkelwagen.',
                'type' => 'success'
            );
        }
        redirect('/shoppingcart');
    }

    public function set($product_id)
    {
        $amount = intval($this->input->post('amount'));

        $product_info = $this->product->get_for_id($product_id);
        if (!$product_info) {
            $_SESSION['notifications'][] = array(
                'message' => 'Het lijkt erop dat dit product niet bestaat!',
                'type' => 'danger'
            );
        } else if (!$amount && $amount !== 0) {
            $_SESSION['notifications'][] = array(
                'message' => 'De ingevulde hoeveelheid is incorrect.',
                'type' => 'danger'
            );
        } else {
            if (!isset($_SESSION['shopping_cart'][$product_id])) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Het product is successvol toegevoegd aan uw winkelwagen.',
                    'type' => 'success'
                );
            } else {
                $_SESSION['notifications'][] = array(
                    'message' => 'Het product is successvol aangepast in uw winkelwagen.',
                    'type' => 'success'
                );
            }

            if ($amount <= 0) {
                unset($_SESSION['shopping_cart'][$product_id]);
            } else {
                $_SESSION['shopping_cart'][$product_id] = array(
                    'product_id' => intval($product_id),
                    'amount' => intval($amount)
                );
            }
        }

        redirect('/shoppingcart');
    }
}
