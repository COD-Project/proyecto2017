<?php namespace App\Controllers;

use App\Models\Patient;
use App\Models\DocumentType;
use App\Models\ApartamentType;
use App\Models\SocialWork;
use App\Models\WaterType;
use App\Models\HeatingType;

/**
 * @author Ulises Jeremias Cornejo Fandos
 */

class PatientsController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->getDataFromApi();

        $this->app->map(['GET', 'POST'], '/patients', [ $this, 'render' ]);
        $this->app->get('/patients/show/:id', [ $this, 'show' ]);
        $this->app->get('/patients/create', [ $this, 'add' ]);
        $this->app->post('/patients/create', [ $this, 'createPatient' ]);
        $this->app->post('/patients/edit/:id', [ $this, 'edit' ]);
        $this->app->get('/patients/delete/:id', [ $this, 'delete' ]);

        $this->app->run();
    }

    public function render()
    {
        $this->checkPermissions([ 'paciente_index' ]);
        $get = $this->get();

        Patient::init();
        $patients = Patient::get([
            "firstName" => $get['firstName'] == "" ? null : $get["firstName"],
            "lastName" => $get['lastName'] == "" ? null : $get["lastName"],
            "documentNumber" => $get['documentNumber'] == "" ? null : $get["documentNumber"],
            "documentTypeId" => $get['documentTypeId'] == "" ? null : $get["documentTypeId"],
            "state" => "1"
        ]);
        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        $location = "patients?";
        $location .= !empty($get['firstName'])? "firstName={$get['firstName']}&" : null;
        $location .= !empty($get['lastName'])? "lastName={$get['lastName']}&" : null;
        $location .= !empty($get['documentNumber'])? "documentNumber={$get['documentNumber']}&" : null;
        $location .= !empty($get['documentTypeId'])? "documentTypeId={$get['documentTypeId']}&" : null;
        $location .= "search=true";

        return $this->template->render('patients/patients.twig', [
            'patients' => $patients ? array_slice($patients, $from, AMOUNT_PER_PAGE) : [],
            'page' => !$get['page'] ? 1 : $get['page'],
            'last_page' => ceil(count($patients) / AMOUNT_PER_PAGE),
            'location' => $location,
            'documentTypes' => DocumentType::all()
        ]);
    }

    public function show($id)
    {
        $this->checkPermissions([ 'paciente_show' ]);

        Patient::init();
        $patient = Patient::get([
            "id" => $id,
            "state" => "1"
        ])[0];

        if ($patient) {
            return $this->template->render('patient/show.twig', [
                'patient' => $patient,
                'documentTypes' => DocumentType::all(),
                'socialWorks' => SocialWork::all(),
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
        return $this->template->render('patient/create.twig', [
            "documentTypes" => DocumentType::all(),
            "socialWorks" => SocialWork::all()
        ]);
    }

    public function createPatient()
    {
        $this->checkPermissions([ 'paciente_new' ]);

        try {
            $post = $this->post();
            Patient::init();
            $patient = Patient::get([
                "documentTypeId" => $post['documentTypeId'],
                "documentNumber" => $post['documentNumber'],
                "state" => "0"
            ], 1);
            if ($patient) {
                $patient->addState([
                    "state" => 1
                ]);
                $patient->edit();
                $this->redirect("patients/show/{$patient->id()}?success=true&message=El paciente con número de documento {$patient->documentNumber()} y tipo de documento {$patient->documentType()->name()} fue reactivado. Puede editar su información aquí");
                return;
            }

            $patient = Patient::create([
                'firstName' => $post['firstName'],
                'lastName' => $post['lastName'],
                'address' => $post['address'],
                'phone' => $post['phone'],
                'birthday' => $post['birthday'],
                'gender' => $post['gender'],
                'documentTypeId' => $post['documentTypeId'],
                'documentNumber' => $post['documentNumber'],
                'socialWorkId' => $post['socialWorkId'],
                'state' => 1
            ]);
            $this->redirect("patients/show/{$patient->id()}?success=true&message=La operación fue realizada con éxito");
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

    public function delete($id)
    {
        $this->checkPermissions([ 'paciente_destroy' ]);

        Patient::init();
        $patient = Patient::find($id);
        if ($patient) {
            $patient->remove();
            $this->redirect("patients?success=true&message=La operación fue realizada con éxito");
        } else {
            $this->redirect("?success=false&message=La operación no fue realizada con éxito");
        }
    }

    protected function mapping(&$data)
    {
        $data = array_map(function($each){
            //$each = (object) $each;
            var_dump($each);
            return [
                "name" => $each["nombre"]
            ];
        }, $data);
    }

    protected function getDocumentTypeFromApi()
    {
        $ch = curl_init('https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-documento');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = json_decode($info, true);
            $this->mapping($info);
            DocumentType::updateWith($info);
        }
        curl_close($ch);

        return $this;
    }

    protected function getSocialWorkDataFromApi()
    {
        $ch = curl_init('https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-obra-social');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = json_decode($info, true);
            $this->mapping($info);
            SocialWork::updateWith($info);
        }
        curl_close($ch);

        return $this;
    }

    protected function getDataFromApi()
    {
        $this->getDocumentTypeFromApi()
             ->getSocialWorkDataFromApi();

        return $this;
    }
}
