<?php
    session_start();
    require_once 'dbconnect.php';
    
        if ($_SERVER ["REQUEST_METHOD"] == "POST") {
            $name=$_POST["name"];
            $username=$_POST["username"];
            $pass1=$_POST["pass1"];
            $pass2=$_POST["pass2"];
            $info=isset($_POST["info"]) ? $_POST["info"] : " ";

            $_SESSION["name"] = $name;
            $_SESSION["username"] = $username;
            $_SESSION["pass1"] = $pass1;
            $_SESSION["pass2"] = $pass2;
            $_SESSION["info"] = $info;

            if (empty($name) || empty($username) || empty($pass1) || empty($pass2)) {
                echo "All fields are required!";
                exit;
            }
            
            if (isset($_POST['verify'])) {
                $sql = "SELECT * FROM login WHERE username = '$username'";
                $idcheck = mysqli_query($db_connect, $sql);
                if (mysqli_num_rows($idcheck) > 0) {
                    unset($_SESSION["username"]);
                    echo "<script>alert('Username already exists!');location.href='../registerpage.php?verified=0'</script>";
                    exit;
                } elseif ($pass1 !== $pass2) {
                    unset($_SESSION["pass1"]);
                    unset($_SESSION["pass2"]);
                    echo "<script>alert('Password does not match!');location.href='../registerpage.php?verified=0'</script>";
                    exit;
                } else {
                    $_SESSION['verified'] = true;
                    echo "<script>alert('Password match!');location.href='../registerpage.php?verified=1'</script>";
                    exit;
                }
            }

            if (isset($_POST['submit_form']) && isset($_SESSION['verified']) && $_SESSION['verified'] === true) {
                $sql = "INSERT INTO login (name, username, pass, info) VALUES ('$name', '$username', '$pass1', '$info')";
                $result = mysqli_query($db_connect, $sql);
                echo "send db ok";

                if (!$result) {
                    echo "Database Error: " . mysqli_error($db_connect);
                    exit;
                }
            
                if($result){
                    unset($_SESSION["name"]);
                    unset($_SESSION["username"]);
                    unset($_SESSION["pass1"]);
                    unset($_SESSION["pass2"]);
                    unset($_SESSION["info"]);
                    echo "<script>alert('Welcome to yzz code!');location.href='../mainpage.php'</script>";
                    exit;
                }else{
                    echo "<script>alert('Try Again!');location.href='../registerpage.php?verified=1'</script>";
                    exit;
                }
            } else {
                var_dump($_POST);
                var_dump($_SESSION);
                echo "<script>alert('Verify ID, Password');location.href='../registerpage.php?verified=1'</script>";
                exit;
            }
        }
    

    mysqli_close($db_connect);
?>