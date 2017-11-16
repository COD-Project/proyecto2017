<?php namespace App\Controllers;

use App\Models\HealthControl;
use App\Models\Patient;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */
class HealthcontrolsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/healthcontrol/show/:id', [ $this, 'show']);
        $this->app->get('/healthcontrol/create/patient/:id', [ $this, 'add']);
        $this->app->post('/healthcontrol/create', [ $this, 'createHealthControl']);
        $this->app->post('/healthcontrol/edit/:id', [ $this, 'edit']);
        $this->app->post('/healthcontrol/delete/:id', [ $this, 'delete']);

        $this->app->run();
    }

    public function show($id)
    {
        $this->checkPermissions([ 'paciente_show' ]);

        HealthControl::init();
        $healthControl = HealthControl::find($id);

        if ($healthControl) {
            return $this->template->render('healthcontrol/show.twig', [
                'healthControl' => $healthControl,
                'patient' => $healthControl->patient()
            ]);
        }

        $this->redirect("error/404");
    }

    public function add($patientId)
    {
        $this->checkPermissions([ 'paciente_new' ]);

        Patient::init();
        $patient = Patient::get([
            "id" => $patientId,
            "state" => "1"
        ])[0];

        if ($patient) {
            return $this->template->render('healthcontrol/create.twig', [
                'patient' => $patient
            ]);
        }

        $this->redirect("error/404");
    }

    public function createHealthControl()
    {
        $this->checkPermissions([ 'paciente_new' ]);

        try {
            $post = $this->post();

            HealthControl::init();
            $healthControl = HealthControl::create([
                'weight' => $post['weight'],
                'completeVaccines' => $post['completeVaccines'],
                'vaccinesObservations' => $post['vaccinesObservations'],
                'maturationAccording' => $post['maturationAccording'],
                'maturationObservations' => $post['maturationObservations'],
                'physicalExam' => $post['physicalExam'],
                'physicalExamObservations' => $post['physicalExamObservations'],
                'cephalicPercentile' => $post['cephalicPercentile'],
                'percentileCephalicPerimeter' => $post['percentileCephalicPerimeter'],
                'size' => $post['size'],
                'alimentation' => $post['alimentation'],
                'generalObservations' => $post['generalObservations'],
                'patientId' => $post['patientId'],
                'userId' => $post['userId']
            ]);

            $this->redirect("healthcontrol/show/patient/{$healthControl->patient->id()}?success=true&message=La operación fue realizada con éxito.")
        } catch (\Exception $e) {
            $this->redirect("healthcontrol/create/patient/{$post['patientId']}?success=false&message={$e->getMessage()}")
        }
    }

    public function edit($id)
    {
        $this->checkPermissions([ 'paciente_update' ]);

        try {
            $post = $this->post();

            HealthControl::init();
            $healthControl = HealthControl::find($id);

            $healthControl->addState([
                'weight' => $post['weight'],
                'completeVaccines' => $post['completeVaccines'],
                'vaccinesObservations' => $post['vaccinesObservations'],
                'maturationAccording' => $post['maturationAccording'],
                'maturationObservations' => $post['maturationObservations'],
                'physicalExam' => $post['physicalExam'],
                'physicalExamObservations' => $post['physicalExamObservations'],
                'cephalicPercentile' => $post['cephalicPercentile'],
                'percentileCephalicPerimeter' => $post['percentileCephalicPerimeter'],
                'size' => $post['size'],
                'alimentation' => $post['alimentation'],
                'generalObservations' => $post['generalObservations']
            ]);

            $healthControl->edit();

            $this->redirect("healthcontrol/show/patient/{$healthControl->patient->id()}?success=true&message=La operación fue realizada con éxito.")
        } catch (\Exception $e) {
            $this->redirect("healthcontrol/show/patient/{$post['patientId']}?success=false&message={$e->getMessage()}")
        }
    }

    public function delete($id)
    {
        $this->checkPermissions([ 'paciente_destroy' ]);

        HealthControl::init();
        $healthControl = HealthControl::find($id);

        if ($healthControl) {
            $patientId = $healthControl->patient->id();
            $healthControl->remove();
            $this->redirect("patients/show/{$patientId}?success=true&message=La operación fue realizada con éxito.")
        } else {
            $this->redirect("?success=false&message=Hubo un fallo en la operación.")
        }
    }
}
