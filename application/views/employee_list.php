<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>
   <div class="container mt-5">
     <h2>Employees</h2>
    <a href="<?php echo site_url('employee/create')?>" class="btn btn-primary m-2 ms-0">Add Employee</a>
    <a href="<?= site_url('employee/download_excel') ?>" class="btn btn-success">Download Excel</a> 
    <a href="<?= site_url('employee/download_pdf')?>" class="btn btn-danger">Download PDF</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp) { ?>
                <tr>
                    <td><?=$emp->name?></td>
                    <td><?=$emp->email?></td>
                    <td><?=$emp->phone?></td>
                    <td><?=$emp->designation?></td>
                    <td>
                        <a href="<?php echo site_url('employee/edit/'.$emp->id); ?>" class="btn btn-primary">edit</a>
                        <a href="<?php echo site_url('employee/delete/'.$emp->id);?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
   </div>
</body>
</html>
