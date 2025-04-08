<?php

require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND professional_level = 'Student'");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['professional_level'] = $user['professional_level'];
            
            header("Location: student_dashboard.php");
            exit();
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة أو ليس لديك صلاحية الدخول كطالبة";
        }
    } catch(PDOException $e) {
        $error = "حدث خطأ في النظام: " . $e->getMessage();
    }
}
?>
