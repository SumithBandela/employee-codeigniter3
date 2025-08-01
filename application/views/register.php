<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

   <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
     <form method="post" action="<?= site_url('auth/register_action') ?>" class="m-5 p-4 border border-2 w-25" >
            <h2>User Registration</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red"><?= $this->session->flashdata('error') ?></p>
    <?php endif; ?>

        <dl>
            <dt>Username</dt>
            <dd><input type="text" name="username" placeholder="Username" required class="form-control"></dd>
            <dt>Password</dt>
            <dd><input type="password" name="password" placeholder="Password" required class="form-control"></dd>
        </dl>
        <button type="submit" class="btn btn-primary w-100">Register</button>
        <div class="mt-2 text-center"> 
             <p>Already registered? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
        </div>
    </form>
   </div>

   
</body>
</html>
