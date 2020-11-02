<?php 
try{
    $pdo = new PDO("mysql:host=localhost;dbname=oyado","craft","craft.admin");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $join="SELECT type_name, plans.image_id, alt, url, plan_id, plan_name, detail, price, plans.type_id 
    FROM plans
        INNER JOIN meal_types 
        ON plans.type_id=meal_types.type_id 
            INNER JOIN plan_images 
            ON plans.image_id=plan_images.image_id";
    $plans = $pdo->query($join);
} catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die("<br>DBアクセスでエラーが発生したため、処理を中断しました");
}
if (isset($_POST["date"])) {
   $date = $_POST["date"];
} else {
   $date = '';
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
            <p><a href="page1.php">ホテル名</a></p>
        </nav>
        <div class="plan_box">
            <form method="post" action="page1.php" name="frm0">
            <h1>宿泊プラン検索</h1>
            <p>宿泊予約日を選択してください</p>
            <input type="date" class="date" name="date" value="<?php echo $date;?>">
            <input type="submit" class="plan_box" value="検索">
            </form>
        </div>
        <?php
            if (!empty($date)) {
                if (strtotime($date)>=strtotime("today")) {
                    foreach ($plans as $arr) {
                    $date2 = $date;
                    $plan_id=$arr["plan_id"];
                    $plan_name=$arr["plan_name"];
                    $detail=$arr["detail"];
                    $price=$arr["price"];
                    $type=$arr["type_name"];
                    $imgid=$arr["image_id"];
                    $alt=$arr["alt"];
                    $img=$arr["url"];
                    echo "<div class='plan_box'>
                    <form method='post' action='page2.php'>
                    <input type='hidden' class='date' name='date'
                    value={$date2}>
                    <input type='hidden' name='plan_id' value={$plan_id}>
                    <input type='hidden' name='price' value={$price}>
                    <input type='hidden' name='plan_name' value={$plan_name}>
                    <input type='hidden' name='detail' value={$detail}>
                    <img src={$img} id={$imgid}width='300' height='230' alt={$alt}>
                    <div class='planname'>
                    <p>{$plan_name}</p>
                    </div>
                    <p>宿泊タイプ</p>
                    <p>&nbsp;&nbsp;&nbsp;{$type}</p>
                    <p>チェックイン 15:00 ~ チェックアウト ~ 10:00</p>
                    <p>{$detail}</p>
                    <input type='submit' name='submit1' class='button-reser' value='予約する'>
                    <br></form></div>";
                    }
                } else {echo "<p>指定された日付での宿泊可能なプランはありません</p>";
                }
            } else {echo "<p>宿泊可能なプランがある場合はこちらに表示されます</p>";
            }
            ?>
   	</body>
</html>