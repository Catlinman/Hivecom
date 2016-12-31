<footer>
	<div id="footercontainer" class="shadowed">
		<?php include(TEMPLATES_PATH . "/module/queryinfo.php");?>
		<br>
        <a href="/page?access=terms-and-conditions" alt="Terms">Terms &amp; Conditions</a> |
        <a href="https://github.com/catlinman/hivecom.net" alt="GitHub">Site source code</a>
		<br>
		<a href="https://catlinman.com/" alt="Catlinman website">&copy Catlinman 2013 - <?php echo date("Y"); ?></a>
    </div>
	<br><br>
</footer>
<!-- Insert the smooth scroll script -->
<script>
    smoothScroll.init({
        speed: 1000,
        easing: 'easeInOutCubic',
        updateURL: true,
        offset: 0,
        callbackBefore: function(toggle, anchor){},
        callbackAfter: function(toggle, anchor){}
    });
</script>
