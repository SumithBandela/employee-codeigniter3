<?php

defined("BASEPATH") OR exit("No direct script access allowed");
use Mpdf\Mpdf;  
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Employee extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
        $this->load->library('form_validation');
        $this->load->helper('url');
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
   
    public function download_excel() {
        $employees = $this->db->get('employees')->result();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Phone');
        $sheet->setCellValue('D1', 'Designation');

        $row = 2;
        foreach ($employees as $emp) {
            $sheet->setCellValue('A' . $row, $emp->name);
            $sheet->setCellValue('B' . $row, $emp->email);
            $sheet->setCellValue('C' . $row, $emp->phone);
            $sheet->setCellValue('D' . $row, $emp->designation);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="employees.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

   
    public function download_pdf() {
        $employees = $this->db->get('employees')->result();

        $html = '<h2>Employee List</h2><table border="1" cellpadding="5">
                    <tr><th>Name</th><th>Email</th><th>Phone</th><th>Designation</th></tr>';

        foreach ($employees as $emp) {
            $html .= "<tr>
                        <td>{$emp->name}</td>
                        <td>{$emp->email}</td>
                        <td>{$emp->phone}</td>
                        <td>{$emp->designation}</td>
                      </tr>";
        }
        $html .= '</table>';

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('employees.pdf', 'D'); 
    }
}
