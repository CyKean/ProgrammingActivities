<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class user_model extends Model {
    private $notification;
   
    public function __construct(){
        parent::__construct();
        $this->notification = new Notification();
    }

    public function insertUser($data){
       $yey = $this->db->table('crp_users')->insert($data);

        
       if($yey){
        $this->notification->setMessage('success', 'User added successfully!');
        redirect('');
        }else{
        $this->notification->setMessage('error', 'Error adding user.');
        }
    }

    public function deleteUser($id){
        $yey = $this->db->table('crp_users')->where(array('id' => $id))->delete();

        if($yey){
            $this->notification->setMessage('success', 'User deleted successfully!');
            redirect('');
        }else{
            $this->notification->setMessage('error', 'Error deleting user.');
        }
    }

    public function getUserByid($id){
        return $this->db->table('crp_users')->where(array('id' => $id))->get();
       
    }

    public function updateUser($id, $data){
        $yey = $this->db->table('crp_users')->where('id', $id)->update($data);
        if($yey){
            $this->notification->setMessage('success', 'User updated successfully!');
            redirect('');
        }else{
            $this->notification->setMessage('error', 'Error updating user.');
        }
    }

    public function searchUser($query){
        $yey = $this->db->raw("select * from crp_users where crp_last_name like '%$query%'");
        if($yey){
            // $this->notification->setMessage('success', 'User searched successfully!');
            redirect('search');
        }else{
            $this->notification->setMessage('error', 'Searching user unsuccessful.');
        }

    }

  
}

?>