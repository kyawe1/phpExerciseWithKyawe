<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['is_start'])) {
        if (!empty($_SESSION['is_start'])) {
            if (isset($_POST['reset'])) {
                if (!empty($_POST['reset'])) {
                    $birthday = '';
                }
            } else {
                $today = new DateTime();
                $birthday = $_POST['birthday'];
                $birthdate = new DateTime($birthday);
                $date = $today->diff(new DateTime($birthday));
                $year = $date->format("%y နှစ် %m လ %d ရက်");
                
                if (!isset($_SESSION['calculate_date']) && empty($_SESSION['calculate_date'])) {
                    
                    $history = array(
                        array(
                            'birthday' => $birthday,
                            'result' => $year,
                            'timestamp' => date('Y-m-d H:i:s.u')
                        )
                    );
                    $_SESSION['calculate_date'] = $history;
                } else {
                    $history = array(
                        'birthday' => $birthday,
                        'result' => $year,
                        'timestamp' => date('Y-m-d H:i:s.u')
                    );
                    $arr = $_SESSION['calculate_date'];
                    array_push($arr, $history);
                    $_SESSION['calculate_date'] = $arr;
                }
            }
        }
    } else {
        var_dump("OL");
        header("Location: /startpage.php");
        die();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method='post'>
        <label> မွေးနေ့ ထည့်ရန် </label>
        <input type='date' name="birthday" id="birthday" value="<?php echo !empty($birthday) ? $birthday : '' ?>"><br>
        <input type='submit' name="submit" value='submit' />
        <input type='submit' name='reset' value='reset' formaction="<?php echo $_SERVER['PHP_SELF'] ?>"
            formmethod="post" />
    </form>
    <h1> တွက်ချက်ခဲ့ေသာ မှတ်တမ်းများ </h1>
    <div style="height:400;width:300;overflow:scroll;border:1px solid black;padding:7px;margin:1px;">
        <?php
        if (isset($_SESSION['calculate_date'])) {
            if (!empty($_SESSION['calculate_date'])) {
                $arr = $_SESSION['calculate_date'];
                foreach ($arr as $results) {
                    ?>
                    <p style='border-bottom: 1px double black;'>
                        သင်ဧ။် အသက်မှာ (
                        <?php echo $results['result'] ?> <br>) ဖြစ်ပါသည်။<br>
                        သင်ဧ။် မွေးနေ့ မှာ (
                        <?php echo $results['birthday'] ?>) ဖြစ်သည့် အတွက်။ <br>
                        လုပ် ဆောင်ခဲ့သည့်ရက်မှာ =
                        <?php echo $results['timestamp'] ?>
                    </p>
                    <?php
                }
            }
        }
        ?>
    </div>
</body>

</html>