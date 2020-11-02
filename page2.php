<?php
if (isset($_POST["submit1"])) {
    
} else {
    header("Location: page1.php");
    exit;
};
if (isset($_POST["date"])) {
    $date = $_POST["date"];
} else {
    $date = '';
}
if (isset($_POST["plan_id"])) {
    $plan_id = $_POST["plan_id"];
} else {
    $plan_id = '';
}
try {
    $pdo = new PDO("　　　　　　　　　");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $join= $pdo->prepare("SELECT*FROM plans WHERE plan_id=?");
    $join->execute([$plan_id]);
    $item = $join->fetch();
} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    die("<br>DBアクセスでエラーが発生したため、処理を中断しました");
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>プラン検索</title>
        <link rel="stylesheet" type="text/css" href="./css/css.css"> 
    </head>
    <body>
        <nav>
            <a href="page1.php">ホテル名</a>
        </nav>
            <h1>宿泊予約</h1>
                <form method="post" action="page3.php"
                name=frm2>
                <input type="hidden" class="date" name="date"
                value="<?php echo $date;?>">
            <h2><?php echo $item["plan_name"]?></h2>
            <p><?php echo $item["detail"]?></p>
            <p>予約フォーム</p>
            <table>
                <tr>
                    <th width="30%">氏名*</th>
                    <th width="15%">宿泊人数*</th>
                    <th width="15%">合計金額</th>
                </tr>
                <tr>
                    <td><input type="text" class="box-fm" name="customername" placeholder="予約 太郎" required></td>
                    <input type='hidden' name='plan_id' value="<?php echo $plan_id?>">
                    <td><input type="number" class="box-fm" name="customernumber" placeholder="2" id="people" onChange="keisan()" required></td>
                    <input type="hidden" name="price" value={$price}>
                    <td><input type="text" class="box-fm" 
                               name="totalprice" id="total" 
            ></td>
                </tr>
                <tr>
                    <th>メールアドレス*</th>
                    <th>電話番号*</th>
                </tr>
                <tr>
                     <td><input type="text" class="box-fm" placeholder="test@mailbox.com" name="email" required></td>
                    <td colspan="2"><input type="tel" name="phonenumber" class="box-fm" placeholder="090XXXXXXXX" required></td>
                    <td></td><td></td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>到着予定時刻</th>
                </tr>
                <tr>
                    <td><input type="time" name="arrivaltime" class="box-time" placeholder="15:00" required>
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                </tr>
                <tr>
                    <td><textarea class="extra" name="extra" placeholder="チェックアウトの時間を遅らせたい" rows="4" cols="150"></textarea></td>
                </tr>
            </table>
            <table>
                <tr>
                <th width="1050"><input type="submit" name="submit2" class="check" value="確認"></th>
                <th><button type="button" class="back" onclick="goBack()">戻る</button></th>
                </tr>
            </table>
            </form>
        <script>
            window.addEventListener('load', keisan);
            function keisan(){
                let price="<?php echo $item["price"]?>";
                let number=document.getElementById("people").value; 
                document.getElementById("total").value=number*price;}
            function goBack() {
                window.history.back()
            }
        </script>
   	</body>
</html>
