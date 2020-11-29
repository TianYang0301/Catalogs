<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php

    // TODO 1: Create short variable names.

    $searchtype;
    $searchterm;

    // TODO 2: Check and filter data coming from the user.

    $searchtype = $_POST["searchtype"];
    $searchterm = $_POST["searchterm"];

    // TODO 3: Setup a connection to the appropriate database.

    $hn = "localhost";
    $un = "root";
    $pw = "";
    $db = "book";
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error){
       die ("Fatal Error");
    }

    // TODO 4: Query the database.
 
    $query="SELECT * FROM catalogs WHERE ".$searchtype." = '$searchterm' ";
        $result = $conn->query($query);
        if(!$result) {
            die ("Error ");
        } 

    // TODO 5: Retrieve the results.

    $query = "SELECT * FROM catalogs";
    $result = $conn->query($query);
    if(!$result) die ("Database access failed");

    // TODO 6: Display the results back to user.

    $rows = $result->num_rows;
        echo "<table>
        <tr>
            <th>ISBN</th>
            <th>Author</th>
            <th>Title</th>
            <th>Price</th>
        </tr>";
        if($rows>0){
            for($j = 0; $j < $rows; $j++)
            {
                $row = $result->fetch_array(MYSQLI_NUM);
                echo "<tr>";
                for($k = 0; $k < 4; $k++)
                {
                    echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
                }
                echo "</tr>";
            } 
        }else {
            echo "<tr><td colspan='4'>No data found!</td></tr>";
        }  

        echo "</table>";

    // TODO 7: Disconnecting from the database.

    $conn->close();

    ?>
</body>
</html>