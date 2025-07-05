<?php

class AssetUsageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
                        array('allow',
                            'actions'=>array('view'),
				'users'=>array('admin'),
                        ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Enddate'),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin', 'delete', and 'endUsage' actions
                                'actions'=>array('admin','delete','endUsage'),
                                'users'=>array('admin'),
                        ),
                    
                        array('allow',
                                'actions' => array('dynamicAssets'),
                                'users' => array('@'),
                        ),
                    
                        array('allow',
                                'actions' => array('Daterange'),
                                'users' => array('admin'),
                        ),
                    
			array('deny',  // deny all users
				'users'=>array('*'),
                                'deniedCallback' => function() 
                                {
                                    Yii::app()->user->setFlash('error', 'Only admins can update assets.');
                                    Yii::app()->controller->redirect(Yii::app()->homeUrl);
                                },
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AssetUsage('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AssetUsage']))
		{
//                      print_R($_POST);exit;

                        $model->asset_type_id=$_POST['AssetUsage']['asset_type_id'];
                        $model->attributes=$_POST['AssetUsage'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $model->asset_type_id = $model->asset->asset_type_id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AssetUsage']))
		{
			$model->attributes=$_POST['AssetUsage'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AssetUsage');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AssetUsage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AssetUsage']))
			$model->attributes=$_GET['AssetUsage'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AssetUsage the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AssetUsage::model()->with('asset')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AssetUsage $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='asset-usage-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
         public function actionStart() 
        {
            $model = new AssetUsage;
            if (isset($_POST['AssetUsage'])) 
            {
                $model->attributes = $_POST['AssetUsage'];
                $model->start_date = new CDbExpression('NOW()');
                if (empty($model->end_date)) 
                {
                    $model->end_date = null;
                } 
                else 
                {
                    $model->end_date = date('Y-m-d', strtotime($model->end_date));
                }

                if ($model->save()) 
                {
                    $this->redirect(['index']);
                } 
                else 
                {
                    var_dump($model->getErrors()); 
                }
            }
            $this->render('start', [
                'model' => $model,
                'assets' => CHtml::listData(Asset::model()->findAll(), 'id', 'asset_type'),
                'employees' => CHtml::listData(Employee::model()->findAllByAttributes(['is_active'=>1]), 'id', 'name'),
                'locations' => CHtml::listData(LocationMaster::model()->findAll(), 'id', 'name'),
            ]);
        }

        public function actionEnd($id)    // end date report
        {
            $model = $this->loadModel($id);
            $model->end_date = new CDbExpression('NOW()');
            if ($model->save()) 
            {
                $this->redirect(['index']);
            } 
            else 
            {
                var_dump($model->getErrors());
                Yii::app()->end();
            }
        }        
        
        public function actionEnddate($id)
        {
            $model = $this->loadModel($id);
            $model->scenario = 'enddate';

            if (isset($_POST['AssetUsage'])) 
            {
                $model->attributes = $_POST['AssetUsage']; 
                if ($model->save()) 
                {
                    $this->redirect(array('view', 'id' => $model->id));
                } 
                else 
                {
                    var_dump($model->getErrors());
                }
            }
            
            $this->render('enddate', array(
                'model' => $model,
            ));
        }
           
        public function actionDynamicAssets()
        {
            if (isset($_POST['asset_type_id']))   // for AssetType and assets list dropdown 
            {
                $assetTypeId = (int) $_POST['asset_type_id'];
                $selectedAssetId = isset($_POST['selectedAssetId']) ? $_POST['selectedAssetId'] : NULL;
                
                $assets = Asset::model()->findAllByAttributes(['asset_type_id' => $assetTypeId]);

                $data = CHtml::listData($assets, 'id', 'asset_type');

                foreach ($data as $value => $name) 
                {
                    if($selectedAssetId==$value)
                        echo CHtml::tag('option', ['value' => $value, 'selected' => true], CHtml::encode($name), true);   // already selected one 
                    else
                        echo CHtml::tag('option', ['value' => $value], CHtml::encode($name), true);
                }
            } 
        }    
        
        
        public function actionDaterange()
        {
            if (isset($_POST['mode'])) 
            {
                $mode = $_POST['mode'];
                $db = Yii::app()->db;

                if ($mode === 'range') 
                {
                    if (empty($_POST['start_date']) || empty($_POST['end_date'])) 
                    {
                        Yii::app()->user->setFlash('error', 'Start Date and End Date are required.');
                        $this->redirect(array('daterange'));
                        return;
                    }

                    $start = date('Y-m-d', strtotime($_POST['start_date']));
                    $end = date('Y-m-d', strtotime($_POST['end_date']));

                    $command = $db->createCommand()
                        ->select([
                            'au.id',
                            'at.types AS asset_type',
                            'a.asset_type AS asset_id',
                            'e.name AS employee_name',
                            'au.start_date',
                            'au.end_date',
                            'au.is_taken_out_of_office',
                            'a.status',
                            'l.name AS location_name'
                        ])
                        ->from('AssetUsage au')
                        ->leftJoin('asset a', 'a.id = au.asset_id')
                        ->leftJoin('Employee e', 'e.id = au.employee_id')
                        ->leftJoin('AssetType at', 'at.id = a.asset_type_id')
                        ->leftJoin('LocationMaster l', 'l.id = au.location_id')
                        ->where('au.start_date BETWEEN :start AND :end OR au.end_date BETWEEN :start AND :end', [
                            ':start' => $start,
                            ':end' => $end
                        ]);

                    $usages = $command->queryAll();
                }

                elseif ($mode === 'asof') 
                {
                    if (empty($_POST['as_of_date'])) 
                    {
                        Yii::app()->user->setFlash('error', 'As Of Date is required.');
                        $this->redirect(array('daterange'));
                        return;
                    }

                    $asOfDate = date('Y-m-d', strtotime($_POST['as_of_date']));

                    $command = $db->createCommand()
                        ->select([
                            'au.id',
                            'at.types AS asset_type',
                            'a.asset_type AS asset_id',
                            'e.name AS employee_name',
                            'au.start_date',
                            'au.end_date',
                            'au.is_taken_out_of_office',
                            'a.status',
                            'l.name AS location_name'
                        ])
                        ->from('AssetUsage au')
                        ->leftJoin('asset a', 'a.id = au.asset_id')
                        ->leftJoin('Employee e', 'e.id = au.employee_id')
                        ->leftJoin('AssetType at', 'at.id = a.asset_type_id')
                        ->leftJoin('LocationMaster l', 'l.id = au.location_id')
                        ->where('au.start_date <= :asof AND (au.end_date IS NULL OR au.end_date >= :asof)', [
                            ':asof' => $asOfDate
                        ]);

                    $usedSQL = $command->getText();
                    $params = $command->params;

                    $unusedQuery = "
                        SELECT 
                            NULL AS id,
                            at.types AS asset_type,
                            a.asset_type AS asset_id,
                            NULL AS employee_name,
                            NULL AS start_date,
                            NULL AS end_date,
                            NULL AS is_taken_out_of_office,
                            a.status,
                            NULL AS location_name
                        FROM asset a
                        JOIN AssetType at ON at.id = a.asset_type_id
                        WHERE a.id NOT IN (SELECT DISTINCT asset_id FROM AssetUsage)
                    ";

                    $finalSQL = "($usedSQL) UNION ($unusedQuery)";
                    $command = $db->createCommand($finalSQL);
                    $command->bindValues($params);

                    $usages = $command->queryAll();
                }

                else 
                {
                    Yii::app()->user->setFlash('error', 'Invalid report mode.');
                    $this->redirect(array('daterange'));
                    return;
                }

               
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename=AssetUsageReport.csv');
                $fp = fopen('php://output', 'w');

                fputcsv($fp, ['Asset Type', 'Assets', 'Employee Name', 'Start Date', 'End Date', 'Taken Out of Office', 'Status', 'Location']);

                foreach ($usages as $row) 
                {
                    fputcsv($fp, [
                        $row['asset_type'] ?? '',
                        $row['asset_id'] ?? '',
                        $row['employee_name'] ?? '',
                        $row['start_date'] ? date('d-m-Y', strtotime($row['start_date'])) : '',
                        $row['end_date'] ? date('d-m-Y', strtotime($row['end_date'])) : '',
                        $row['is_taken_out_of_office'] ? 'Yes' : 'No',
                        $row['status'] ?? '',
                        $row['location_name'] ?? ''
                    ]);
                }

                fclose($fp);
                Yii::app()->end();
            }

            $this->render('daterange');
        }



}

