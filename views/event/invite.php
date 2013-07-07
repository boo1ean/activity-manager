<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\InviteForm $model
 */

?>

<h3>Event Invitation</h3>
<div class="controls">
    <span class="help-block">
        Invite someone you know on <b><?php echo $event->title . ' ' . $event->start_time; ?></b>
        by email
    </span>
    <?php
        $form = ActiveForm::begin(
            array(
                'options'     => array('class' => 'form-horizontal'),
                'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
                'action'      => array('event/notify')
            )
        );
    ?>
    <?php echo $form->field($model, 'event_id')->hiddenInput(); ?>
    <?php echo $form->field($model, 'email')
                ->widget(
                    AutoComplete::className(),
                    array('clientOptions' => array('source' => $emailList))
                );
    ?>

    <div class="form-actions">
        <?php echo Html::submitButton('Send', array('class' => 'btn btn-primary')); ?>
        <a class="btn" href="<?php echo Html::url(array('event/dashboard')); ?>">Cancel</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>
