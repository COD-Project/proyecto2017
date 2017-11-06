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
                $data = explode(" ", $message->getText());
                $info = file_get_contents( URL . "turnos/{$data[1]}", false, [
                    "http" => [
                        "method" => "GET"
                    ]
                ]);
                $result = json_decode($info, true);
                if ($result["success"] && false) {
                    $result = join(PHP_EOL, $result["data"]);
                }

                $bot->sendMessage($message->getChat()->getId(), $result);
            });

            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
