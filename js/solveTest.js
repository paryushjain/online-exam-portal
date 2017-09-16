function timeout(){
    var minute = Math.floor(timeLeft/60);
    var second = timeLeft%60;
    if(timeLeft<=0){
        clearTimeout(tm);
        document.getElementById("quiz").submit();
    }
    else{
        document.getElementById("time").innerHTML = minute+":"+second;
    }
    timeLeft--;
    var tm = setTimeout(function(){timeout()},1000);
}
