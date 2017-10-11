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
      $this->app->get('/demographicdata/show/:id', [ $this, 'show' ]);
      $this->app->get('/demographicdata/create', [ $this, 'add' ]);
      $this->app->post('/demographicdata/create', [ $this, 'createDemographicdata' ]);
      $this->app->get('/demographicdata/edit/:id', [ $this, 'edit' ]);
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

  public function show($id)
  {
      DemographicData::init();
      $demographicData = DemographicData::find($id);

      return $this->template->render('demographicdata/show.twig', [
          'demographicData' => $demographicData
      ]);
  }

  public function add()
  {
      ApartamentType::init();
      $apartamentTypes = ApartamentType::all();
      HeatingType::init();
      $heatingTypes = HeatingType::all();
      WaterType::init();
      $waterTypes = WaterType::all();

      return $this->template->render('demographicdata/create.twig', [
          'apartamentTypes' => $apartamentTypes,
          'heatingTypes' => $heatingTypes,
          'waterTypes' => $waterTypes
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

          $this->redirect("demographicdata/create?success=true&message=La operación fue realizada con éxito");
      } catch (\Exception $e) {
          $this->redirect("demographicdata/create?success=false&message={$e->getMessage()}");
      }
  }

  public function edit($id)
  {
      DemographicData::init();
      $demographicData = DemographicData::find($id);
      ApartamentType::init();
      $apartamentTypes = ApartamentType::all();
      HeatingType::init();
      $heatingTypes = HeatingType::all();
      WaterType::init();
      $waterTypes = WaterType::all();

      return $this->template->render('demographicdata/edit.twig', [
          'demographicData' => $demographicData,
          'apartamentTypes' => $apartamentTypes,
          'heatingTypes' => $heatingTypes,
          'waterTypes' => $waterTypes
      ]);
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