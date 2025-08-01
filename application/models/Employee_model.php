<?php

class Employee_model extends CI_Model {

    public function getAll()
    {
        $user= $this->db->get("employees")->result();
         log_message('info', 'Employees fetched: ' . json_encode($user));
        return $user;
       
    }

   
    public function getEmployeeById($id)
    {
        log_message('info', "Fetching employee with ID: {$id}");
        $employee = $this->db->get_where('employees', ['id' => $id])->row();
        if ($employee) {
            log_message('info', "Employee with ID: {$id} found.");
        } else {
            log_message('warning', "Employee with ID: {$id} not found.");
        }
        return $employee;
    }

   
    public function getEmployeeByEmail($email)
    {
        log_message('info', "Fetching employee with Email: {$email}");
        $employee = $this->db->get_where('employees', ['email' => $email])->row();
        if ($employee) {
            log_message('info', "Employee with Email: {$email} found.");
        } else {
            log_message('warning', "Employee with Email: {$email} not found.");
        }
        return $employee;
    }

   
    public function insert($data)
    {
        if ($this->db->insert('employees', $data)) {
            log_message('info', 'New employee inserted successfully.');
            return true;
        } else {
            log_message('error', 'Failed to insert new employee.');
            return false;
        }
    }


    public function update($id, $data)
    {
        if ($this->db->update('employees', $data, ['id' => $id])) {
            log_message('info', "Employee with ID: {$id} updated successfully.");
            return true;
        } else {
            log_message('error', "Failed to update employee with ID: {$id}.");
            return false;
        }
    }

    
    public function delete($id)
    {
        if ($this->db->delete('employees', ['id' => $id])) {
            log_message('info', "Employee with ID: {$id} deleted successfully.");
            return true;
        } else {
            log_message('error', "Failed to delete employee with ID: {$id}.");
            return false;
        }
    }
}
