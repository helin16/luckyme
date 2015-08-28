<?php

class NumberGenerator
{
	/**
	 * Generating the
	 * @param unknown $max
	 * @param number $windowSize
	 * @param number $min
	 */
	public static function generate($max, $windowSize, $filePath)
	{
		ini_set('max_execution_time', 0);
		$numberPool = range(1, $max);
		file_put_contents($filePath, '');
		self::_sampling($numberPool, $windowSize, $filePath);
	}
	/**
	 * Generating the numbers, self looping
	 *
	 * @param unknown $items
	 * @param unknown $windowSize
	 * @param array $results
	 * @param unknown $perms
	 *
	 */
	private static function _sampling($items, $windowSize, $filePath, array &$results = array(), $perms = array())
	{
		if(count($perms) === $windowSize) {
			sort($perms);
			$combo = $key = join(',', $perms);
			if(!in_array($combo, $results)) {
				$results[] = $combo;
				file_put_contents($filePath, $combo . "\n", FILE_APPEND);
			}
		}
		if (!empty ( $items )) {
			for($i = count ( $items ) - 1; $i >= 0; -- $i) {
				$newitems = $items;
				$newperms = $perms;
				list ( $foo ) = array_splice ( $newitems, $i, 1 );
				array_unshift ( $newperms, $foo );
				self::_sampling ( $newitems, $windowSize, $filePath, $results, $newperms);
			}
		}
	}
}