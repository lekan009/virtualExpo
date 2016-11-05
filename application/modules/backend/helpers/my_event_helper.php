<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_event_place_by_id($id) 
{
	//Create an instance of CI
	$CI =& get_instance();

	$CI->load->model('Event_model');

	return $CI->Event_model->get_event_location_by_id($id);
}