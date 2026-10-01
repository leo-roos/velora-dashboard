<?php

$usersArray = [];
// try
// {
//     $con = new PDO("mysql:host=" . DB_servername . ";dbname=" . DB_name . ";charset=utf8mb4", DB_username, DB_password);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     $sql = "SELECT * FROM `users`;";
//     $result = $con->query($sql);

//     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//         array_push($usersArray, $row);
//     }
// }
// catch(PDOException $e)
// {
//     echo "Connection failed: " . $e->getMessage();
// }

?>

<div class="users">
    <div class="title">
        Användarkonton
    </div>
    <div class="items">
        <?php
            foreach ($usersArray as $key => $value) {
                print_r($value);
            }
        ?>
    </div>
</div>