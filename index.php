<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$dataFile = dirname(__FILE__) . '/data/ozlotto.db';
NumberGenerator::generate(45, 7, $dataFile);
if(!is_file($dataFile))
	die('No data generated in: ' . $dataFile);