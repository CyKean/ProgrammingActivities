<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class product_model extends Model {
    private $notification;
   
    public function __construct(){
        parent::__construct();
        $this->notification = new Notification();
    }

    public function getProduct($data){
        // $data = $this->db->table('products')->get();
        // return $data;
        $data = $this->db->raw('select * from products');
        foreach($data as $row) {
            echo $row['id'];
            echo $row['product_name'];
            echo $row['product_description'];
            echo $row['product_price'];
            echo $row['product_quantity'];
        }

        echo $this->db->row_count();
    }

    public function insertProduct($data){
       $yey = $this->db->table('products')->insert($data);

        
       if($yey){
        $this->notification->setMessage('success', 'Product added successfully!');
        redirect('');
        }else{
        $this->notification->setMessage('error', 'Error adding product.');
        }
    }

    public function deleteProduct($id){
        $yey = $this->db->table('products')->where(array('id' => $id))->delete();

        if($yey){
            $this->notification->setMessage('success', 'Product deleted successfully!');
            redirect('');
        }else{
            $this->notification->setMessage('error', 'Error deleting product.');
        }
    }

    public function getProductByid($id){
        // return $this->db->row('select * from products where id = ?', array($id));
        return $this->db->table('products')->where(array('id' => $id))->get();
       
    }

    public function updateProduct($id, $data){
        // return $this->db->update('products', $data, ['id' => $id]);
        $yey = $this->db->table('products')->where('id', $id)->update($data);
        if($yey){
            $this->notification->setMessage('success', 'Product updated successfully!');
            redirect('');
        }else{
            $this->notification->setMessage('error', 'Error updating product.');
        }
    }
}

?>