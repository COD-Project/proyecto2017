<?php namespace App\Controllers;

use Mbh\Collection;
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

        $this->app->get('/healthcontrols', [$this, 'indexAction']);
        $this->app->get('/healthcontrols/show/:id', [ $this, 'showAction']);
        $this->app->get('/healthcontrols/create/patient/:id', [ $this, 'addAction']);
        $this->app->get('/healthcontrols/analytics/:sex/:type', [ $this, 'getHealthcontrolsAction']);
        $this->app->get('/healthcontrols/analytics', [ $this, 'renderAnalytictsAction']);
        $this->app->get('/healthcontrols/delete/:id', [ $this, 'deleteAction']);
        $this->app->post('/healthcontrols/create/patient/:id', [ $this, 'createAction']);
        $this->app->post('/healthcontrols/edit/:id', [ $this, 'editAction']);

        $this->app->run();
    }

    public function indexAction()
    {
        $get = $this->get();

        $healthcontrols = HealthControl::all();

        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        return $this->template->render('healthcontrols/healthcontrols.twig', [
          'healthcontrols' => $healthcontrols ? array_slice($healthcontrols, $from, AMOUNT_PER_PAGE) : [],
          'page' => !$get['page'] ? 1 : $get['page'],
          'last_page' => ceil(count($healthcontrols) / AMOUNT_PER_PAGE),
          'location' => "healthcontrols"
      ]);
    }

    public function showAction($id)
    {
        $this->checkPermissions([ 'control_salud_show' ]);

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

    public function addAction($patientId)
    {
        $this->checkPermissions([ 'control_salud_new' ]);

        Patient::init();
        $patients = new Collection(Patient::get([
            "id" => $patientId,
            "state" => "1"
        ]));

        if ($patient = $patients->get(0)) {
            return $this->template->render('healthcontrol/create.twig', [
                'patient' => $patient
            ]);
        }

        $this->redirect("error/404");
    }

    public function createAction($id)
    {
        $this->checkPermissions([ 'control_salud_new' ]);

        try {
            $post = $this->post();

            HealthControl::init();
            $healthControl = HealthControl::create([
                'date' => (new \DateTime)->format('Y-m-d'),
                'weight' => $post['weight'],
                'completeVaccines' => (string)(int)($post['completeVaccines'] == 'on'),
                'vaccinesObservations' => $post['vaccinesObservations'],
                'accordingMaturationContext' => (string)(int)($post['accordingMaturationContext'] == 'on'),
                'maturationObservations' => $post['maturationObservations'],
                'commonPhysicalExamination' => (string)(int)($post['commonPhysicalExamination'] == 'on'),
                'physicalExaminationObservations' => $post['physicalExaminationObservations'],
                'pc' => $post['cephalicPercentile'],
                'ppc' => $post['cephalicPercentilePerimeter'],
                'height' => $post['height'],
                'feeding' => $post['feeding'],
                'generalObservations' => $post['generalObservations'],
                'patientId' => $id,
                'userId' => $this->session->sessionInUse()->id()
            ]);

            $this->redirect("healthcontrols?success=true&message=La operación fue realizada con éxito.");
        } catch (\Exception $e) {
            $this->redirect("healthcontrols/create/patient/$id?success=false&message={$e->getMessage()}");
        }
    }

    public function editAction($id)
    {
        $this->checkPermissions([ 'control_salud_update' ]);

        try {
            $post = $this->post();

            HealthControl::init();
            $healthControl = HealthControl::find($id);

            $healthControl->addState([
                'weight' => $post['weight'],
                'completeVaccines' => (string)(int)($post['completeVaccines'] == 'on'),
                'vaccinesObservations' => $post['vaccinesObservations'],
                'accordingMaturationContext' => (string)(int)($post['accordingMaturationContext'] == 'on'),
                'maturationObservations' => $post['maturationObservations'],
                'commonPhysicalExamination' => (string)(int)($post['commonPhysicalExamination'] == 'on'),
                'physicalExaminationObservations' => $post['physicalExaminationObservations'],
                'pc' => $post['pc'],
                'ppc' => $post['ppc'],
                'height' => $post['height'],
                'feeding' => $post['feeding'],
                'generalObservations' => $post['generalObservations']
            ]);

            $healthControl->edit();

            $this->redirect("healthcontrols/show/{$healthControl->patient()->id()}?success=true&message=La operación fue realizada con éxito.");
        } catch (\Exception $e) {
            $this->redirect("healthcontrols/show/{$post['patientId']}?success=false&message={$e->getMessage()}");
        }
    }

    public function deleteAction($id)
    {
        try {
            $this->checkPermissions([ 'control_salud_destroy' ]);

            HealthControl::init();
            $healthControl = HealthControl::find($id);

            $patientId = $healthControl->patient()->id();
            $healthControl->remove();
            $this->redirect("patients/show/{$patientId}?success=true&message=La operación fue realizada con éxito.");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message=Hubo un fallo en la operación.");
        }
    }

    public function getHealthcontrolsAction($sex, $type)
    {
        if (!in_array($type, ['ppc', 'weight', 'height'])) {
            return;
        }

        $method = "healthcontrols" . ucwords($type);
        $patients = Patient::get([
            'gender' => ucwords($sex)
        ]);

        $data = [];

        foreach ($patients as $key => $value) {
            $healthcontrols = HealthControl::findBy($value->id(), 'patientId');
            $data[] = [
                'name' => 'paciente#' . $value->id(),
                'data' => $this->{$method}($healthcontrols)
            ];
        }

        return [
            "success" => true,
            "message" => "Get your data!",
            "data" => $data
        ];
    }

    protected function healthcontrolsPpc($data)
    {
        return array_map(function ($each) {
            return [
                (int) $each->age(),
                floatval($each->ppc())
            ];
        }, $data);
    }

    protected function healthcontrolsWeight($data)
    {
        return array_map(function ($each) {
            return [
                (int) $each->age(),
                floatval($each->weight())
            ];
        }, $data);
    }

    protected function healthcontrolsHeight($data)
    {
        return array_map(function ($each) {
            return [
                floatval($each->height()),
                floatval($each->weight())
            ];
        }, $data);
    }

    public function renderAnalytictsAction()
    {
        return $this->template->render('healthcontrols/analytics.twig');
    }
}
