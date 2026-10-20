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
    }
</style>
    <title>今の時刻</title>
</head>
<body>
    <div id="clock"></div>

   <script>
function ChengColor(hslString){
 // パターン: hsl(数字, 数字%, 数字%)
    const regex = /^hsl\(\s*([\d.]+)\s*,\s*([\d.]+)%\s*,\s*([\d.]+)%\s*\)$/i;
    const match = hslString.match(regex);

    if (!match) {
        throw new Error("Invalid HSL format: " + hslString);
    }

    // 数値に変換
    const moto = {
        h: parseFloat(match[1]), // Hue
        s: parseFloat(match[2]), // Saturation
        l: parseFloat(match[3])  // Lightness
    };

    return {
        h: Math.abs((360 - moto.h)),
        s: Math.abs(100 - moto.s), 
        l: Math.abs(100 - moto.l), 
    }
}

function updateClock(){

    const now = new Date();

    const h = now.getHours();
    const m = now.getMinutes();
    const s = now.getSeconds();

    const disp_h = h.toString().padStart(2,"0");
    const disp_m = m.toString().padStart(2,"0");
    const disp_s = s.toString().padStart(2,"0");

    const clock_e = document.getElementById("clock");

    clock_e.textContent = `${disp_h}:${disp_m}:${disp_s}`;

    let color;

        if(h < 4){
            color = "hsl(266, 90%, 7%)";
        }
        else if(h < 6){
            const qua = ((h - 4) * 60 + m) / 12;

            const p = 90 - qua * 9;
            const o = 10 + qua * 9;

            color = `hsl(266, ${p}%, ${o}%)`;
        }
        else if(h < 8){
            const qua = ((h - 6) * 60 + m) / 12;

            const p = qua * 6;
            const o = 100 - qua * 4;

            color = `hsl(206, ${p}%, ${o}%)`;
        }
        else if(h < 15){
            color = "hsl(206, 70%, 70%)";
        }
        else if(h < 16){
            const qua = ((h - 15) * 60 + m) / 6;

            const l = 60 + qua * 3;

            color = `hsl(206, ${l}%, ${l}%)`;
        }
       else if(h < 18 || (h === 18 && m <= 30)){
            const qua = ((h - 16) * 60 + m) / 15;

            const l = 100 - qua * 3;
            const j = 100 - qua * 5;

            color = `hsl(32, ${l}%, ${j}%)`;
        }
        else if(h < 20){
            const qua = ((h - 18) * 60 + m) / 12;
            const l = 70 + qua * 2;
            const j = 50 - qua * 4.3;

            color = `hsl(32, ${l}%, ${j}%)`;
        }
        else{
            color = "hsl(266, 90%, 7%)";
        }
        
        document.body.style.backgroundColor = color;
        document.body.style.color = ChengColor(color);
    }

    updateClock();
    setInterval(updateClock, 1000);
    </script>
</body>
</html>
