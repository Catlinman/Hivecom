// Reveal hidden Javascript dependent elements.
$(window).load(function() {
    setTimeout(function() {
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
