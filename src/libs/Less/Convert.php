<?php

namespace Grummfy\BVC\Less;

use Grummfy\BVC\ConvertInterface;

class Convert implements ConvertInterface
{
	public function convert($source, \Closure $destination)
	{
		$rows = array();
		foreach($this->_linesMatch($source) as $line)
		{
			if (!($result = $this->_lineConvert($line)))
			{
				continue;
			}

			$rows[ $result[0] ] = $result[1];
		}

		// save result in array
		return $destination(['vars' => $rows]);
	}

	protected function _linesMatch($source)
	{
		if (preg_match_all('/^@(.*):([\W]*)(.*);.*$/m', $source, $matches, PREG_SET_ORDER))
		{
			return $matches;
		}
		return array();
	}

	protected function _lineConvert($line)
	{
		$line = $this->_lineClean($line);
		$match = $this->_lineMatch($line);

		if (is_null($match))
		{
			return null;
		}

		return $match;
	}

	protected function _lineClean($line)
	{
		$lineRows = array();
		// remove first line with full match
		array_shift($line);

		foreach ($line as $element)
		{
			$row = trim($element);
			if (!empty($row))
			{
				$lineRows[] = $row;
			}
		}

		return $lineRows;
	}

	protected function _lineMatch($line)
	{
		if (count($line) < 2)
		{
			return null;
		}

		$varName = '@' . array_shift($line);
		$varValue = implode($line);

		return [$varName, $varValue];
	}
}
