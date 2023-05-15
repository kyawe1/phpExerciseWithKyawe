<?php
session_start();
if (isset($_SESSION['is_start'])) {
    if (!empty($_SESSION['is_start'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump("OK");
            if (isset($_POST['reset'])) {
                if (!empty($_POST['reset'])) {
                    $divider = '';
                    $divened = '';
                }
            } else {
                $divider = $_POST['divisor'];
                $divened = $_POST['dividen'];
                $value = $divider / $divened;
                if (!isset($_SESSION['divied_by']) && empty($_SESSION['divided_by'])) {
                    $history = array(
                        array(
                            'divisor' => $divider,
                            'dividen' => $divened,
                            'result' => $value,
                            'timestamp' => date('Y-m-d H:i:s.u')
                        )
                    );
                    $_SESSION['divided_by'] = $history;
                } else {
                    $history = array(
                        'divisor' => $divider,
                        'dividen' => $divened,
                        'result' => $value,
                        'timestamp' => date('Y-m-d H:i:s.u')
                    );
                    $arr = $_SESSION['divided_by'];
                    array_push($arr, $history);
                    var_dump($arr);
                    $_SESSION['divided_by'] = $arr;
                }
            }

        }
    }


} else {
    header("Location: /startpage.php");
    die();
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
    <form method='post' action=<?php $_SERVER['PHP_SELF'] ?>>
        <label>တည်ကိန်း</label>
        <input type='text' class='' name='divisor' value="<?php echo !empty($divider) ? $divider : '' ?>"  required/>
        <label>စားကိန်း</label>
        <input type='text' class='' name='dividen' value="<?php echo !empty($divened) ? $divened : '' ?>"  required/>
        <input type='submit' class='' name='submit' value='submit' />
        <input type='submit' name='reset' value='reset' formaction="<?php echo $_SERVER['PHP_SELF'] ?>"
            formmethod="post" />
    </form>
    <h1> တွက်ချက်ခဲ့ေသာ မှတ်တမ်းများ </h1>
    <div style="height:400;width:300;overflow:scroll;border:1px solid black;padding:7px;margin:1px;">
        <?php
        if (isset($_SESSION['divided_by']) || !empty($_SESSION['divided_by'])) {
            if (!empty($_SESSION['divided_by'])) {
                $arr = $_SESSION['divided_by'];
                foreach ($arr as $results) {
                    ?>
                    <p style='border-bottom: 1px double black;'>

                        တည်ကိန်း :
                        <?php echo $results['divisor'] ?> <br>
                        စားကိန်း :
                        <?php echo $results['dividen'] ?> <br>
                        စားလဒ် :
                        <?php echo $results['result'] ?><br>
                        ဆောင်ရွက်ခဲ့သောအချိန် :
                        <?php echo $results['timestamp'] ?><br>

                    </p>
                    <?php
                }
            }
        }
        ?>
    </div>
</body>

</html>