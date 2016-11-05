<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends REST_Controller {

	function __construct()
    {
        parent::__construct();

        // load event model
        $this->load->model('backend/Event_model');
    }

	public function eventList_get()
	{
		if(! $this->get('id'))
	    {
	    	$place = $this->Event_model->get_all_event_places(); // return all record
	    	// var_dump($place);
	    }
	    else 
	    {
	        $place = $this->Event_model->get_event_location_by_id($this->get('id')); // return a record based on id
	        // var_dump($place);
	    }
	 
	    if($place)
	    {
	        $this->response($place, 200); // return success code if record exist
	    } else {
	        $this->response([], 404); // return empty
	    }
	}
	
}
