<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Products
 */
class Products extends Sessioned_Controller
{
    /**
     * @var array
     */
    private $upload_config;

    /**
     * Products constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model("product");
        $this->load->model("category");
        $this->load->helper(array('form', 'url', 'crypto_helper', 'form_helper'));

        $this->upload_config = array(
            'upload_path' => FCPATH . 'files/products/',
            'allowed_types' => 'jpg|png',
            'max_size' => 500,
            'max_width' => 1024,
            'max_height' => 1024,
            'overwrite' => true,
        );
    }

    /**
     *
     */
    public function index()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Producten",
            "view" => "backend/products/overview",
            "products" => $this->product->all(),
        ));
    }

    /**
     *
     */
    public function add()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Product Toevoegen",
            "view" => "backend/products/add",
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
    public function add_save()
    {
        store_form_fields();

        $id = randomInt(50000, 10000000);
        $ean = $this->input->post("ean");
        $url = $this->input->post("url");
        $name = $this->input->post("name");
        $price = $this->input->post("price");
        $description = $this->input->post("description");
        $category_id = $this->input->post("category_id");

        // validate input
        $missing_field = false;
        if (empty($ean)) {
            $missing_field = 'ean';
        } else if (empty($url)) {
            $missing_field = 'url';
        } else if (empty($name)) {
            $missing_field = 'naam';
        } else if (empty($price)) {
            $missing_field = 'prijs';
        } else if (empty($description)) {
            $missing_field = 'beschrijving';
        } else if (empty($category_id)) {
            $missing_field = 'categorie';
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

        $product_info = $this->product->get_by_name($name);
        if ($product_info) {
            // display generic error
            $_SESSION['notifications'][] = array(
                'message' => 'Er bestaat al een product met deze naam',
                'type' => 'danger'
            );
            redirect("/backend/products/add");
            exit;
        }

        $product_info = $this->product->get_by_url($url);
        if ($product_info) {
            // display generic error
            $_SESSION['notifications'][] = array(
                'message' => 'Er bestaat al een product met deze url',
                'type' => 'danger'
            );
            redirect("/backend/products/add");
            exit;
        }

        // copy and add the file name dynamically
        $config_copy = $this->upload_config;
        $config_copy['file_name'] = $id . '.jpg';

        // load the upload library
        $this->load->library('upload', $config_copy);

        // attempt to upload file
        if (!$this->upload->do_upload('file')) {
            // display generic error
            $_SESSION['notifications'][] = array(
                'message' => 'Tijdens het opslaan van de afbeelding is iets fout gegaan.',
                'type' => 'danger'
            );
            // error list, we failed
            redirect("/backend/products/add");
            exit;
        } else {
            // save the product into the db
            $add = $this->product->add($id, $category_id, $name, $url, $ean, $price, $description);

            if (!$add) {
                $_SESSION['notifications'][] = array(
                    'message' => 'Tijdens het opslaan van het product in de database is iets fout gegaan.',
                    'type' => 'danger'
                );
                // error list, we failed
                redirect("/backend/products/add");
                exit;
            }

            $_SESSION['notifications'][] = array(
                'message' => 'Het product is succcessvol aangemaakt',
                'type' => 'success'
            );

            clear_form_fields();
        }
        redirect("/backend/products");
    }

    /**
     *
     */
    public function validate_name()
    {
        $result = false;

        // get the name from request
        $name = $this->input->post("name");
        if ($name) {
            $product_info = $this->product->get_by_name($name);
            $result = !$product_info;
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     *
     */
    public function validate_url()
    {
        $result = false;

        // get the name from request
        $url = $this->input->post("url");
        if ($url) {
            $product_info = $this->product->get_by_url($url);
            $result = !$product_info;
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        // Get product
        $product = $this->product->get_for_id($id);

        if (!is_array($product)) {
            show_error("Couldn't find category");
        }

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Product Bewerken",
            "view" => "backend/products/edit",
            "categories" => $this->category->get_categories(),
            "product" => $product,
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     *
     */
    public function edit_save()
    {
        // store fields in session
        store_form_fields();

        $id = $this->input->post("id");
        $ean = $this->input->post("ean");
        $url = $this->input->post("url");
        $name = $this->input->post("name");
        $price = $this->input->post("price");
        $description = $this->input->post("description");
        $category_id = $this->input->post("category_id");

        // check if the product exists
        $product = $this->product->get_for_id($id);
        if (!is_array($product)) {
            show_error("Couldn't find the product");
        }

        // check if name is taken
        $product_info = $this->product->get_by_name($name);
        if ($product_info && $product_info['id'] != $id) {
            // display generic error
            $_SESSION['notifications'][] = array(
                'message' => 'Er bestaat al een product met deze naam',
                'type' => 'danger'
            );
            redirect("/backend/products/add");
            exit;
        }

        // check if new url is taken
        $product_info = $this->product->get_by_url($url);
        if ($product_info && $product_info['id'] != $id) {
            // display generic error
            $_SESSION['notifications'][] = array(
                'message' => 'Er bestaat al een product met deze url',
                'type' => 'danger'
            );
            redirect("/backend/products/add");
            exit;
        }

        $config_copy = $this->upload_config;
        $config_copy['file_name'] = $id . '.jpg';

        // load the upload library
        $this->load->library('upload', $config_copy);

        // check if a new file was uploaded
        if (!empty($_FILES['file']['name'])) {

            // attempt to upload file
            if (!$this->upload->do_upload('file')) {

                // display generic error
                $_SESSION['notifications'][] = array(
                    'message' => 'Tijdens het opslaan van de nieuwe afbeelding is iets fout gegaan.',
                    'type' => 'danger'
                );
                // error list, we failed
                redirect("/backend/products/edit/" . $id);
                exit;
            }
        }

        // update the product in the db
        $edit = $this->product->edit($id, $category_id, $name, $url, $ean, $price, $description);

        if (!$edit) {
            $_SESSION['notifications'][] = array(
                'message' => 'Tijdens het aanpassen van het product in de database is iets fout gegaan.',
                'type' => 'danger'
            );
            // error list, we failed
            redirect("/backend/products/edit/" . $id);
            exit;
        }

        $_SESSION['notifications'][] = array(
            'message' => 'Het product is succcessvol aangepast',
            'type' => 'success'
        );

        // clear stored data
        clear_form_fields();

        redirect("/backend/products/edit/" . $id);
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        $product = $this->product->get_for_id($id);
        // display a corresponding notification
        if (!$product) {
            $_SESSION['notifications'][] = array(
                'message' => 'Dit product is niet gevonden',
                'type' => 'danger'
            );
            redirect("/backend/products");
            exit;
        }

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Product Verwijderen",
            "view" => "backend/products/remove",
            "product" => $product,
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    /**
     *
     */
    public function remove_confirm()
    {
        // check if ID is set from a form
        $id = $this->input->post("id");
        if (!$id) {
            // invalid request
            redirect("/backend/products");
            exit;
        }

        // attempt to remove the product
        $remove = $this->product->remove($id);

        // display a corresponding notification
        if ($remove) {
            $_SESSION['notifications'][] = array(
                'message' => 'Het product is successvol verwijderd',
                'type' => 'success'
            );
        } else {
            $_SESSION['notifications'][] = array(
                'message' => 'Het product is niet successvol verwijderd.',
                'type' => 'danger'
            );
        }
        redirect("/backend/products");
    }
}
