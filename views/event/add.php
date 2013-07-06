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
    <?php echo $form->field($model, 'start_time')->textInput(array('value' => $event->start_time)); ?>
    <?php echo $form->field($model, 'end_time')->textInput(array('value' => $event->end_time)); ?>
    <div class="form-actions">
        <?php echo Html::submitButton('Save', null, null, array('class' => 'btn btn-primary')); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
