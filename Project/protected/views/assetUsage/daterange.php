<h1>Asset Usage Report</h1>


<div style="margin-bottom: 20px;">
    <button type="button" onclick="setMode('range')">Date Range Report</button>
    <button type="button" onclick="setMode('asof')">As Of Date Report</button>
</div>

<form method="POST" action="<?php echo Yii::app()->createUrl('assetUsage/daterange'); ?>">
    <input type="hidden" name="mode" id="mode" value="range" />

    
    <div id="startEndFields">
        <label>Start Date</label><br>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'start_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'changeMonth' => true,
                'changeYear' => true,
            ),
            'htmlOptions' => array(
                'readonly' => 'readonly',
                'id' => 'start_date',
                'required' => 'required'
                ),
        ));
        ?>        
        <br><br>
        
        <label>End Date</label><br>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'end_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'changeMonth' => true,
                'changeYear' => true,
            ),
            'htmlOptions' => array(
                'readonly' => 'readonly',
                'id' => 'end_date',
                'required' => 'required'
                ),
        ));
        ?>
    </div>

    
    <div id="asOfField" style="display:none;">
        <label>As Of Date</label><br>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'as_of_date',
            'options' => array(
                'dateFormat' => 'dd-mm-yy',
                'changeMonth' => true,
                'changeYear' => true,
            ),
            'htmlOptions' => array(
        'readonly' => 'readonly',
        'id' => 'as_of_date',
        'required' => false // initially false
    ),
        ));
        ?>
    </div>

    <br>
    <button type="submit">Download CSV</button>
</form>


<script>
    function setMode(mode) 
    {
        document.getElementById('mode').value = mode;

        if (mode === 'range') 
        {
            document.getElementById('startEndFields').style.display = 'block';
            document.getElementById('asOfField').style.display = 'none';
        } 
        
        else 
        {
            document.getElementById('startEndFields').style.display = 'none';
            document.getElementById('asOfField').style.display = 'block';
        }
    }
</script>
