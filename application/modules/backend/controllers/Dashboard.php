<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// required to load admin components
require APPPATH . 'modules/backend/libraries/Backend_Controller.php';

class Dashboard extends Backend_controller
{
	function __construct()
	{
		parent::__construct();

		// load upload library
		$this->load->library('upload');

		// load event helper
		$this->load->helper('my_event');

		// Form validation MX Hack
        $this->form_validation->CI =& $this;

        // global error format
        $this->form_validation->set_error_delimiters('<div class="animated alert alert-danger fadeIn">','</div>');

        // load services model
        $this->load->model('Event_model');
	}

	// Load dashboard
	public function index()
	{
		// pass data to view
		$data['page_title'] = 'Backend - Home';
		// Load view
		$this->load->view('backend/dashboard', $data);
	}
	public function event()
	{
		// pass data to view
		$data['page_title'] = 'Backend - Create Event Centre';

		$data['display_message'] = '';

		// get input from text field
        $event_place 	  = $this->input->post('txtEventPlace', TRUE);
        $event_location   = $this->input->post('txtEventLocation', TRUE);
        $location_lat 	  = $this->input->post('txtLocationLat', TRUE);
        $location_long 	  = $this->input->post('txtLocationLong', TRUE);

        // upload parameters
        $config['upload_path']	  = 'assets/images/';
        $config['file_name']	  = $event_place.time();
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']		  = '500';

		$this->upload->initialize($config);

		// validate input
		$this->form_validation->set_rules('txtEventPlace', 'Event Place Name', 'trim|required');
		$this->form_validation->set_rules('txtEventLocation', 'Event Place Location', 'trim|required');
		$this->form_validation->set_rules('txtLocationLat', 'Event Place Latitude', 'trim|required|numeric');
		$this->form_validation->set_rules('txtLocationLong', 'Event Place Longtitude', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
		{
			// load view to be displayed to user
			$this->load->view('event', $data);
		}

		// upload validation
        elseif ( ! $this->upload->do_upload('image') )
        {
        	// display error
            $error_msg = $this->upload->display_errors('<div class="animated alert alert-danger fadeIn">','</div>');

            // load view
            $this->session->set_flashdata('display_message', $error_msg);
			redirect('backoffice/event');
        }

		else
		{
			// get uploaded data file name
			$file_name = $this->upload->data('file_name');

			// prepare data for db insert 
			$details = array(
				'event_place_name'		=> $event_place,
		        'event_place_location'	=> $event_location,
		        'latitude'				=> $location_lat,
		        'longtitude'			=> $location_long,
		        'image'					=> $file_name

		    );

			$result = $this->Event_model->create($details);

			// check result status
			if($result)
			{
				// redirect and send a success message
				$this->session->set_flashdata('display_message', '<p class="alert alert-success"> Your record has been added </p>');
				redirect('backoffice/event');
			}
			else
			{
				// redirect and send a failure message
				$this->session->set_flashdata('display_message', '<p class="alert alert-danger"> Could not create record at this time, please try again </p>');
				redirect('backoffice/event');
			}
		}
	}
	public function list_places()
	{
		$data['page_title'] = 'Backend - View Event Centres';

		$data['display_message'] = '';

		$data['event_places'] = $this->Event_model->get_all_event_places();

        if( $data['event_places'] )
        {
            $this->load->view('event_places', $data); ;
        }
        else
        {
        	$data['display_message'] = 'No records found';
            $this->load->view('event_places', $data);
        }
	}
	public function create_event()
	{
		$data['page_title'] = 'Backend - View Event Centres';

		$data['display_message'] = '';

		$data['event_places']   = $this->get_event_lists();

		$data['events'] = $this->Event_model->get_all_events();

		// get input from text field
        $event_title 	  = $this->input->post('txtEventTitle', TRUE);
        $event_place      = $this->input->post('txtEventPlace', TRUE);
        $event_date 	  = $this->input->post('daterange', TRUE);

        // validate input
		$this->form_validation->set_rules('txtEventTitle', 'Event Title', 'trim|required');
		$this->form_validation->set_rules('txtEventPlace', 'Event Place', 'trim|required');
		$this->form_validation->set_rules('daterange', 'Event Date', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			// load view to be displayed to user
			$this->load->view('expo', $data);
		}
		else
		{
			// prepare data for db insert 
			$details = array(
		        'event_place_id'	=> $event_place,
		        'event_title'		=> $event_title,
		        'event_date'		=> $event_date
		    );

			$result = $this->Event_model->create_event($details);

			// check result status
			if($result)
			{
				// redirect and send a success message
				$this->session->set_flashdata('display_message', '<p class="alert alert-success"> Your record has been added </p>');
				redirect('backoffice/event/create');
			}
			else
			{
				// redirect and send a failure message
				$this->session->set_flashdata('display_message', '<p class="alert alert-danger"> Could not create record at this time, please try again </p>');
				redirect('backoffice/event/create');
			}
		}
	}

	// Create select option for brands
    public function get_event_lists() 
    {
        $event_list = $this->Event_model->get_all_event_places();

        $category_option = array('' => 'Please select an event centre') ;

        if( $event_list ) {
            foreach ($event_list as $places) {
                $category_option[$places->id] = $places->event_place_name;
            }
        }

        return $category_option ;
    }
	public function reservation()
	{
		// pass data to view
		$data['page_title'] = 'Backend - Manage Reservations';
		// Load view
		$this->load->view('backend/reservation', $data);
	}
}