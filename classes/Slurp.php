<?php

namespace slurp;

use GuzzleHttp\Client;

class Slurp {

	// bring user config options + CLI parameters
	function __construct($config, $params) {
		$this->config = $config;
		$this->params = $params;
	}

	// main functionality
	public function run() {

		if(!isset($this->params[1])) {
			return "Missing URL parameter \n";
		}

		$url = $this->params[1];

		// Directory check
		if (file_exists(rtrim($this->config->directory, "/")) &&
			!is_dir($this->config->directory))
		{
			return "Couldn't create save directory \"{$this->config->directory}\" because a file exists with that name. \n";
		}
		else if (!is_dir($this->config->directory)) {
			mkdir($this->config->directory);
		}

		$client = new client([
			'base_uri' => $url,
			'timeout' => 2
		]);

		$response = $client->request('GET');
		$body = $response->getBody();

		file_put_contents($this->config->directory . parse_url($url,  PHP_URL_HOST) . ".html", (string) $body);

		return "huzzah! \n";
	}
}