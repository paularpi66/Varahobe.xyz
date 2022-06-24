<?php
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNo = $_POST['phoneNo'];
        $nidNo = $_POST['nidNo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $host = "localhost:3307";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "varahobe";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM signup WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO signup(firstName, lastName, phoneNo, nidNo, email, password) values(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssiiss",$firstName, $lastName, $phoneNo, $nidNo, $email, $password);
                if ($stmt->execute()) {
                    echo "Signup Sucessful.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already signup using this email.";
            }
            $stmt->close();
            $conn->close();
        }
?>