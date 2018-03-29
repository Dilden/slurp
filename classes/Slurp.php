<?php

namespace slurp;

class Slurp {

	function __construct($config) {
		$this->config = $config;
	}

	public function run() {
		foreach($this->config as $conf) {
			echo $conf . "\n";
		}
		return "huzzah \n";
	}
}