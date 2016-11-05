<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Event_model extends MY_model {
 
    function __construct()
    {
        parent::__construct();
    }

    // create event place
    public function create($data)
    {
        //Insert into account database
        if($this->db->insert('event_places', $data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    // create event place
    public function create_event($data)
    {
        //Insert into account database
        if($this->db->insert('events', $data))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function get_all_event_places()
    {
        $query = $this->db->get('event_places');
        return $query->result();
    }

    public function get_all_events()
    {
        $query = $this->db->get('events');
        return $query->result();
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

    public function get_event_location_by_id($location_id)
    {
        $query = $this->db->get_where('event_places', array('id' => $location_id));
        // echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message().'<br>';
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