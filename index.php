<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="container con1">
        <div class="head">
            <h2>รางวัลล็อตเตอรี่ </h2>
        </div>
        <br>
        <div class="container">
            <div>
                <h4>ผลการออกรางวัลล็อตเตอรี่</h4>
            </div>

            <div>
                <form method="post">
                    <button type="submit" class="btn btn-primary" name="draw_lottery">ดำเนินการสุ่มรางวัล</button>
                </form>
            </div>
            <br>
            <div class="container">
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <?php
                        session_start();
                        if (isset($_POST['draw_lottery'])) {
                            $num1 = rand(100, 999);
                            $num2 = rand(100, 999);
                            $num3 = rand(100, 999);
                            $num4 = rand(100, 999);
                            $num5 = rand(100, 999);
                            $num6 = rand(100, 999);
                            $num7 = rand(10, 99);

                            $_SESSION['lottery_numbers'] = array($num1, $num2, $num3, $num4, $num5, $num6, $num7);
                        }
                        if (isset($_SESSION['lottery_numbers'])) : ?>
                            <table class="table table-bordered text-center">
                                <thead>
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="th1 bg-dark">รางวัลที่ 1</th>
                                        <th colspan="2" class="th2 bg-white"><?php echo $_SESSION['lottery_numbers'][0]; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="th3 bg-dark">รางวัลเลขค้างเขียงรางวัลที่ 1</th>
                                        <th scope="col" class="th4 bg-white"><?php echo $_SESSION['lottery_numbers'][1]; ?></th>
                                        <th scope="col" class="th5 bg-white"><?php echo $_SESSION['lottery_numbers'][2]; ?></th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="th6 bg-dark">รางวัลที่ 2</th>
                                        <th scope="col" class="th7 bg-white"><?php echo $_SESSION['lottery_numbers'][3]; ?></th>
                                        <th scope="col" class="th8 bg-white"><?php echo $_SESSION['lottery_numbers'][4]; ?></th>
                                        <th scope="col" class="th9 bg-white"><?php echo $_SESSION['lottery_numbers'][5]; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="th10 bg-dark">รางวัลเลขท้าย 2 ตัว</th>
                                        <th colspan="2" class="th11 bg-white"><?php echo $_SESSION['lottery_numbers'][6]; ?></th>
                                    </tr>
                                </tbody>
                                </thead>
                            </table>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="container-fuild con2">
                <div class="col-12 btmhead">
                    <p class="btmp1">ตรวจรางวัลล็อตเตอรี่</p>
                </div>
                <form method="post">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label numlot">เลขล็อตเตอรี่ :</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="checklottery" placeholder="เช่น 123,538">
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="check" id="checklottery" class="btn btn-primary mb-3">ตรวจรางวัล</button>
                </form>
                <?php

                // รับค่าเลขล็อตเตอรี่จากฟอร์ม
                if (isset($_POST['check'])) {
                    $checklottery = $_POST['checklottery'];

                    // ตรวจสอบเลขล็อตเตอรี่
                    if (!empty($checklottery) && is_numeric($checklottery)) {
                        $lottery_numbers = $_SESSION['lottery_numbers'];
                        $prize_numbers = array($lottery_numbers[0], $lottery_numbers[1], $lottery_numbers[2], $lottery_numbers[3], $lottery_numbers[4], $lottery_numbers[5]);
                        $last_two_numbers = $lottery_numbers[6];

                        // ตรวจสอบว่าถูกรางวัลที่ 1,รางวัลเลขข้างเคียงรางวัลที่ 1,2 หรือรางวัลเลขท้าย 2 ตัวหรือไม่
                        $prize = "";
                        if ($checklottery == $lottery_numbers[0]) {
                            $prize .= "รางวัลที่ 1";
                        } elseif ($checklottery == $lottery_numbers[1] || $checklottery == $lottery_numbers[2]) {
                            $prize .= "รางวัลเลขข้างเคียงรางวัลที่ 1";
                        } elseif ($checklottery == $lottery_numbers[3] || $checklottery == $lottery_numbers[4] || $checklottery == $lottery_numbers[5]) {
                            $prize .= "รางวัลที่ 2";
                        }
                        if (substr($checklottery, -2) == $last_two_numbers) {
                            $prize .= ($prize != "" ? " และ" : "") . "รางวัลเลขท้าย 2 ตัว";
                        }
                        if ($prize != "") {
                            echo '<div class="alert alert-success mt-3"><p class="text-success">ยินดีด้วยคุณถูก' . $prize . '</p></div>';
                        }
                        // ถ้าไม่ถูกรางวัลทั้ง 3 อย่าง
                        else {
                            echo '<div class="alert alert-danger mt-3"><p class="text-danger">เสียใจด้วยคุณไม่ถูกรางวัล</p></div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger mt-3 "><p class="text-danger">โปรดป้อนเลขล็อตเตอรี่ให้ถูกต้อง</p></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>