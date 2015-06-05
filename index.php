<?php
require_once dirname(__FILE__) . '/bootstrap.php';

class NumberGenerator
{
	public static function gen($max, $windowSize = 6, $min = 1)
	{
		$candicates = array();
		$numberPool = range($min, $max);
		var_dump($numberPool);
		$combo = array();
		self::_sampling($numberPool, $windowSize, 0);
		var_dump($combo);
	}

	private static function _sampling($numberPool, $windowSize, $startPosition = 0, &$result = array())
	{
		if($windowSize <= 0) {
			var_dump($result);
			return;
		}
		$poolSize = count($numberPool);
		$resultSize = count($result);
		var_dump('$startPosition:' . $startPosition);
		for($i = $startPosition; $i < ($poolSize - $windowSize); $i++) {
			var_dump($i);
			$result[$resultSize - $windowSize] = $numberPool[$i];
			self::_sampling($numberPool, $windowSize-1, $i+1, $result);
		}
	}
}

NumberGenerator::gen(4, 2);