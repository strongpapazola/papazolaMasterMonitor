<?php

$key = $_GET['key'];
if (isset($key) and $key == 'Y29iYQ==') {
	echo shell_exec('cat result.json');
} else {
	echo '{"msg":"error code"}';
}

