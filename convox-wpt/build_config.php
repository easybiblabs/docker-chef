<?php

	function compress_array($array, $start_entry = NULL) {
		$response = array();
		foreach($array as $index => $value) {
			if($start_entry==NULL) $entry = strtoupper($index);
			else $entry = $start_entry.'_'.strtoupper($index);
			if(is_array($value)) $response = array_merge($response, compress_array($value, $entry));
			else $response[$entry] = $value;
		}
		return $response;
	}

	$file = file_get_contents('/webroot/etc/vagrant.json');
	$json = json_decode($file, true);

	$ini['deployed_application'] = compress_array($json['vagrant']['applications']['wpt']);
	$ini['deployed_stack']['environment'] = 'vagrant';
	$ini['deployed_stack']['stackname'] = 'vagrant';
	$ini['settings'] = compress_array($json['wpt']['env']);

	$ini['settings']['DB_WPT_HOST'] = ( getenv('DB_HOST')!='' ? getenv('DB_HOST') : '172.17.0.2');
	$ini['settings']['DB_WPT_PORT'] = ( getenv('DB_PORT')!='' ? getenv('DB_PORT') : '3306');
	$ini['settings']['DB_WPT_DATABASE'] = ( getenv('DB_DATABASE')!='' ? getenv('DB_DATABASE') : 'wpt');
	$ini['settings']['DB_WPT_USERNAME'] = ( getenv('DB_USERNAME')!='' ? getenv('DB_USERNAME') : 'vagrant');
	$ini['settings']['DB_WPT_PASSWORD'] = ( getenv('DB_PASSWORD')!='' ? getenv('DB_PASSWORD') : 'password');

	$ini['settings']['AWS_S3_KEY'] = ( getenv('S3_USERNAME')!='' ? getenv('S3_USERNAME') : 'vagrant');
	$ini['settings']['AWS_S3_SECRET'] = ( getenv('S3_PASSWORD')!='' ? getenv('S3_PASSWORD') : 'password');
	$ini['settings']['AWS_S3_BUCKET'] = ( getenv('S3_BUCKET')!='' ? getenv('S3_BUCKET') : 'wpt');
	$ini['settings']['AWS_S3_REGION'] = ( getenv('S3_REGION')!='' ? getenv('S3_REGION') : 'us-east-1');
	$ini['settings']['AWS_S3_VERSION'] = ( getenv('S3_VERSION')!='' ? getenv('S3_VERSION') : '2006-03-01');
	$ini['settings']['AWS_S3_ENDPOINT'] = ( getenv('S3_URL')!='' ? str_replace ( 'tcp://', 'http://', getenv('S3_URL')) : 'http://172.17.0.8:4568');

	$ini['settings']['AWS_SQS_KEY'] = ( getenv('S3_USERNAME')!='' ? getenv('S3_USERNAME') : 'vagrant');
	$ini['settings']['AWS_SQS_SECRET'] = ( getenv('SQS_PASSWORD')!='' ? getenv('SQS_PASSWORD') : 'password');
	$ini['settings']['AWS_SQS_REGION'] = ( getenv('SQS_REGION')!='' ? getenv('SQS_REGION') : 'us-east-1');
	$ini['settings']['AWS_SQS_ENDPOINT'] = ( getenv('SQS_URL')!='' ? str_replace ( 'sqs://', 'http://', getenv('SQS_URL')) : 'http://172.17.0.6:80');

	$ini['settings']['REDIS_HOST'] = ( getenv('REDIS_URL')!='' ? str_replace ( 'redis://', 'http://', getenv('REDIS_URL')) : 'http://vagrant:password@172.17.0.4:6379/0');


	$nl = "\n";
	$tb = "\t";
	// create ini
	$ini_file = '';
	foreach ($ini as $case => $load) {
		$ini_file .= '['.$case.']'.$nl;
		foreach ($load as $index => $value) {
			if($index == 'TRUSTED_REQUEST_PROXIES_0' || $index == 'GOOGLE_DRIVE.SCOPE_0') {
				$ini_file .= str_replace('_0','',$index).'[0] = "'.$value.'"'.$nl;
			} else $ini_file .= $index.' = "'.$value.'"'.$nl;
		}
	}
	
	// create sh
	$sh_file = '';
	foreach ($ini['deployed_application'] as $index => $value) {
		$sh_file .= 'export DEPLOYED_APPLICATION_'.$index.'="'.$value.'"'.$nl;
	}
	foreach ($ini['deployed_stack'] as $index => $value) {
		$sh_file .= 'export DEPLOYED_STACK_'.$index.'="'.$value.'"'.$nl;
	}
	foreach ($ini['settings'] as $index => $value) {
		$sh_file .= 'export '.$index.'="'.$value.'"'.$nl;
	}

	// create php
	$php_file = '<?php'.$nl.'return ['.$nl;
	foreach ($ini as $case => $load) {
		$php_file .= $tb."'".$case."' => [".$nl;
		foreach ($load as $index => $value) {
			if($index == 'TRUSTED_REQUEST_PROXIES_0' || $index == 'GOOGLE_DRIVE.SCOPE_0') {
				$php_file .= $tb.$tb."'".str_replace('_0','',$index)."' => ['".$value."'],".$nl;
			} else $php_file .= $tb.$tb."'".$index."' => '".$value."',".$nl;
		}
		$php_file .= $tb."],".$nl;
	}
	$php_file .= "];".$nl;

	file_put_contents('/webroot/.deploy_configuration.ini', $ini_file);
	file_put_contents('/webroot/.deploy_configuration.sh',  $sh_file);
	file_put_contents('/webroot/.deploy_configuration.php', $php_file);
