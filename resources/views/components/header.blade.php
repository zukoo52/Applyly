<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <style>
        nav {
            background-color: #2c3e50;
            padding: 10px 20px;
            display: flex;
            justify-content: start;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #34495e;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/jobs">Jobs</a>
    <a href="/jobs/create">Create Job</a>
</nav>

</body>
</html>
