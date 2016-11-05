<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Login_model extends MY_model {
 
    function __construct()
    {
        parent::__construct();
    }

    public function validate_user($email, $password) 
    {
        //Query database for match case
        $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'active' => 1), 1);

        //Check if returned any result
        if($query->num_rows() == 1) 
        {
            //If there is a user, Then create a session data
            $row = $query->row();

            $data = array(
                'id'    => $row->id,
                'email' => $row->email,
            );

            //Create session and hold the above information
            $this->session->set_userdata($data);

            return TRUE;
        }
        else {
            //If the previous process did not validate, then return false
            return FALSE;
        }
            
    }

    //save the last logged in time of user
    public function set_last_logged_in($email)
    {
        //Load date helper class for the use of "now()"
        //$this->load->helper('date');
        $date = date('Y-m-d H:i:s');
        $this->db->where('email', $email);
        $this->db->update( 'users', array('date_last_login' => $date ) );
    }

    //get the last logged in time of user
    public function get_last_logged_in($email)
    {
        $this->db->select('date_last_login');
        $this->db->get_where('users', array('email' => $email) );
        $result = $this->row();

        return $result;
    }

    //New account creation
    public function create_account($data)
    {
        //Insert into account database
        if($this->db->insert('users', $data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Function to check if user is logged in
    public function update_password($password, $email)
    {
        if($this->db->update('users', $password, array('email' => $email) ))
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }

    //Check if a email exist
    public function check_email($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if($query->num_rows == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    } 
       

    public function get_user_data($userid)
    {
        $query = $this->db->get_where('users', array('id' => $userid, 'active' => 1));
        $row = $query->row();

        return $row ;
    }

    public function get_name_by_email($email)
    {
        $this->db->select('id, first_name, last_name')->from('gc_agents')->where('email', $email)->limit(1);
        $query = $this->db->get();

        return $query->row();
    }

    // edit single data for profile
    public function edit_profile($id)
    {
        $query = $this->db->get_where('gc_agents', array('id' => $id));
        // echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message().'<br>';
        return $query->row();
    }

    // update single data for profile
    public function update_profile($data, $id)
    {
        if($this->db->update('gc_agents', $data,  'id = '.$id))
        {
            return TRUE;
        }
        else
        {
            // echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message().'<br>';
            return FALSE;
        }
    }


}