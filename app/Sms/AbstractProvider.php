<?php
namespace App\Sms;

abstract class AbstractProvider
{
	private const CONFIG_FILE = __DIR__ . '../../../' . 'sms-provider-config.json';
	public ?string $provider = null;
	protected $_config = [];
	public function __construct(protected array $_data = [])
	{
		$this->_initConfig();
	}
	
	private function _initConfig()
	{
		if (! file_exists( self::CONFIG_FILE)) {
			throw new \InvalidArgumentException("config file not found !");
		}
		
		$providers = json_decode(file_get_contents(self::CONFIG_FILE), true);
		if (! array_key_exists($this->provider, $providers)) {
			throw new \InvalidArgumentException("Invalid provider: " . $this->provider);
		}
		
		$this->_config = $providers[$this->provider];
	}
	
	abstract public function send($message, array $recipients);
	abstract public function sendOtp($code, string $recipient);
}