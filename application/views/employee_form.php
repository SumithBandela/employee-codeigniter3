<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($employee) ? 'Edit' : 'Add'; ?> Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</head>
<body>

    <div class="d-flex justify-content-center">
        <!-- Set the action attribute based on whether we're adding or editing -->
        <form method="post" action="<?php echo isset($employee) ? site_url('employee/update/'.$employee->id) : site_url('employee/store'); ?>" class="w-25 border border-2 m-4 p-4">
            <h2 class="text-success text-center"><?php echo isset($employee) ? 'Edit' : 'Add'; ?> Employee</h2>
    
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="<?php echo isset($employee) ? $employee->name : ''; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="<?php echo isset($employee) ? $employee->email : ''; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo isset($employee) ? $employee->phone : ''; ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" id="designation" value="<?php echo isset($employee) ? $employee->designation : ''; ?>" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100"><?php echo isset($employee) ? 'Update' : 'Save'; ?></button>
            <a href="<?php echo site_url('employee'); ?>" class="mt-2 text-center d-block">Back to Employees</a>
        </form>
    </div>
</body>
</html>
