<?php require_once("operator.php"); ?>
	<script>
		var playerInstance = jwplayer("myElement");
		playerInstance.setup({
			title: "<?php echo $jwtitle;?>",
			description: "<?php echo $jwdescription;?>",
			image: "<?php echo $jwimage;?>",
			sources: [<?php require_once("quality.php"); ?>],
			width:"100%",
			height:"100%",
			autostart: "<?php echo $jwautostart;?>",
			abouttext: "lmly9193.github.io",
			aboutlink: "https://github.com/lmly9193",
		});
	</script>