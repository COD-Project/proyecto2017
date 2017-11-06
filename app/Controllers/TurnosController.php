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
            ['GET', 'POST'],
            '/turnos/:document/fecha/:fecha/hora/:hora',
            [ $this, 'takeTurn' ]
        );

        $this->app->run();
    }

    public function render()
    {
    }

    public function turns($date)
    {
        return [
            "success" => true,
            "message" => "",
            "data" => [
                $date
            ]
        ];
    }

    public function takeTurn($document, $date, $time)
    {
        try {
            $date = new \DateTime("$date $time");

            Turno::create([
                'documentNumber' => (int) $document,
                'date' => $date->format('Y-m-d H:i:s')
            ]);

            return [
              'success' => true,
              'message' => "El turno fué agregado con éxito."
            ];
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => $e->getMessage()
            ];
        }
    }
}
