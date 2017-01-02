$(window).load(function() {
    setTimeout(function() {
        $('a[href="http://www.tsviewer.com/"]').parent().next().remove();
        $('a[href="http://www.tsviewer.com/"]').parent().remove();
        $('.jsenabled').css("display", "initial");
    }, 500);
});

// Copy an elements content to the clipboard.
function copyToClipboard(link) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(link).select();
    document.execCommand("copy");
    $temp.remove();
}
