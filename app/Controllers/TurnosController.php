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
        $this->app->map(
            ['GET', 'POST', 'HEAD'],
            '/turnos/:document/fecha/:fecha/hora/:hora',
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
            for ($j = 0; $j < 1; $j++) {
                $date = new \DateTime("$i:{$j*30}:00");
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
                $times[] = (string) $state['time'];
            }

            return [
                'success' => true,
                'message' => 'Get your data!',
                'data' => (array) array_diff($this->timesArray(), $times)
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => $e->getMessage(),
              'data' => $data
          ];
        }
    }

    public function takeTurn($document, $date, $time)
    {
        try {
            $date = new \DateTime($date);
            $time = new \DateTime($time);

            $turno = new Turno([
                'documentNumber' => (int) $document,
                'date' => $date->format('Y-m-d'),
                'time' => $time->format('H:i:s')
            ]);

            if (!$turno->exists()) {
                $turno->save();

                return [
                  'success' => true,
                  'message' => "El turno fué agregado con éxito."
                ];
            }

            return [
              'success' => false,
              'message' => "El turno ya existe."
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => "Hubo un problema al realizar la transacción. Pruebe más tarde."
            ];
        }
    }
}
