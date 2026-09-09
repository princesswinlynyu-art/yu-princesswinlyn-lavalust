<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <style>
        body{
            font-family:Arial;
            padding:20px;
        }

        input{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        .btn{
            padding:10px;
            background:#3498db;
            color:white;
            border:none;
            text-decoration:none;
        }
    </style>
</head>
<body>

<h1>Edit User</h1>

<form action="<?= site_url('crud/update/' . $user['id']); ?>" method="POST">

    <label>Name</label>
    <input type="text"
           name="name"
           value="<?= $user['name']; ?>"
           required>

    <label>Contact Number</label>
    <input type="text"
           name="contact_number"
           value="<?= $user['contact_number']; ?>"
           required>

    <label>Email</label>
    <input type="email"
           name="email"
           value="<?= $user['email']; ?>"
           required>

    <button type="submit" class="btn">
        Update User
    </button>

</form>

<br>

<a class="btn" href="<?= site_url('crud'); ?>">
    Back
</a>

</body>
</html>