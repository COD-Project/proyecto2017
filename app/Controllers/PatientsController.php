<?php namespace App\Controllers;

use App\Models\Patient;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */

class PatientsController extends \App\Controller
{
    function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/patients', [ $this, 'render' ]);
        $this->app->get('/patients/show/:id', [ $this, 'show' ]);

        $this->app->router()->run();
    }

    public function render()
    {
        Patient::init();
        $patients = Patient::all();
        return $this->template->render('patients/patients.twig', [
            'patients' => $patients
        ]);
    }

    public function show($id)
    {
        Patient::init();
        $patient = Patient::find($id);
        return $this->template->render('patients/show.twig', [
            'patient' => $patient
        ]);
    }
}
