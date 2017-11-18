<?php namespace App;

/**
 * @author Lucas Di Cunzolo
 */

class Api
{
    const API_TELEGRAM_TOKEN = "456440817:AAFMl9hVYUXeGR8qiDmk4ua2_rphI16l2_w";

    public function __construct()
    {
        try {
            $bot = new \TelegramBot\Api\Client(self::API_TELEGRAM_TOKEN);
            $bot->command("turnos", function($message) use($bot){
                $data = explode(" ", $message->getText());
                $date = new \DateTime($data[1]);
                $ch = curl_init(URL . "turnos/{$date->format('Y-m-d')}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $turns_time = array_map(function($time) {
                    return "- $time";
                },json_decode($info, true)["data"]);

                $response = "Turnos para la fecha {$date->format('d-m-Y')}:\n\n" . join("\n", $turns_time);

                $bot->sendMessage($message->getChat()->getId(), $response);
            });
            $bot->command("reservar", function($message) use($bot){
                $data = explode(" ", $message->getText());
                if (count($data) == 1) {
                    $bot->sendMessage($message->getChat()->getId(), "No se especificaron datos\nVer /help para ayuda");
                    return;
                }
                $dni = $data[1];
                $date = new \DateTime($data[2]);
                $time = new \DateTime($data[3]);

                $ch = curl_init(URL . "turnos/{$dni}/fecha/{$date->format('Y-m-d')}/hora/{$time->format('H:i:s')}/{$message->getChat()->getId()}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $response = json_decode($info, true);

                $bot->sendMessage($message->getChat()->getId(), $response["message"]);
            });
            $bot->command("turnos_activos", function($message) use($bot){
                $data = explode(" ", $message->getText());

                $ch = curl_init(URL . "turnos/activos/user/{$message->getChat()->getId()}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $turns_time = array_map(function($date) {
                    $date = (new \DateTime($date["date"]))->format("d-m-Y");
                    $time = (new \DateTime($date["time"]))->format("H:i");
                    return "$date - $time";
                },json_decode($info, true)["data"]);

                $response = "Turnos activos:\n\n" . join("\n", $turns_time);
                $bot->sendMessage($message->getChat()->getId(), $response);
            });
            $bot->command("turno", function($message) use($bot){
                $data = explode(" ", $message->getText());
                if (empty($data[1])) {
                    $bot->sendMessage($message->getChat()->getId(), "No especificó ningun número de documento");
                    return;
                }

                $ch = curl_init(URL . "turnos/activos/doc/{$data[1]}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $info = curl_exec($ch);
                curl_close($ch);

                $turns_time = array_map(function($date) {
                    $date = (new \DateTime($date["date"]))->format("d-m-Y");
                    $time = (new \DateTime($date["time"]))->format("H:i");
                    return "$date - $time";
                },json_decode($info, true)["data"]);

                $response = "Turnos activos para número de documento {$data[1]}:\n\n" . join("\n", $turns_time);
                $bot->sendMessage($message->getChat()->getId(), $response);
            });
            $bot->command("help", function($message) use($bot){
                $response = "Ayuda\n";
                $response .= "Comandos disponibles:\n";
                $response .= "  - /turnos aaaa-mm-dd\n";
                $response .= "    Se mostraran los turnos disponibles para el dia aaaa-mm-dd\n\n";
                $response .= "  - /reservar dni dd-mm-aaaa hh:mm\n";
                $response .= "    Se reservará un turno para la persona con dni en la fecha y hora especificada\n\n";
                $response .= "  - /turnos_activos\n";
                $response .= "    Se muestran tus turnos activos.\n\n";
                $response .= "  - /turno dni\n";
                $response .= "    Se muestran los turnos activos para la persona con dni especificado";
                $bot->sendMessage($message->getChat()->getId(), $response);

            });
            $bot->run();
        } catch (\TelegramBot\Api\Exception $e) {
            $e->getMessage();
        }
    }
}
