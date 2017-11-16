<?php namespace App;

/**
 * @author Lucas Di Cunzolo
 */

class Api
{
    const API_TELEGRAM_TOKEN = "431938628:AAEMPLLdNleqotvUaHeZs8Oc66o2YMn8QWc";
    const API_BOTAN_TRACKER_TOKEN = "";

    public function __construct()
    {
        try {
            $bot = new \TelegramBot\Api\Client(self::API_TELEGRAM_TOKEN);
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
