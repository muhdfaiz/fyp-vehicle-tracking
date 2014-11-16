<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Login extends CI_Controller
    {
        public function index()
        {
            if ($this->session->userdata('logged_in') == TRUE) {
                    redirect(base_url() . 'dashboard/admin_profile');
            } else
            {
                $this->load->library('form_validation');
                // Displaying Errors in Div
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                // Validation for E-mail field.
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
                // Validation for Password Field
                $this->form_validation->set_rules('password', 'Password ', 'required|min_length[6]|max_length[30]');

                if($this->form_validation->run() == FALSE)
                {
                    $this->load->view("login_view");
                }
                else
                {
                    $this->load->model('login_model');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $query = $this->login_model->verify_login($email);

                    if($query->num_rows() ==1 )
                    {
                        // One Matching Row Found
                        foreach ($query->result() as $row) {
                            // Call Encrypt library
                            $this->load->library('encrypt');
                            // Generate hash from a their password
                            $hash = $this->encrypt->sha1($password);
                            // Compare the generated hash with that in the
                            // database
                            if ($hash != $row->hash) {
                                // Didn't match so send back to login
                                $login_failed['login_fail'] = true;
                                $this->load->view("login_view", $login_failed);
                            } else
                            {
                                $data = array(
                                    'admin_id' => $row->admin_id,
                                    'user_email' => $row->email,
                                    'logged_in' => TRUE
                                );
                                // Save data to session
                                $this->session->set_userdata($data);
                                redirect(base_url() . 'dashboard/admin_profile');
                            }
                        }
                    }
                }
            }
        }

        function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url(). 'login');
        }
    }