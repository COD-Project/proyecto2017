<?php namespace App;

/**
 * @author Lucas Di Cunzolo
 */

class Api
{
    const API_TELEGRAM_TOKEN = "453106211:AAHHllrUxxiVp5sFEZqnx7TZnGw6RLQvdsg";
    const API_BOTAN_TRACKER_TOKEN = "";

    public function __construct()
    {
        try {
            $bot = new \TelegramBot\Api\Client(self::API_TELEGRAM_TOKEN);
            $bot->command("turnos", function($message) use($bot){
                $bot->sendMessage($message->getChat()->getId(), serialize($message));
                $date = new DateTime($message);
                $date = $date->format("Y-m-d");
                $info = file_get_contents( URL . "turnos/$date");
                $result = json_decode($info);
                if ($result["success"]) {
                    $result = join("\n", $result["data"]);
                }

                $bot->sendMessage($message->getChat()->getId(), $result);
            });

            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
