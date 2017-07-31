<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Test_model  extends CI_Model
{

    public function valid_username($str)
    {
        $this->load->library('form_validation');
        if ($str == 'test')
        {
            $this->form_validation->set_message('valid_username', 'The {field} field can not be the word "test"');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}