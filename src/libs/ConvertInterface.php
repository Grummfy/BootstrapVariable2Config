<?php

namespace Grummfy\BVC;

interface ConvertInterface
{
	/**
	 * @param string $source
	 * @param \Closure $destination
	 */
	public function convert($source, \Closure $destination);
}
