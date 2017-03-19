<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends Sessioned_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("category");
    }

    public function index()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Categorieën",
            "view" => "backend/categories/overview",
            "categories" => $this->category->get_categories(),
        ));
    }

    public function add()
    {
        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Categorie Toevoegen",
            "view" => "backend/categories/add",
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    public function add_save()
    {
        $title = $this->input->post("title");
        $url = $this->input->post("url");
        $description = $this->input->post("description");

        $add = $this->category->add($title, $url, $description);

        redirect("/backend/categories/");
    }

    public function edit($id)
    {
        // Get category
        $category = $this->category->get_by_id($id);

        if (!is_array($category)) {
            show_error("Couldn't find category");
        }

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Categorie Bewerken",
            "view" => "backend/categories/edit",
            "category" => $category,
            "csrf" => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        ));
    }

    public function edit_save()
    {
        $id = $this->input->post("id");
        $title = $this->input->post("title");
        $url = $this->input->post("url");
        $description = $this->input->post("description");

        $edit = $this->category->edit($id, $title, $url, $description);

        redirect("/backend/categories/");
    }


    /**
     * @param $id
     */
    public function remove($id)
    {
        $category = $this->category->get_by_id($id);
        // display a corresponding notification
        if (!$category) {
            $_SESSION['notifications'][] = array(
                'message' => 'Deze categorie is niet gevonden',
                'type' => 'danger'
            );
            redirect("/backend/categories");
            exit;
        }

        // Load view
        $this->load->view("backend/template", array(
            "page_title" => "Categorie Verwijderen",
            "view" => "backend/categories/remove",
            "category" => $category,
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
        if ($id) {
            // attempt to remove the product
            $remove = $this->category->remove($id);

            // display a corresponding notification
            if ($remove) {
                $_SESSION['notifications'][] = array(
                    'message' => 'De categorie is successvol verwijderd',
                    'type' => 'success'
                );
            } else {
                $_SESSION['notifications'][] = array(
                    'message' => 'De categorie is niet successvol verwijderd.',
                    'type' => 'danger'
                );
            }
        }
        redirect("/backend/categories");
    }
}
