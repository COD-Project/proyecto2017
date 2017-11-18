<?php namespace App\Controllers;

use Mbh\Helpers\Functions;
use Mbh\Collection;
use \App\Models\DemographicData;
use \App\Models\ApartamentType;
use \App\Models\HeatingType;
use \App\Models\WaterType;
use \App\Models\Patient;

/**
 * @author Juan Cruz Ocampos
 */

class DemographicdataController extends \App\Controller
{
    public function __construct($app)
    {
        parent::__construct($app, [
          'logged' => true
        ]);

        $this->getDataFromApi();

        $this->app->get('/demographicdata', [ $this, 'render' ]);
        $this->app->post('/demographicdata/create', [ $this, 'createDemographicdata' ]);
        $this->app->post('/demographicdata/edit', [ $this, 'editDemographicdata' ]);
        $this->app->post('/demographicdata/create/patient/:id', [ $this, 'createDemographicdata' ]);
        $this->app->get('/demographicdata/analytics', [ $this, 'showGraphTypes' ]);
        $this->app->get('/demographicdata/analytics/:type', [ $this, 'renderGraph' ]);

        $this->app->run();
    }

    public function render()
    {
        $this->checkPermissions([ 'paciente_index' ]);
        $get = $this->get();

        DemographicData::init();
        $demographicData = DemographicData::all();

        if (count($demographicData) > 0) {
            $demographicData = array_filter($demographicData, function ($each) {
                return $each->isActive();
            });
        }

        $pageNumber = !$get['page'] ? $get['page'] : $get['page'] - 1;
        $from = AMOUNT_PER_PAGE * (int) $pageNumber;

        return $this->template->render('demographicdata/demographicdata.twig', [
          'demographicData' => $demographicData ? array_slice($demographicData, $from, AMOUNT_PER_PAGE) : [],
          'page' => !$get['page'] ? 1 : $get['page'],
          'last_page' => ceil(count($demographicData) / AMOUNT_PER_PAGE)
      ]);
    }

    public function createDemographicdata($id = null)
    {
        $this->checkPermissions([ 'paciente_new' ]);
        try {
            $post = $this->post();
            DemographicData::init();

            $demographicData = DemographicData::create([
              'refrigerator' => (int) ($post['refrigerator'] == "on"),
              'electricity' => (int) ($post['electricity'] == "on"),
              'pet' => (int) ($post['pet'] == "on"),
              'apartamentTypeId' => $post['apartamentTypeId'],
              'heatingTypeId' => $post['heatingTypeId'],
              'waterTypeId' => $post['waterTypeId']
          ]);

            if ($id != null) {
                $patient = Patient::find($id);
                $patient->addState([
                  'demographicDataId' => $demographicData->id()
              ]);
                $patient->edit();
                $this->redirect("patients/show/{$patient->id()}?success=true&message=La operación fue realizada con éxito");

                return;
            }

            $this->redirect("?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("?success=false&message={$e->getMessage()}");
        }
    }

    public function editDemographicdata($id)
    {
        $this->checkPermissions([ 'paciente_update' ]);
        $post = $this->post();
        $demographicData = DemographicData::find($id);

        try {
            $demographicData->addState([
            'refrigerator' => $post['refrigerator'],
            'electricity' => $post['electricity'],
            'pet' => $post['pet'],
            'apartamentTypeId' => $post['apartamentTypeId'],
            'heatingTypeId' => $post['heatingTypeId'],
            'waterTypeId' => $post['waterTypeId']
          ]);

            $demographicData->edit();
            $id = $demographicData->name();

            $this->redirect("demographicdata/show/$id?success=true&message=La operación fue realizada con éxito");
        } catch (\Exception $e) {
            $this->redirect("demographicdata/show/$id?success=false&message={$e->getMessage()}");
        }
    }

    public function showGraphTypes()
    {
        return $this->template->render('demographicdata/analytics.twig', [
            "graphs" => [ "total", "other" ]
        ]);
    }

    public function renderGraph($type)
    {
        $method = "render" . ucwords($type);
        if (method_exists($this, $method)) {
            return $this->{$method}($id);
        }

        $this->redirect("demographicdata?success=false&message=El grafico $type no existe");
    }

    protected function renderTotal()
    {
        $patients = Patient::all();
        $patient_without_dd = Patient::select("count(*) AS count", "datos_demograficos_id IS NULL")[0]["count"];
        $data_for_stats = [
          "total" => count($patients),
          "without" => $patient_without_dd,
          "with" => count($patients) - $patient_without_dd
        ];
        return $data_for_stats;
    }

    protected function mapping(&$data)
    {
        $data = array_map(function ($each) {
            $each = (object) $each;
            return [
              "name" => $each->nombre
          ];
        }, $data);
    }

    protected function getApartamentTypeDataFromApi()
    {
        $ch = curl_init('https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = json_decode($info, true);
            $this->mapping($info);
            ApartamentType::updateWith($info);
        }
        curl_close($ch);

        return $this;
    }

    protected function getHeatingTypeDataFromApi()
    {
        $ch = curl_init('https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = json_decode($info, true);
            $this->mapping($info);
            HeatingType::updateWith($info);
        }
        curl_close($ch);

        return $this;
    }

    protected function getWaterTypeDataFromApi()
    {
        $ch = curl_init('https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-agua');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        if (!curl_errno($ch)) {
            $info = json_decode($info, true);
            $this->mapping($info);
            WaterType::updateWith($info);
        }
        curl_close($ch);

        return $this;
    }

    protected function getDataFromApi()
    {
        $this->getApartamentTypeDataFromApi()
           ->getHeatingTypeDataFromApi()
           ->getWaterTypeDataFromApi();

        return $this;
    }
}
