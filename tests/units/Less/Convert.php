<?php

namespace Grummfy\BVC\tests\units\Less;

use Grummfy\BVC\ConvertInterface;

class Convert extends \atoum\test
{
	public function testConvertWithLineBreak()
	{
		$destination = function($rows)
		{
			return $rows['vars'];
		};
		$sourceString = <<<EOF
@gray-base:
  #000;
@gray-dark:              #7b8a8b;
EOF;

		$this->newTestedInstance();
		$this->array($this->testedInstance->convert($sourceString, $destination))
			->isEqualTo([
				'@gray-base'    => '#000',
				'@gray-dark'    => '#7b8a8b'
			]);
	}

	public function testConvertWithComment()
	{
		$destination = function($rows)
		{
			return $rows['vars'];
		};
		$sourceString = <<<EOF


//== Colors
//
//## Gray and brand colors for use across Bootstrap.

@gray-base:   #000;
@gray-darker:            lighten(@gray-base, 13.5%); // #222
EOF;

		$this->newTestedInstance();
		$this->array($this->testedInstance->convert($sourceString, $destination))
			->isEqualTo([
				'@gray-base'    => '#000',
				'@gray-darker'  => 'lighten(@gray-base, 13.5%)'
			]);
	}
}
