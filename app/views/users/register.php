<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
</head>
<body>
    <h1>Register</h1>
    <form action="/users" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" />
        <label for="email">Email</label>
        <input type="text" name="email" id="email" />
        <button type="submit" value="Register">Register</button>
    </form>
</body>
</html>