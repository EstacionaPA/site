var slideShow = {
    
    runSlide: function(){
    
        slideShow.setInvisible('setAll', 'all');

        slideShow.playTime(1000);

    },

    playTime: function(time){
        
        var i = 0;
        
        while(i<2){
            
            setTimeout(function () {slideShow.setInvisible('img1', 'img2')}, time);
            setTimeout(function () {slideShow.setInvisible('img3', 'img2')}, time);
            setTimeout(function () {slideShow.setInvisible('img4', 'img3')}, time);
            setTimeout(function () {slideShow.setInvisible('img1', 'img4')}, time);
        
        }
    },

    setInvisible: function(frtId, SndId){
    
        if(frtId=='setAll' && SndId=='all'){
            document.getElementById('img2').style.visibility = "hidden";
            document.getElementById('img3').style.visibility = "hidden";
            document.getElementById('img4').style.visibility = "hidden";
            return null;
        }
        
        document.getElementById(frtId).style.visibility = "hidden";
        document.getElementById(SndId).style.visibility = "visible";
    
    }
}

slideShow.runSlide();
