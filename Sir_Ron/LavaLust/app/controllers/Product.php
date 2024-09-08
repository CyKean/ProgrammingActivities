<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product extends Controller {

    private $notification;

    public function __construct(){
        parent::__construct();
        $this->notification = new Notification();
    }

    public function show(){
        $data = $this->db->raw('select * from products');
        $viewData = array(
            'products' => $data,
            'notifications' => $this->notification->getMessages()
        );

        // echo $this->db->row_count();
        $this->call->view('product', $viewData);
    }

    public function add(){
        $this->call->view('add');
    }


    public function insert(){
        $data = array(
            'product_name' => $_POST['product_name'],
            'product_description' => $_POST['product_description'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );

        $yey = $this->product_model->insertProduct($data);

        if($yey){
            $this->notification->setMessage('success', 'Product added successfully!');
        }else{
           $this->notification->setMessage('error', 'Error adding product.');
        }
        $this->call->view('product');
    }

    public function delete($id){

        if (!isset($id)) {
            echo 'ID not passed correctly';
            exit;
        }

        if ($this->product_model->deleteProduct($id)){
            $this->notification->setMessage('success', 'Product deleted successfully!');
            redirect('');
        } else {
            $this->notification->setMessage('error', 'Error deleting product.');
        }

        $this->call->view('product');
    }

    public function edit($id){
        $data['product'] = $this->product_model->getProductById($id);

        $this->call->view('edit', $data);
    }

    public function update($id){
        $data = array(
            'product_name' => $_POST['product_name'],
            'product_description' => $_POST['product_description'],
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );

        if ($this->product_model->updateProduct($id, $data)){
            $this->notification->setMessage('success', 'Product updated successfully!');
        } else {
            $this->notification->setMessage('error', 'Error updating product.');
        }

        $this->call->view('product');
    }
}

?>