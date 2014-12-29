$(window).load(function() {
    setTimeout(function(){
        $('a[href="http://www.tsviewer.com/"]').parent().next().remove();
        $('a[href="http://www.tsviewer.com/"]').parent().remove();
        $('.jsenabled').css("display","initial");
    }, 500);
});
