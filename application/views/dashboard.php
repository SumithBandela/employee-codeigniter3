<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body text-center">
            <h2>Welcome to Dashboard</h2>
            <p>Hello, <?php echo $this->session->userdata('username'); ?>!</p>

            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
