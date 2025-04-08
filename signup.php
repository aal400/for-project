<?php

require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $professional_level = $_POST['professional_level']; // بدلاً من 'Professional-level'
    
    $gender = $_POST['gender'];
    $age = $_POST['n'];

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password, fname, lname, phone, professional_level, gender, age) 
                               VALUES (:username, :password, :fname, :lname, :phone, :professional_level, :gender, :age)");
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':professional_level', $professional_level);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        
        $stmt->execute();
        
        // توجيه المستخدم حسب نوعه
        switch($professional_level) {
            case 'Student':
                header("Location: Lstudent.php");
                break;
            case 'Employee':
                // يمكنك تغيير هذا حسب احتياجاتك
                header("Location: Home.html");
                break;
            case 'Driver':
                header("Location: Ldriver.php");
                break;
            case 'Supervisor':
                header("Location: Lsupervisor.php");
                break;
            default:
                header("Location: Home.html");
        }
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
// بعد معالجة البيانات بنجاح
header("Location: Home.html");
exit();
?>