
// Called when the window has been loaded.
$(window).load(function() {
	setTimeout(function() {
		// Remove the TSViewer widget.
		$('a[href="http://www.tsviewer.com/"]').parent().next().remove();
		$('a[href="http://www.tsviewer.com/"]').parent().remove();

		// Enable Javascript only elements that are otherwise hidden. This is done so certain
		// browsers which do not support JS or have it disabled do not see empty Javascript based elements.
		$('.jsenabled').css("display","initial");
	}, 500);
});