<?php

function checkfile() {
$a = shell_exec('cat check.json');
$a = explode("\n",$a)[0];
$a = json_decode($a, True)['run'];
return $a;
}

$key = $_GET['key'];
if (isset($key) and $key == 'b3af409bb8423187c75e6c7f5b683908') {
//	sleep('1');
//	if (checkfile() == "false"){
//		shell_exec('echo \'{"run":"true"}\' > check.json');
//	}
	echo shell_exec('cat result.json');
} else {
	echo '{"msg":"error code"}';
}

