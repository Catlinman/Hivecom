<!-- Twitch Viewer -->
<script src= "https://player.twitch.tv/js/embed/v1.js"></script>
<div id="twitch">
	<h4 class="centered">Hivecom Twitch Stream</h4>
	<br>
	<div class="horizontal-line"></div>
	<br>
	<script type="text/javascript">
		var options = {
			channel: "<?php echo TWITCH; ?>",
        };
        var player = new Twitch.Player("twitch", options);
        player.setVolume(0.0);

        player.addEventListener(Twitch.Player.ONLINE, function(e){
            $('#twitch').css("display", "initial");
            player.setVolume(0.5);
        });
    </script>
    <br><br>
    <div class="horizontal-line"></div>
</div>
