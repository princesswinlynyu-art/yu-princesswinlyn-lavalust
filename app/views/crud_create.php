<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>

    <style>
        body{
            font-family: Arial;
            padding: 20px;
        }

        .container{
            width: 500px;
            margin: auto;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn{
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Add User</h1>

    <form action="/crud/store" method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Contact Number</label>
        <input type="text" name="contact_number" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit" class="btn">
            Save User
        </button>

    </form>

    <br>

    <a href="/crud" class="btn">Back</a>

</div>

</body>
</html>