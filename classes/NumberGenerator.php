<?php

class NumberGenerator
{
	/**
	 * Generating the
	 * @param unknown $max
	 * @param number $windowSize
	 * @param number $min
	 */
	public static function generate($max, $windowSize = 6, $filePath = '')
	{
		ini_set('max_execution_time', 0);
		$numberPool = range(1, $max);
		$results = array();
		self::_sampling($numberPool, $windowSize, $results);
		$return = array_keys($results);
		if($filePath !== '')
			file_put_contents($filePath, implode("\n", $return));
		return $return;
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
	private static function _sampling($items, $windowSize, array &$results = array(), $perms = array())
	{
		if(count($perms) === $windowSize) {
			sort($perms);
			if(!array_key_exists(($key = join(',', $perms)), $results))
				$results[$key] = $perms;
		}
		if (!empty ( $items )) {
			for($i = count ( $items ) - 1; $i >= 0; -- $i) {
				$newitems = $items;
				$newperms = $perms;
				list ( $foo ) = array_splice ( $newitems, $i, 1 );
				array_unshift ( $newperms, $foo );
				self::_sampling ( $newitems, $windowSize, $results, $newperms);
			}
		}
	}
}