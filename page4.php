<?php
if (isset($_POST["submit3"])) {
    
} else {
    header("Location: page1.php");
    exit;
};
if (isset($_POST["date"])) {
    $date = $_POST["date"];
} else {
    $date = '';
};
if (isset($_POST["plan_id"])) {
    $plan_id = $_POST["plan_id"];
} else {
    $plan_id = '';
};
if (isset($_POST["customername"])) {
    $customername = $_POST["customername"];
} else {
    $customername = '';
};
if (isset($_POST["customernumber"])) {
    $customernumber = $_POST["customernumber"];
} else {
    $customernumber = '';
};
if (isset($_POST["totalprice"])) {
    $totalprice = $_POST["totalprice"];
} else {
    $totalprice = '';
};
if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else {
    $email = '';
};
if (isset($_POST["phonenumber"])) {
    $phonenumber = $_POST["phonenumber"];
} else {
    $phonenumber = '';
};
if (isset($_POST["arrivaltime"])) {
    $arrivaltime = $_POST["arrivaltime"];
} else {
    $arrivaltime = '';
};
if (isset($_POST["extra"])) {
    $extra = $_POST["extra"];
} else {
    $extra = '';
};
try {
    $conn = new PDO("　　　　　　　　　　　　　　");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = $conn -> prepare("INSERT INTO reservations (name, persons, mail_address, phone_number, ETA, note, plan_id) VALUES (?,?,?,?,?,?,?)");
    $sql -> execute(array($customername,$customernumber,$email,$phonenumber,$arrivaltime,$extra,$plan_id)); 
} catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die("<br>DBアクセスでエラーが発生したため、登録に失敗しました");}
$conn = null;
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>予約完了</title>
       <link rel="stylesheet" type="text/css" href="./css/css.css"> 
    </head>
    <body>
            <br><a href="page1.php">ホテル名</a>
    		<h1>予約完了</h1>
            <h2>予約が完了しました。</h2>
    		<h4><a href="page1.php">予約一覧に戻る</a>
            </h4>
   	</body>
</html>
