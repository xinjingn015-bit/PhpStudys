<?php
date_default_timezone_set("Asia/Tokyo");
echo "Japan Time<br>";

?>

<!DOCTYPE html>
<html lang = "ja>
<head>
    <meta charaset="UTF-8">
    <style>
    #clock{
        font-size: 60px;
        text-align: center; 
        color:rgb(99, 216, 118);
    }
</style>
    <title>今の時刻</title>
</head>
<body>
    <div id="clock"></div>

    <script>
        //時計時刻更新用
        function updateClock(){
            //時間取る
            const now = new Date();
            //時間わけわけ
            const h = now.getHours();
            const m = now.getMinutes();
            const s = now.getSeconds();
            //桁を見て0追加
            const disp_h = h.toString().padStart(2,"0");
            const disp_m = m.toString().padStart(2,"0");
            const disp_s = s.toString().padStart(2,"0");
            //要素追加
            const clock_e = document.getElementById("clock");
            clock_e.textContent = `${disp_h}:${disp_m}:${disp_s}`;
            
        }

        updateClock();
        //再更新設定
        const timer_id = setInterval(updateClock, 1000);
    </script>
</body>
</html>