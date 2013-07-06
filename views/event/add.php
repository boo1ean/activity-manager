<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\EventForm $model
 */

?>

<h3>Add/Edit event</h3>

<div class="controls">
    <?php
    $form = ActiveForm::begin(
        array(
            'options'     => array('class' => 'form-horizontal'),
            'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
            'action'      => array('event/save')
        )
    );
    ?>
    <?php echo $form->field($model, 'id')->hiddenInput(array('value' => $event->id)); ?>
    <?php echo $form->field($model, 'title')->textInput(array('value' => $event->title)); ?>
    <?php echo $form->field($model, 'description')->textArea(array('value' => $event->description)); ?>

    <?php echo $form->field($model, 'start_time')->render('
        <div id="dtp-start-time" class="input-append date">
        <input type="text" id="eventform-start_time" class="input-xlarge" name="EventForm[start_time]" value=""/>

      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>');?>


    <?php echo $form->field($model, 'end_time')->render('
        <div id="dtp-end-time" class="input-append date">
        <input type="text" id="eventform-end_time" class="input-xlarge" name="EventForm[end_time]" value=""/>

      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
    </div>');?>

    <div class="form-actions">
        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>
        <a class="btn" href="<?php echo Html::url(array('event/dashboard')); ?>">Cancel</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    $(function() {
        $("#dtp-start-time").datetimepicker({
            format: 'dd/MM/yyyy hh:mm:ss'
        });

        $("#dtp-end-time").datetimepicker({
            format: 'dd/MM/yyyy hh:mm:ss'
        });
    });
</script>
