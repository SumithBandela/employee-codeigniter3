<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Employee extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['employees'] = $this->Employee_model->getAll();
        $this->load->view('employee_list', $data);
    }

    public function create()
    {
        $this->load->view('employee_form');
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[employees.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');

        if($this->form_validation->run() == FALSE)
        {
            return $this->load->view('employee_form');
        }
        else
        {
            $data = $this->input->post();
            $this->Employee_model->insert($data);
            $this->session->set_flashdata('success', 'Employee created successfully');
            redirect('employee');
        }
    }

    public function edit($id)
    {
        $data = $this->Employee_model->getEmployeeById($id);
        if (!$data)
        {
            show_404();
        }
        else
        {
            $this->load->view('employee_form', ['employee' => $data]);
        }
    }

    public function update($id)
    {
        $employee = $this->Employee_model->getEmployeeById($id);
        if (!$employee)
        {
            show_404();
        }
        else
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('designation', 'Designation', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                return $this->load->view('employee_form', $employee);
            }
            else
            {
                $data = $this->input->post();
                $this->Employee_model->update($id, $data);
                $this->session->set_flashdata('success', 'Employee updated successfully');
                redirect('employee');
            }
        }
    }

    public function delete($id)
    {
        $employee = $this->Employee_model->getEmployeeById($id);
        if (!$employee)
        {
            show_404();
        }

        $this->Employee_model->delete($id);
        $this->session->set_flashdata('success', 'Employee deleted successfully');
        redirect('employee');
    }
}
