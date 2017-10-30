<?php namespace App\Controllers;

/**
 * @author Ulises J. Cornejo Fandos
 */
class TurnosController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/turnos', [ $this, 'render' ]);
        $this->app->get('/turnos/:fecha', [ $this, 'turns' ]);
        $this->app->post(
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
    }

    public function takeTurn($document, $date, $time)
    {
        try {
            Turno::create([
                'documentNumber' => (int) $document,
                'date' => date('Y-m-d H:i:s', "$date $time");
            ]);
        } catch (\Exception $e) {
            return [
              'success' => false,
              'message' => $e->getMessage()
            ];
        }

    }
}
