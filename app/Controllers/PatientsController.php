<?php namespace App\Controllers;

use App\Models\Patient;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */

class PatientsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app);

        $this->app->get('/patients', [ $this, 'render' ]);
        $this->app->get('/patients/show/:id', [ $this, 'show' ]);
        $this->app->get('/patients/create', [ $this, 'add' ]);
        $this->app->post('/patients/create', [ $this, 'createPatient' ]);

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
        return $this->template->render('patient/show.twig', [
            'patient' => $patient
        ]);
    }

    public function add()
    {
        return $this->template->render('patient/create.twig');
    }

    public function createPatient()
    {
        try {
            $post = $this->post();
            Patient::init();
            $patient = Patient::create([
                'firstName' => $post['firstName'],
                'lastName' => $post['lastName'],
                'address' => $post['address'],
                'phone' => $post['phone'],
                'birthday' => date('Y-m-d', $post['birthday']),
                'gender' => $post['gender'],
                'documentTypeId' => $post['documentTypeId'],
                'documentNumber' => $post['documentNumber']
            ]);
            $this->redirect("patients/create?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("patients/create?success=false&message={$e->getMessage()}");
        }
    }
}
