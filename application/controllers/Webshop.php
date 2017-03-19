<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Webshop
 */
class Webshop extends CI_Controller
{
    /**
     * Webshop constructor.
     */
    public function __construct()
    {
        // Construct parent
        parent::__construct();

        // Load Category model
        $this->load->model("category");
        $this->load->model("product");
        $this->load->model("order");
        $this->load->model("orderproduct");
        $this->load->helper(array("crypto_helper", "form_helper"));
    }

    /**
     *
     */
    public function index()
    {
        // Load view
        $this->load->view("template", array(
            "page_title" => "Webshop",
            "view" => "webshop/index",
            "categories" => $this->category->get_categories()
        ));
    }

    /**
     *
     */
    public function order()
    {
        $_SESSION['shopping_cart'] = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : array();

        // check if we have atleast 1 product in the cart
        if (count($_SESSION['shopping_cart']) <= 0) {
            redirect('/webshop');
            exit;
        }

        $shopping_cart = array();
        foreach ($_SESSION['shopping_cart'] as $key => $cart_item) {
            $product_info = $this->product->get_for_id($cart_item['product_id']);
            if (!$product_info) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Een van de producten is helaas niet meer beschikbaar.',
                    'type' => 'danger'
                );
                unset($_SESSION['shopping_cart'][$key]);
                redirect('/webshop/order');
                exit;
            }
            // add amount value to the product info
            $product_info['amount'] = $cart_item['amount'];

            // add to list
            $shopping_cart[] = $product_info;
        }

        $this->load->view("template", array(
            "page_title" => "Webshop",
            "view" => "webshop/order",
            "shopping_cart" => $shopping_cart,
            "categories" => $this->category->get_categories(),
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     *
     */
    public function confirm_order()
    {
        // store fields in session
        store_form_fields();

        // default value for shopping cartø
        $_SESSION['shopping_cart'] = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : array();

        // check if we got a shopping cart or if it is empty
        if (count($_SESSION['shopping_cart']) <= 0) {
            redirect('/webshop');
            exit;
        }

        // retrieve post values
        $aanhef = trim($this->input->post("aanhef"));
        $naam = trim($this->input->post("naam"));
        $achternaam = trim($this->input->post("achternaam"));
        $tussenvoegsel = trim($this->input->post("tussenvoegsel"));
        $bedrijfsnaam = trim($this->input->post("bedrijfsnaam"));
        $email = trim($this->input->post("email"));
        $telefoonnummer = trim($this->input->post("telefoonnummer"));
        $straat = trim($this->input->post("straat"));
        $huisnummer = trim($this->input->post("huisnummer"));
        $postcode = trim($this->input->post("postcode"));
        $woonplaats = trim($this->input->post("woonplaats"));

        // validate input
        $missing_field = false;
        $error_message = false;
        if (empty($aanhef)) {
            $missing_field = 'aanhef';
        } else if (empty($naam)) {
            $missing_field = 'naam';
        } else if (empty($achternaam)) {
            $missing_field = 'achternaam';
        } else if (empty($email)) {
            $missing_field = 'email';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = 'Het ingevulde e-mail address is niet geldig';
        } else if (empty($telefoonnummer)) {
            $missing_field = 'telefoonnummer';
        } else if (empty($straat)) {
            $missing_field = 'straat';
        } else if (empty($huisnummer)) {
            $missing_field = 'huisnummer';
        } else if (empty($postcode)) {
            $missing_field = 'postcode';
        } else if (empty($woonplaats)) {
            $missing_field = 'woonplaats';
        }

        // check if we got everything
        if ($missing_field) {
            $_SESSION['notifications'][] = array(
                'message' => 'Het veld "' . $missing_field . '" is niet ingevuld of ongeldig.',
                'type' => 'danger'
            );
            redirect('/webshop/order');
            exit;
        }

        // check if we got everything
        if ($error_message) {
            $_SESSION['notifications'][] = array(
                'message' => $error_message,
                'type' => 'danger'
            );
            redirect('/webshop/order');
            exit;
        }

        // first format the existing list
        $shopping_cart = array();
        foreach ($_SESSION['shopping_cart'] as $key => $cart_item) {
            $product_info = $this->product->get_for_id($cart_item['product_id']);
            if (!$product_info) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Een van de producten is helaas niet meer beschikbaar.',
                    'type' => 'danger'
                );
                unset($_SESSION['shopping_cart'][$key]);
                redirect('/webshop/order');
                exit;
            }
            // add amount value to the product info
            $product_info['amount'] = $cart_item['amount'];

            // add to list
            $shopping_cart[] = $product_info;
        }

        // generate a random ID to prevent enumeration
        $order_id = randomInt(500, 500000000);

        // attempt to insert all the info into the database
        $result = $this->order->add($order_id, $aanhef, $naam, $achternaam, $tussenvoegsel, $bedrijfsnaam, $email, $telefoonnummer, $straat, $huisnummer, $postcode, $woonplaats);

        if (!$result) {
            $_SESSION['notifications'][] = array(
                'message' => 'Er is helaas iets misgegaan bij het plaatsen van uw bestelling.',
                'type' => 'danger'
            );
            redirect('/webshop/order');
            exit;
        }

        // loop through attached items
        foreach ($shopping_cart as $cart_item) {
            $result = $this->orderproduct->add($order_id, $cart_item['id'], $cart_item['amount']);
            if (!$result) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Er is helaas iets misgegaan bij het plaatsen van uw bestelling.',
                    'type' => 'danger'
                );
                // remove the order
                $this->order->remove($order_id);
                // redirect back
                redirect('/webshop/order');
                exit;
            }
        }

        $_SESSION['notifications'][] = array(
            'message' => 'Bedankt voor uw bestelling. Uw bestelling is successvol geplaatst en zal in behandeling genomen worden.',
            'type' => 'success'
        );

        // clear stored data and fields
        $_SESSION['shopping_cart'] = array();
        clear_form_fields();

        redirect('/webshop');
    }

    /**
     * @param $category_url
     */
    public function category($category_url)
    {
        // Get current category
        $category = $this->category->get_by_url($category_url);

        if (!is_array($category)) {
            show_error("Couldn't find category");
        }

        // Load view
        $this->load->view("template", array(
            "page_title" => "Webshop > Categorie > {$category["title"]}",
            "view" => "webshop/category",
            "category" => $category,
            "products" => $this->product->get_for_category($category["id"]),
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     * @param $product_url
     */
    public function product($product_url)
    {
        // Get current product
        $product = $this->product->get_by_url($product_url);

        if (!is_array($product)) {
            show_error("Couldn't find product");
        }

        // Load view
        $this->load->view("template", array(
            "page_title" => "Webshop > Product > {$product["name"]}",
            "view" => "webshop/product",
            "product" => $product,
            "category" => $this->category->get_by_id($product["category_id"]),
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }
}
