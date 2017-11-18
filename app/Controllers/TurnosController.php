<?php namespace App\Controllers;

use App\Models\Turno;

/**
 * @author Ulises J. Cornejo Fandos
 */
class TurnosController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/turnos', [ $this, 'render' ]);
        $this->app->get('/turnos/:fecha', [ $this, 'turns' ]);
        $this->app->get('/turnos/activos/user/:id', [ $this, 'turnsForUser' ]);
        $this->app->get('/turnos/activos/doc/:doc', [ $this, 'turnsForDocumentNumber' ]);
        $this->app->get(
            '/turnos/:document/fecha/:fecha/hora/:hora',
            [ $this, 'takeTurn' ]
        );
        $this->app->get(
            '/turnos/:document/fecha/:fecha/hora/:hora/:chat_id',
            [ $this, 'takeTurn' ]
        );

        $this->app->run();
    }

    public function render()
    {
    }

    private function timesArray()
    {
        for ($i = 8; $i < 19; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $k = (int) $j * 30;
                $date = new \DateTime("$i:{$k}:00");
                $times[] = (string) $date->format("H:i:s");
            }
        }

        return $times;
    }

    public function turns($date)
    {
        try {
            $models = Turno::findBy($date, 'date');

            $times = [];

            foreach ($models as $key => $value) {
                $state = $value->getState();
                $times[] = $state['time'];
            }

            return [
                'success' => true,
                'message' => 'Get your data!',
                'data' => array_values(array_diff($this->timesArray(), $times))
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => $e->getMessage(),
              'data' => $data
          ];
        }
    }

    public function takeTurn($document, $date, $time, $chat_id = 0)
    {
        try {
            $date = new \DateTime($date);
            $time = new \DateTime($time);

            if (!in_array($time->format('H:i:s'), $this->timesArray())) {
                throw new \InvalidArgumentException("El horario elegido es incorrecto");
            }

            $turno = new Turno([
                'documentNumber' => (int) $document,
                'date' => $date->format('Y-m-d'),
                'time' => $time->format('H:i:s'),
                'chatId' => $chat_id
            ]);

            if (!$turno->exists()) {
                $turno->save();

                return [
                  'success' => true,
                  'message' => "El turno fué agregado con éxito."
                ];
            }

            throw new \InvalidArgumentException("El turno ya existe");
        } catch (\InvalidArgumentException $e) {
            return [
              'success' => false,
              'message' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => "Hubo un problema al realizar la transacción. Pruebe más tarde."
            ];
        }
    }

    public function turnsForUser($id)
    {
        try {
            $date = (new \DateTime())->format('Y-m-d');

            $turnos = Turno::select("fecha, horario", "chat_id=$id AND fecha >= DATE '$date'");

            return [
                "success" => true,
                "message" => "Get your data!",
                "data" => array_map(function ($turno) {
                    return [
                        "date" => $turno['fecha'],
                        "time" => $turno['horario']
                    ];
                }, $turnos)
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Hubo un problema al realizar la transacción. Pruebe más tarde.",
                "data" => []
            ];
        }
    }

    public function turnsForDocumentNumber($doc)
    {
        try {
            $date = (new \DateTime())->format('Y-m-d');

            $turnos = Turno::select("fecha, horario", "numero_doc=$doc AND fecha >= DATE '$date'");

            return [
                "success" => true,
                "message" => "Get your data!",
                "data" => array_map(function ($turno) {
                    return [
                        "date" => $turno['fecha'],
                        "time" => $turno['horario']
                    ];
                }, $turnos)
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Hubo un problema al realizar la transacción. Pruebe más tarde.",
                "data" => []
            ];
        }
    }
}
