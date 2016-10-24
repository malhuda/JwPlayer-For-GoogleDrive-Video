<?php
	if ($jw[0][0] != "") {
		echo('{file: "'.urldecode($jw[0][0]).'",type: "video/mp4",label: "'.urldecode($jw[1][0]).'"},');
	}
	if ($jw[0][1] != "") {
		echo('{file: "'.urldecode($jw[0][1]).'",type: "video/mp4",label: "'.urldecode($jw[1][1]).'"},');
	}	
	if ($jw[0][2] != "") {
		echo('{file: "'.urldecode($jw[0][2]).'",type: "video/mp4",label: "'.urldecode($jw[1][2]).'"},');
	}	
	if ($jw[0][3] != "") {
		echo('{file: "'.urldecode($jw[0][3]).'",type: "video/mp4",label: "'.urldecode($jw[1][3]).'"},');
	}
?>