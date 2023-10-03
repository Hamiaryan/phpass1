<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>
    
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 140%;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

       
        h1 {
            text-align: center;
            margin: 20px 0;
        }

       
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .logo img {
            max-width: 100px;
            height: auto;
            vertical-align: middle;
            margin-right: 10px;
        }

        .search {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 10px auto;
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

      
        .search input[type="text"],
        .search input[type="submit"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 100%;
        }

     
        .search input[type="text"]:hover,
        .search input[type="submit"]:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #333;
            color: #fff;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        
        }      
      
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

       
        td {
            padding: 8px;
            border-bottom: 1px solid #ccc; 
        }

       
        footer {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Asset/logo.png" alt="Company Logo">
            <h1>Hamed IT LTD.</h1>
        </div>
    </header>

   
    <div class="search">
        <h1>Search for Employee</h1>
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Enter employee name or ID">
            <input type="submit" name="submit" value="Search">
        </form>
    </div>

    <?php
    // PHP code 
    require_once("database.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "";
    }

    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        // Modify  SQL query to search f
        $sql = "SELECT * FROM `Employees` WHERE 
                `employee_id` LIKE '%$search%' OR 
                `first_name` LIKE '%$search%' OR 
                `last_name` LIKE '%$search%'";

    } else {
        // If no search term 
        $sql = "SELECT * FROM `Employees`";
    }

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        // Display the search results
       
        echo "<table>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Email</th>";
        echo "<th>Telephone</th>";
        echo "<th>Department</th>";
        echo "<th>Salary per Time</th>";
        echo "<th>Hours per Month</th>";
        echo "<th>Monthly Salary</th>";
        echo "<th>Yearly Salary</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['employee_id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telephone'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['salary_per_time'] . "</td>";
            echo "<td>" . $row['hours_per_month'] . "</td>";
            echo "<td>" . $row['monthly_salary'] . "</td>";
            echo "<td>" . $row['yearly_salary'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No matching employees found.";
    }

    mysqli_close($conn);
    ?>

    <footer>
        &copy; Hamed IT LTD. All Rights Reserved.
    </footer>
</body>
</html>
