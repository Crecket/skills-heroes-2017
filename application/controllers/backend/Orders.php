<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Products
 */
class Orders extends Sessioned_Controller
{
    /**
     * Products constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model("order");
        $this->load->model("orderproduct");
    }

    /**
     *
     */
    public function index()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Orders",
            "view" => "backend/orders/index",
            "orders" => $this->order->all()
        ));
    }

    /**
     *
     */
    public function details($id)
    {
        $order = $this->order->get_by_id($id);
        if (!$order) {
            $_SESSION['notifications'][] = array(
                'message' => 'We konden deze order helaas niet meer vinden',
                'type' => 'danger'
            );
            redirect('/backend/orders');
            exit;
        }

        $order_products = $this->orderproduct->get_by_order_id($order['id']);
        if (!$order_products) {
            $_SESSION['notifications'][] = array(
                'message' => 'We konden de bijbehorende producten van deze order helaas niet goed inladen.',
                'type' => 'danger'
            );
            redirect('/backend/orders');
            exit;
        }

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Orders",
            "view" => "backend/orders/details",
            "order" => $order,
            "order_products" => $order_products,
        ));
    }

}
