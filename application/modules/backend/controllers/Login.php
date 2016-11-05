<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load session library
		$this->load->library('session');

		// Load form validation library
        $this->load->library('form_validation');

        // Form validation MX Hack
        $this->form_validation->CI =& $this;

        $this->load->model('Login_model');
	}

	public function index()
	{
		// Set error to null
		$data['display_message'] = '';
		$data['page_title'] = 'Backend - Login';

		// save the redirect_back data from referral url (where user first was prior to login)
		// Check if the user is logged in, redirect to member area
		if( $this->is_logged_in() )
		{
			redirect(site_url('backoffice') );
		}
		else {
			// Add more security to the password
			$salt = $this->config->item('salt');

	        //Grab username and password from form using the CI Security class
	        $clean_email = strtolower($this->input->post('txtEmail', TRUE) );
	        $clean_pass  = $this->input->post('txtPassword', TRUE);

	        // encrypt password
	        $clean_pass = hash('SHA256', $salt.$clean_pass);

			// Check validation for user input in login form
			$this->form_validation->set_rules('txtEmail', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('txtPassword', 'password', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				//Load login view to be displayed to user
				$this->load->view('login', $data);
			}
			else
			{
				// Validate user can login
				if($this->Login_model->validate_user($clean_email, $clean_pass))
				{
					// update last login
					$this->Login_model->set_last_logged_in($clean_email);

					// Redirect to previous page
                    $this->_login_redirect();
				}
				else
				{
					$data['display_message'] = 'Invalid login details';
					$this->load->view('login', $data);
				}
			}
		}
	}

	// check if user is logged in
    public function is_logged_in()
    {
        if( $this->session->userdata('email') ) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }

	// Redirect to last url
	private function _login_redirect()
	{
		// grab value and put into a temp variable so we unset the session value
		$forward = $this->input->post('forward');
		$forward_uri = urldecode($forward);

		// user is authenticated, lets see if there is a redirect:
		if( $forward AND $forward_uri != ('backoffice') AND $forward_uri != ('backoffice/login') ) 
		{
			redirect($forward_uri);
		}
	    // no redirect goto dashboard
        else
        {
            redirect('backoffice') ;
        }
    }

    // Password reset
	public function passwordreset()
	{
		// Set error to null
		$data['display_message'] = '';
		$data['page_title'] = 'GETCentre Agent Backend - Password Reset';

		// Check if the user is logged in, redirect to member area
		if( $this->is_logged_in() )
		{
			redirect('backoffice');
		}
		else
		{
			$clean_email = strtolower( $clean_email = $this->security->xss_clean($this->input->post('txtEmail')) );

			// Check if email is present in the databse
			$this->form_validation->set_rules('txtEmail', 'email', 'trim|required|valid_email|callback_check_reset_email');
			if ($this->form_validation->run() == FALSE) 
			{
				//Load page again if validation fails
				$this->load->view('login', $data);
			}
			else
			{
				//Generate a new password
				$new_password = $this->makeRandomPassword();

				//Add more security to the password
				$salt = $this->config->item('salt');
				// Password hash
				$password = hash('SHA256', $salt.$new_password);

				//hold new password for update process
				$data = array('password' => $password);

				//update password in user table
				$result = $this->Login_model->update_password($data, $clean_email);

				//Check result status
				if($result)
				{
					//send new password to user
					// send_mail('password-reset', $clean_email, $new_password);
					//success message
					$data['display_message'] = '<p class="alert alert-success">Your password hase been sent to <i>'.$clean_email.$password.' </i></p>';
					$this->load->view('login', $data);
				}
				else
				{
					//error message
					$data['display_message'] = '<p class="alert alert-danger"> Email does not exist, please try again with a valid email </p>';
					$this->load->view('login', $data);
				}
			}
		}
	}

	//Generate random password for reset purpose
	private function makeRandomPassword() 
	{
		$pass = '';
          $salt = "abchefghjkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-+=_,!@$#*%<>[]{}0123456789"; 
          $i = 0; 
          while ($i <= 10) { 
                $num = rand() % 77; 
                $tmp = substr($salt, $num, 1); 
   		            $pass = $pass . $tmp; 
                $i++; 
          }
          return $pass; 
    }

	// Callback to check if email is present in database
	public function check_reset_email($email)
	{
		if( $this->Login_model->check_email($email) )
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_reset_email', 'Email does not exist, please try again');
			return FALSE;
		}
	}

	// Logout
	public function logout()
	{
		if ($this->is_logged_in()) 
		{
			// Remove data from session 
			$data = array(
	                'id'        => '',
	                'email'     => '',
	                'name' => '',
	                );

			// $this->session->unset_userdata($data);

			$this->session->sess_destroy();
			//$data['display_message'] = 'Successfully Logout';
			//$this->load->view('login', $data);
			redirect('backoffice/login');
		}
		else
		{
			redirect('backoffice/login');
		}
	}

	// Debug
	public function debug()
	{
		var_dump( print_r($this->session->all_userdata()) );
	}
}