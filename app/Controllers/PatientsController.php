<?php namespace App\Controllers;

use App\Models\Patient;
use App\Models\DocumentType;
use App\Models\ApartamentType;
use App\Models\SocialWork;
use App\Models\WaterType;
use App\Models\HeatingType;

/**
 * created by Ulises Jeremias Cornejo Fandos
 */

class PatientsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->app->get('/patients', [ $this, 'render' ]);
        $this->app->get('/patients/show/:id', [ $this, 'show' ]);
        $this->app->get('/patients/create', [ $this, 'add' ]);
        $this->app->post('/patients/create', [ $this, 'createPatient' ]);
        $this->app->post('/patients/edit/:id', [ $this, 'edit' ]);

        $this->app->router()->run();
    }

    public function render()
    {
        $this->checkPermissions([ 'paciente_index' ]);

        Patient::init();
        $patients = Patient::all();
        return $this->template->render('patients/patients.twig', [
            'patients' => $patients
        ]);
    }

    public function show($id)
    {
        $this->checkPermissions([ 'paciente_show' ]);

        Patient::init();
        SocialWork::init();
        HeatingType::init();
        ApartamentType::init();
        WaterType::init();
        $patient = Patient::find($id);

        if ($patient) {
            return $this->template->render('patient/show.twig', [
                'patient' => $patient,
                'documentsType' => DocumentType::all(),
                'socialWork' => SocialWork::all(),
                'heatingType' => HeatingType::all(),
                'apartamentType' => ApartamentType::all(),
                'waterType' => WaterType::all(),
                'genders' => ["Masculino", "Femenino", "Otro"]
            ]);
        }

        $this->redirect("error/404");
    }

    public function add()
    {
        $this->checkPermissions([ 'paciente_new' ]);

        Patient::init();
        $docuemntsType = DocumentType::all();
        $socialsWork = SocialWork::all();
        return $this->template->render('patient/create.twig', [
            "documentsType" => DocumentType::all(),
            "socialWorks" => SocialWork::all()
        ]);
    }

    public function createPatient()
    {
        $this->checkPermissions([ 'paciente_new' ]);

        try {
            $post = $this->post();
            Patient::init();
            $patient = Patient::create([
                'firstName' => $post['firstName'],
                'lastName' => $post['lastName'],
                'address' => $post['address'],
                'phone' => $post['phone'],
                'birthday' => $post['birthday'],
                'gender' => $post['gender'],
                'documentTypeId' => $post['documentTypeId'],
                'documentNumber' => $post['documentNumber'],
                'socialWorkId' => $post['socialWorkId']
            ]);
            $this->redirect("patients/create?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("patients/create?success=false&message={$e->getMessage()}");
        }
    }

    public function edit($id)
    {
        $this->checkPermissions([ 'paciente_update' ]);

        try {
            $post = $this->post();
            Patient::init();
            $patient = Patient::find($id);
            $patient->addState([
                'firstName' => $post['firstName'],
                'lastName' => $post['lastName'],
                'address' => $post['address'],
                'phone' => $post['phone'],
                'birthday' => $post['birthday'],
                'gender' => $post['gender'],
                'documentTypeId' => $post['documentTypeId'],
                'documentNumber' => $post['documentNumber'],
                'socialWorkId' => $post['socialWorkId']
            ]);
            $patient->edit();
            $this->redirect("patients/show/{$id}?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("patients/show/{$id}?success=false&message={$e->getMessage()}");
        }
    }
}
