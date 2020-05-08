<?php

$key = $_GET['key'];
if (isset($key) and $key == 'b3af409bb8423187c75e6c7f5b683908') {
	echo shell_exec('echo \'{"run":"true"}\' > check.json');	
	// sleep('1');
	echo shell_exec('cat result.json');
} else {
	echo '{"msg":"error code"}';
}

