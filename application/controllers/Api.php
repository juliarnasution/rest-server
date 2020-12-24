<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
/**
 * @Author: juliarnasution
 * @Date:   2020-12-24 15:42:30
 * @Last Modified by:   Dell
 * @Last Modified time: 2020-12-24 17:30:39
 */

class Api extends RestController {
	
	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('user_model','user');
    }

    public function responseData($data = [],$status= false)
    {
    	return array(
    		'status'=> $status,
    		'data' => $data
    	);
    }
    
    public function users_get()
    {
        $id = $this->get( 'userid' );

        if ( $id === null )
        {
            $users = $this->user->get();
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $this->responseData($users, true), RestController::HTTP_OK);
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], RestController::HTTP_NOT_FOUND );
            }
        }
        else
        {
            $user = $this->user->get($id);
            if ($user)
            {
                $this->response($this->responseData($user, true), RestController::HTTP_OK );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], RestController::HTTP_NOT_FOUND );
            }
        }
    }

    public function users_post()
    {
    	$data = array(
    		'userid' => $this->post('userid'),
    		'namalengkap'=>$this->post('namalengkap'),
    		'email'=>$this->post('email'),
    		'username'=>$this->post('username'),
    		'password'=>$this->post('password'),
    		'created_at'=> date('Y-m-d H:i:s')
    	);

    	if ($this->user->add($data)) {
    		$this->response( [
                    'status' => true,
                    'message' => 'New data has been inserted'
                ], RestController::HTTP_CREATED );
    	}else{
    		$this->response( [
                    'status' => false,
                    'message' => 'Failed to insert data'
                ], RestController::HTTP_BAD_REQUEST);
    	}
    }

    public function users_put()
    {
    	$id= $this->put('userid');
    	if (!$id) {
    		$this->response( [
                    'status' => false,
                    'message' => 'Id Not Found '
                ], RestController::HTTP_BAD_REQUEST );
    	}
    	
    	$data = array(
    		'namalengkap'=>$this->put('namalengkap'),
    		'email'=>$this->put('email'),
    		'username'=>$this->put('username'),
    		'password'=>$this->put('password'),
    		'updated_at'=> date('Y-m-d H:i:s')
    	);
    	if ($this->user->update($id,$data)) {
    	 	$this->response( [
                    'status' => true,
                    'message' => 'Data has been updated, id '.$id
                ], RestController::HTTP_CREATED );
    	 }else{
    	 	$this->response( [
                    'status' => false,
                    'message' => 'Failed to update data, id '.$id
                ], RestController::HTTP_BAD_REQUEST);
    	 }
    }

    public function users_delete()
    {
    	$id = $this->delete('userid');
    	if (!$id) {
    		$this->response( [
                    'status' => false,
                    'message' => 'Id Not Found '
                ], RestController::HTTP_BAD_REQUEST );
    	}
    	if ($this->user->delete($id)) {
    		$this->response( [
                    'status' => true,
                    'message' => 'Data has been deleted, id '.$id
                ], RestController::HTTP_OK );
    	}else{
    		$this->response( [
                    'status' => false,
                    'message' => 'Failed to delete data, id '.$id
                ], RestController::HTTP_BAD_REQUEST );
    	}
    }
}
/* End of file User.php */
/* Location: ./application/controllers/User.php */
