<?php
namespace App\Sms;

class Provider
{
	public function __construct(protected AbstractProvider $provider)
	{}
	
	public function send()
	{
		$this->provider->send();
	}
}