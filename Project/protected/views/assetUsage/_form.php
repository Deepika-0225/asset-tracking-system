<?php
/* @var $this AssetUsageController */
/* @var $model AssetUsage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'asset-usage-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>


        <!--    Asset Type Dropdown -->        
        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
                <?php echo $form->labelEx($model, 'asset_type_id', array('style' => 'width: 100px;')); ?>
                <?php echo $form->dropDownList(
                        $model,
                        'asset_type_id',
                        CHtml::listData(
                            AssetType::model()->findAll(),
                            'id', 'types'
                        ),
                        array(
                            'prompt' => 'Select Type',
                            'id' => 'asset_type_id', // match this ID for JS
                        )
                    ); ?>
                <?php echo $form->error($model, 'asset_type_id'); ?>
        </div>

        <div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'asset_id', array('style' => 'width: 100px;')); ?>
                <?php
                echo $form->dropDownList(
                    $model,
                    'asset_id',
                    array(),
                    array('prompt' => 'Select Asset')
                );
                ?>
                <?php echo $form->error($model, 'asset_id'); ?>
        </div>

	<!-- Employee -->
	<div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'employee_id', array('style' => 'width: 100px;')); ?>
		<?php echo $form->dropDownList($model, 'employee_id',
			CHtml::listData(Employee::model()->findAll('is_active=1'), 'id', 'name'),
			array('prompt' => 'Select Employee')); ?>
		<?php echo $form->error($model, 'employee_id'); ?>
	</div>

	<!-- Start Date -->
	<div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'start_date', array('style' => 'width: 100px;')); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,
			'attribute'=>'start_date',
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'dd-mm-yy',
				'changeMonth'=>true,
				'changeYear'=>true,
				'minDate' => 0,
			),
			'htmlOptions'=>array(
				'readonly' => "readonly",
				'style' => 'height:16px;',
				'size' => 20,
			),
		));
		?>
		<?php echo $form->error($model, 'start_date'); ?>
	</div>

	<!-- Is Taken Out Of Office -->
	<div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model,'is_taken_out_of_office', array('style' => 'width: 100px;')); ?>
		<?php echo $form->checkBox($model,'is_taken_out_of_office', array('style' => 'width: 20px; height: 20px;')); ?>
		<?php echo $form->error($model,'is_taken_out_of_office'); ?>
	</div>

	<!-- Location -->
	<div class="row" style="display: flex; align-items: center; margin-bottom: 10px;">
		<?php echo $form->labelEx($model, 'location_id', array('style' => 'width: 100px;')); ?>
		<?php echo $form->dropDownList($model, 'location_id',
			CHtml::listData(LocationMaster::model()->findAll(), 'id', 'name'),
			array('prompt' => 'Select Location')); ?>
		<?php echo $form->error($model, 'location_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>



<script type="text/javascript">
$(document).ready(function () 
{   
    var selectedAssetId = "<?php echo !empty($model->asset_id) ?$model->asset_id:''; ?>";
    var selectedAssetTypeId = "<?php echo !empty($model->asset_type_id) ?$model->asset_type_id:''; ?>";
    if(selectedAssetTypeId)
        loadAssets(selectedAssetTypeId, selectedAssetId)
    $('#asset_type_id').on('change', function () 
    {
        var assetTypeId = $(this).val();

        if (assetTypeId !== '') 
        {
            loadAssets(assetTypeId);
        } 
        else 
        {
            $('#AssetUsage_asset_id').html('<option value="">Select Asset</option>');
        }
    });
    
    function loadAssets(assetTypeId, selectedAssetId = '')
    {
        $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl("assetUsage/dynamicAssets"); ?>',
                data: { asset_type_id: assetTypeId, selectedAssetId:selectedAssetId },
                success: function (response) 
                {
                    $('#AssetUsage_asset_id').html(response);
                },
                error: function () 
                {
                    alert('Error fetching assets. Please try again.');
                }
            });
    }
});
</script>
