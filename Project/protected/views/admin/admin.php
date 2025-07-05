<?php
/* @var $this AdminController */
/* @var $employeeData Employee[] */
/* @var $assetData Asset[] */
/* @var $assetUsageData AssetUsage[] */
?>

<h1>Employee Management</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => new CArrayDataProvider($employeeData),
    'columns' => array(
        'id',
        'name',
        'position',
        // Add other columns as needed
    ),
));
?>

<h1>Asset Management</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => new CArrayDataProvider($assetData),
    'columns' => array(
        'asset_id',
        'name',
        'status',
        // Add other columns as needed
    ),
));
?>

<h1>Asset Usage</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => new CArrayDataProvider($assetUsageData),
    'columns' => array(
        'usage_id',
        'asset_id',
        'user_id',
        'start_date',
        // Add other columns as needed
    ),
));
?>


