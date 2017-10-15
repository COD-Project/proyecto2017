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

      $this->app->get('/demographicdata', [ $this, 'render' ]);
      $this->app->post('/demographicdata/create', [ $this, 'createDemographicdata' ]);
      $this->app->post('/demographicdata/edit', [ $this, 'editDemographicdata' ]);
      $this->app->post('/demographicdata/create/patient/:id', [ $this, 'createDemographicdata' ]);

      $this->app->router()->run();
  }

  public function render()
  {
      $this->checkPermissions([ 'paciente_index' ]);
      $get = $this->get();

      DemographicData::init();
      $demographicData = DemographicData::all();

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
}
