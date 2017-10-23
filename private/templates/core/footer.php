<footer>
	<div id="footercontainer" class="shadowed">
		<a title="Steam Group" alt="Steam Group" href="https://steamcommunity.com/groups/<?php echo STEAM; ?>">
            <img src="/static/img/icons/steam.png"/>
        </a>
        <a title="Twitter" alt="Twitter" href="https://twitter.com/<?php echo TWITTER; ?>">
            <img src="/static/img/icons/twitter.png"/>
        </a>
        <a title="Facebook" alt="Facebook" href="https://facebook.com/<?php echo FACEBOOK; ?>">
            <img src="/static/img/icons/facebook.png"/>
        </a>
        <?php include(TEMPLATES_PATH . "/module/queryinfo.php");?>
        <br>
        <a href="/page?id=terms-and-conditions" alt="Terms">Terms &amp; Conditions</a> |
        <a href="https://github.com/catlinman/hivecom.net" alt="GitHub">Site source code</a>
        <br>
        <a href="https://catlinman.com/" alt="Catlinman website">&copy Catlinman 2013 - <?php echo date("Y"); ?></a>
    </div>
    <br>
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
