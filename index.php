<?php
date_default_timezone_set("Asia/Tokyo");
echo "Now Time<br>";

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset="UTF-8">
    <style>
    #clock{
        font-size: min(20vw,30vh); 
        text-align: center;
        
    }
    p{
        font-size: smaller;
        background-color: hsla(0, 5%, 83%, 0.7);
        color: rgb(20, 20, 0);
    }
</style>
    <title>今の時刻</title>
</head>
<body>
    <div id="clock"></div>
    <p> 本体の時間によっては実際の時間とずれることがあります</p>
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

    const changeed =  {
        h: Math.abs(( moto.h + 180) %360),
        s: Math.abs(100 - moto.s), 
        l: Math.abs(100 - moto.l), 
    }
    //明度で文字の明るさ分け
 

    return `hsl(${changeed.h}, ${changeed.s}%, ${changeed.l}%)`
}

function updateClock(){

    const now = new Date();

    const h = now.getHours();
   // const h = 0;
    const m = now.getMinutes();
   // const m = 0;
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
        if(h < 5 || h >= 20 ){
            clock_e.style.textShadow = "1px 1px 4px rgba(203, 203, 216, 1)";
        }
        else{
            clock_e.style.textShadow = "1px 1px 3px rgba(43, 43, 43, 0.7)";

        }
    }
    
    updateClock();
    setInterval(updateClock, 1000);
    </script>
</body>
</html>
