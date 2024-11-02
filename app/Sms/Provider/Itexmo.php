<?php
namespace App\Sms\Provider;

use App\Sms\AbstractProvider;
use Illuminate\Support\Facades\Http;

class Itexmo
{
    public function __construct(protected array $_credentials)
    {}

	public ?string $provider = 'itexmo';
	const END_POINT  = 'https://api.itexmo.com/api/';

	public function send($message, array $recipients)
	{
		if (empty($recipients)) {
			throw new \InvalidArgumentException("Please specify recipient.");
		}

		$response = Http::post(self::END_POINT . 'broadcast', array_merge($this->_credentials, ['Recipients' => $recipients, "Message" => $message]));
	}

	public function sendOtp($code, string $recipient)
	{
		if (empty($recipients)) {
			throw new \InvalidArgumentException("Please specify recipient.");
		}

		$response = Http::post(self::END_POINT . 'broadcast-otp', array_merge($this->_credentials, ['Recipients' => $recipient, "Message" => $code]));
	}
}
