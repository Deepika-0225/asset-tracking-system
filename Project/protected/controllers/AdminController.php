<?php

class AdminController extends Controller
{
    // Action for rendering the admin page
    public function actionAdmin()
    {
        // Fetch the data for employees, assets, and asset usage
        $employeeData = Employee::model()->findAll();  // Assuming Employee is a model for employee data
        $assetData = Asset::model()->findAll();        // Assuming Asset is a model for asset data
        $assetUsageData = AssetUsage::model()->findAll();  // Assuming AssetUsage is a model for asset usage data

        // Render the 'admin' view and pass the fetched data
        $this->render('admin', array(
            'employeeData' => $employeeData,
            'assetData' => $assetData,
            'assetUsageData' => $assetUsageData,
        ));
    }
}


