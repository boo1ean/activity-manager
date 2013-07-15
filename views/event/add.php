<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\libs\widgets\Datetimepicker;
use yii\widgets\Captcha;

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
    <?php echo $form->field($model, 'id')->hiddenInput(); ?>
    <?php echo $form->field($model, 'title')->textInput(); ?>
    <?php echo $form->field($model, 'description')->textArea(); ?>
    <?php echo $form->field($model, 'start_time')->widget(Datetimepicker::className(), array()); ?>
    <?php echo $form->field($model, 'end_time')->widget(Datetimepicker::className(), array()); ?>
    <?php echo $form->field($model, 'captchaCode')->widget(Captcha::className(), array('options' => array('class' => 'input-medium'), 'captchaAction' => 'event/captcha')); ?>

    <div class="form-actions">
        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>
        <a class="btn" href="<?php echo Html::url(array('event/dashboard')); ?>">Cancel</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    $(function() {
        $("#dtp-start_time").datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss'
        });

        $("#dtp-end_time").datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss'
        });
    });
</script>
