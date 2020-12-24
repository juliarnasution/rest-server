<?php

/**
 * @Author: juliarnasution
 * @Date:   2020-11-24 19:00:19
 * @Last Modified by:   Dell
 * @Last Modified time: 2020-12-24 16:48:19
 */
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Api extends RestController {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function users_get()
    {
        // Users from a data store e.g. database
        // $users = [
        //     ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
        //     ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        // ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            $users = $this->user_model->get();
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            $user = $this->user_model->users($id);
            if ($user)
            {
                $this->response( $user, 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
