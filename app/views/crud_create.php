<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>

    <style>
        body{
            font-family:Arial;
            padding:20px;
        }

        input{
            width:300px;
            padding:10px;
            margin:5px 0;
        }

        button{
            padding:10px 15px;
        }
    </style>
</head>
<body>

<h1>Add User</h1>

<form method="POST" action="/LavaLust/public/crud/store">

    <p>
        Name<br>
        <input type="text" name="name" required>
    </p>

    <p>
        Contact Number<br>
        <input type="text" name="contact_number" required>
    </p>

    <p>
        Email<br>
        <input type="email" name="email" required>
    </p>

    <button type="submit">
        Save User
    </button>

</form>

<br>

<a href="/LavaLust/public/crud">
    Back
</a>

</body>
</html>