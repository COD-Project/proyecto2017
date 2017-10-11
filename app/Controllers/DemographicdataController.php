<?php namespace App\Controllers;

use Mbh\Helpers\Functions;
use Mbh\Collection;
use \App\Models\DemographicData;
use \App\Models\ApartamentType;
use \App\Models\HeatingType;
use \App\Models\WaterType;

/**
 * created by Juan Cruz Ocampos
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

      $this->app->router()->run();
  }

  public function render()
  {
      DemographicData::init();
      $demographicDataList = DemographicData::all();

      return $this->template->render('demographicdatalist/demographicdatalist.twig', [
          'demographicDataList' => $demographicDataList
      ]);
  }

  public function createDemographicdata()
  {
      try {
          $post = $this->post();
          DemographicData::init();

          $demographicData = DemographicData::create([
              'refrigerator' => $post['refrigerator'],
              'electricity' => $post['electricity'],
              'pet' => $post['pet'],
              'apartamentTypeId' => $post['apartamentTypeId'],
              'heatingTypeId' => $post['heatingTypeId'],
              'waterTypeId' => $post['waterTypeId']
          ]);

          $this->redirect("?success=true&message=La operación fue realizada con éxito");
      } catch (\Exception $e) {
          $this->redirect("?success=false&message={$e->getMessage()}");
      }
  }

  public function editDemographicdata($id)
  {
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
