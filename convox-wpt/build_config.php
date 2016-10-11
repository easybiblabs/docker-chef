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

	$ini['settings']['DB_WPT_HOST'] = ( $_ENV['DB_HOST']!='' ? $_ENV['DB_HOST']!='' : '172.17.0.2');
	$ini['settings']['DB_WPT_PORT'] = ( $_ENV['DB_PORT']!='' ? $_ENV['DB_PORT']!='' : '3306');
	$ini['settings']['DB_WPT_DATABASE'] = ( $_ENV['DB_DATABASE']!='' ? $_ENV['DB_DATABASE']!='' : 'wpt');
	$ini['settings']['DB_WPT_USERNAME'] = ( $_ENV['DB_USERNAME']!='' ? $_ENV['DB_USERNAME']!='' : 'vagrant');
	$ini['settings']['DB_WPT_PASSWORD'] = ( $_ENV['DB_PASSWORD']!='' ? $_ENV['DB_PASSWORD']!='' : 'pasword');

	$ini['settings']['AWS_S3_KEY'] = ( $_ENV['S3_USERNAME']!='' ? $_ENV['S3_USERNAME']!='' : 'vagrant');
	$ini['settings']['AWS_S3_SECRET'] = ( $_ENV['S3_PASSWORD']!='' ? $_ENV['S3_PASSWORD']!='' : 'pasword');
	$ini['settings']['AWS_S3_BUCKET'] = ( $_ENV['S3_BUCKET']!='' ? $_ENV['S3_BUCKET']!='' : 'wpt');
	$ini['settings']['AWS_S3_REGION'] = ( $_ENV['S3_REGION']!='' ? $_ENV['S3_REGION']!='' : 'us-east-1');
	$ini['settings']['AWS_S3_VERSION'] = ( $_ENV['S3_VERSION']!='' ? $_ENV['S3_VERSION']!='' : '2006-03-01');
	$ini['settings']['AWS_S3_ENDPOINT'] = ( $_ENV['S3_URL']!='' ? str_replace ( 'tcp://', 'http://', $_ENV['S3_URL'] ) : 'http://172.17.0.8:4568');

	$ini['settings']['AWS_SQS_KEY'] = ( $_ENV['S3_USERNAME']!='' ? $_ENV['S3_USERNAME']!='' : 'vagrant');
	$ini['settings']['AWS_SQS_SECRET'] = ( $_ENV['SQS_PASSWORD']!='' ? $_ENV['SQS_PASSWORD']!='' : 'pasword');
	$ini['settings']['AWS_SQS_REGION'] = ( $_ENV['SQS_REGION']!='' ? $_ENV['SQS_REGION']!='' : 'us-east-1');
	$ini['settings']['AWS_SQS_ENDPOINT'] = ( $_ENV['SQS_URL']!='' ? str_replace ( 'sqs://', 'http://', $_ENV['SQS_URL']) : 'http://172.17.0.6:80');

	$ini['settings']['REDIS_HOST'] = ( $_ENV['REDIS_URL']!='' ? str_replace ( 'redis://', 'http://', $_ENV['REDIS_URL']) : 'http://vagrant:password@172.17.0.4:6379/0');


	$nl = "\n";
	$tb = "\t";
	// create ini
	$ini_file = '';
	foreach ($ini as $case => $load) {
		$ini_file .= '['.$case.']'.$nl;
		foreach ($load as $index => $value) {
			$ini_file .= $index.' = "'.$value.'"'.$nl;
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
			$php_file .= $tb.$tb."'".$index."' => '".$value."',".$nl;
		}
		$php_file .= $tb."],".$nl;
	}
	$php_file .= "];".$nl;

	file_put_contents('/webroot/.deploy_configuration.ini', $ini_file);
	file_put_contents('/webroot/.deploy_configuration.sh',  $sh_file);
	file_put_contents('/webroot/.deploy_configuration.php', $php_file);
