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
    .date{
        font-size: min(7vw,10vh);
        padding-left: 20px;
        margin: 3px;
    }
    #calender{
        margin: 15px;
        padding: 15px;
        background-color: hsla(0, 11%, 95%, 0.91);
        color: rgb(0, 0, 0);
        text-Shadow :"1px 0px 1px rgba(43, 43, 43, 0.7)";
        text-align: center;
    }
    .today{
        display:inline-block;

        width: 32px;
        height: 32px;

        line-height: 32px;
        text-align: center;

        border-radius: 50%;
        background-color: hsla(29, 76%, 68%, 0.70);
    }
    .mon{
        font-size: 30px;
    }
    table{
        margin: 0 auto;
    }
    td{
        width: 100px;
        height: 50px;
        text-align: center;
        vertical-align:middle;
        background-color: hsla(0, 0%, 100%, 0.67);
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
    <div class = "date"></div>
    <div id="clock"></div>
    <p> 本体の時間によっては実際の時間とずれることがあります</p>
    <div id = "calender">
        <div class = "mon"></div>
        <table>
        <tr>
            <td>日</td>
            <td>月</td>
            <td>火</td>
            <td>水</td>
            <td>木</td>
            <td>金</td>
            <td>土</td>
        </tr>
        <tbody class = "days"></tbody>
        </table>
    </div>
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

//カレンダーの作成
function GetCalender(date){
    const date_e = document.querySelector(".days");
    const month_e = document.querySelector(".mon");
    const m = date.getMonth();
    const d = date.getDate();

    month_e.textContent = (m+1).toString();

    const first_d ={
        mon:m+1,
        day:1,
        youbi: new Date(date.getFullYear(),m,1).getDay()
    };
    const last_d ={
        mon:m+1,
        day:new Date(date.getFullYear(),m+1,0).getDate(),
        youbi: new Date(date.getFullYear(),m+1,0).getDay()
    };

    let context = "<tr>";
    //繰り返して配置
    let youbi = first_d.youbi;//曜日カウンタ
    for(let i=0;i<first_d.youbi;i++){
        context +=  `<td></td>`; 
    }

    for(let d = 1; d<=last_d.day;d++){
        if(d == date.getDate()){
            context += `<td><span class="today">${d}</span></td>`;
        }
        else{
            context += `<td>${d}</td>`;
        }
        youbi++;
        if(youbi >= 7){
            youbi =0;
            context += `</tr>`;
        }
    }
    date_e.innerHTML = context;

}


function updateClock(){

    const now = new Date();

    GetCalender(now);

    const h = now.getHours();
   // const h = 0;
    const m = now.getMinutes();
   // const m = 0;
    const s = now.getSeconds();

    const clock_e = document.getElementById("clock");
    const date_e = document.querySelector(".date");
    
    //日時設定
    {
        const disp_h = h.toString().padStart(2,"0");
        const disp_m = m.toString().padStart(2,"0");
        const disp_s = s.toString().padStart(2,"0");
        const disp_d = now.getDate().toString().padStart(2,"0");
        const disp_y = now.getFullYear().toString();
        const disp_mon = (now.getMonth() +1).toString().padStart(2,"0");

        date_e.textContent = `${disp_y}/${disp_mon}/${disp_d}`;
        clock_e.textContent = `${disp_h}:${disp_m}:${disp_s}`;
    }

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
            date_e.style.textShadow = "1px 1px 2px rgba(203, 203, 216, 1)";
           
        }
        else{
            clock_e.style.textShadow = "1px 1px 3px rgba(43, 43, 43, 0.7)";
            date_e.style.textShadow = "1px 0px 1px rgba(43, 43, 43, 0.7)";

        }
    }
    
    updateClock();
    setInterval(updateClock, 1000);
    </script>
</body>
</html>
