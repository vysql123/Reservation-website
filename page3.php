<?php
if (isset($_POST["submit2"])) {
    
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
    $pdo = new PDO("　　　　　　　　　　　　　");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $join= $pdo->prepare("SELECT*FROM plans WHERE plan_id=?");
    $join->execute([$plan_id]);
    $item = $join->fetch();
} catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die("<br>DBアクセスでエラーが発生したため、処理を中断しました");
}
session_start();
$_SESSION["customername"]=$customername;
$_SESSION["customernumber"]=$customernumber;
$_SESSION["totalprice"]=$totalprice;
$_SESSION["email"]=$email;
$_SESSION["phonenumber"]=$phonenumber;
$_SESSION["arrivaltime"]=$arrivaltime;
$_SESSION["extra"]=$extra;
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>予約確認</title>
       <link rel="stylesheet" type="text/css" href="./css/css.css"> 
    </head>
    <body>
        <nav>
            <a href="page1.php">ホテル名</a>
            <input type="hidden" class="date" name="date"
                value="<?php echo $date;?>">
        </nav>
            <h1>予約確認</h1>
            <h2><?php echo $item['plan_name']?></h2>
            <p><?php echo $item['detail']?></p>
            <p>入力内容を確認し確定ボタンを押してください<br>
                誤りがある場合は、戻るボタンで前画面に戻り入力し直してください</p>
        <form method="post" action="page4.php">
            <table width="1000" height="100">
                <tr>
                    <th width="30%">氏名</th>
                    <th width="15%">宿泊人数</th>
                    <th width="15%">合計金額</th>
                </tr>
                <tr>
                    <td><?php echo $customername?></td>
                    <td><?php echo $customernumber?></td>
                    <td><?php echo $totalprice?></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <th>電話番号</th>
                </tr>
                <tr>
                    <td><?php echo $email ?></td>
                    <td><?php echo $phonenumber ?></td>
                </tr>
            </table>
            <h4>到着予定時刻</h4>
            <p><?php echo $arrivaltime ?></p>
            <h4>備考</h4>
            <p><?php echo $extra ?></p>
            <input type="hidden" name="customername" value="<?php echo $customername?>">
            <input type="hidden" name="customernumber" value="<?php echo $customernumber?>">
            <input type="hidden" name="plan_id" value="<?php echo $plan_id?>">
            <input type="hidden" name="email" value="<?php echo $email?>">
            <input type="hidden" name="phonenumber" value="<?php echo $phonenumber?>">
            <input type="hidden" name="arrivaltime" value="<?php echo $date?> <?php echo $arrivaltime?>">
            <input type="hidden" name="extra" value="<?php echo $extra?>">
            <table>
                <tr>
                    <button type="button" class="back" onclick="goBack()">戻る</button>
                </tr>
                <tr>
                    <input type="submit" name="submit3" class="check-margin" value="確定">
                </tr>
            </table>
        </form>
        <script>
            function goBack() {
            window.history.back()
            }
        </script>
   	</body>
</html>
