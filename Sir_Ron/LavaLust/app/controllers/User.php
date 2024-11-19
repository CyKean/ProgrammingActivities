<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {

    private $notification;

    public function __construct(){
        parent::__construct();
        $this->notification = new Notification();
    }

    public function show(){        
        $limit = 5;

        $total_records = $this->db->raw('select count(*) as total from crp_users')[0]['total'];
        $total_pages = ceil($total_records / $limit);

        $page = (isset($_GET['page']) && $_GET['page'] > 0)? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $data = $this->db->raw("select * from crp_users limit $limit offset $offset");
        $viewData = array(
            'users' => $data,
            'notifications' => $this->notification->getMessages(),
            'total_pages' => $total_pages,
            'current_page' => $page,
            'limit' => $limit
        );
        $this->call->view('user', $viewData);
    }

    public function add(){
        $this->call->view('add');
    }


    public function insert(){
        $data = array(
            'crp_last_name' => $_POST['last_name'],
            'crp_first_name' => $_POST['first_name'],
            'crp_email' => $_POST['email'],
            'crp_gender' => $_POST['gender'],
            'crp_address' => $_POST['address']
        );

        $yey = $this->user_model->insertUser($data);

        if($yey){
            $this->notification->setMessage('success', 'Product added successfully!');
        }else{
           $this->notification->setMessage('error', 'Error adding product.');
        }
        $this->call->view('user');
    }

    public function delete($id){

        if (!isset($id)) {
            echo 'ID not passed correctly';
            exit;
        }

        if ($this->user_model->deleteUser($id)){
            $this->notification->setMessage('success', 'Product deleted successfully!');
            redirect('');
        } else {
            $this->notification->setMessage('error', 'Error deleting product.');
        }

        $this->call->view('user');
    }

    public function edit($id){
        $data['user'] = $this->user_model->getUserById($id);

        $this->call->view('edit', $data);
    }

    public function update($id){
        $data = array(
            'crp_last_name' => $_POST['last_name'],
            'crp_first_name' => $_POST['first_name'],
            'crp_email' => $_POST['email'],
            'crp_gender' => $_POST['gender'],
            'crp_address' => $_POST['address']
        );

        if ($this->user_model->updateUser($id, $data)){
            $this->notification->setMessage('success', 'Product updated successfully!');
        } else {
            $this->notification->setMessage('error', 'Error updating product.');
        }

        $this->call->view('user');

    }

    public function search(){
        $limit = 5;
        $query = isset($_POST['query']) ? $_POST['query'] : '';
        
        // Check if the query exactly matches 'male' or 'female' for gender
        $genderFilter = "";
        if (strtolower($query) === 'male' || strtolower($query) === 'female') {
            $genderFilter = " OR crp_gender = '$query'";
        }
        
        $total_records_query = "
            SELECT COUNT(*) as total 
            FROM crp_users 
            WHERE 
                CONCAT_WS(' ', id, crp_last_name, crp_first_name, crp_email, crp_address) LIKE '%$query%' 
                $genderFilter
        ";
        $total_records = $this->db->raw($total_records_query)[0]['total'];
        $total_pages = ceil($total_records / $limit);
        
        $page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        $search_query = "
            SELECT * 
            FROM crp_users 
            WHERE 
                CONCAT_WS(' ', id, crp_last_name, crp_first_name, crp_email, crp_address) LIKE '%$query%' 
                $genderFilter
            LIMIT $limit OFFSET $offset
        ";
        $result = $this->db->raw($search_query);
        
        $viewData = array(
            'result' => $result,
            'notifications' => $this->notification->getMessages(),
            'total_pages' => $total_pages,
            'current_page' => $page,
            'limit' => $limit
        );
        
        $this->call->view('result', $viewData);
        
       
    }
    
}

?>