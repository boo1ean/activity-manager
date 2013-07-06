<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="alert alert-block alert-error">
    <h3 class="alert-heading">Delete Event</h3>
    <p>Are you really sure to delete this event?</p>
    <?php
        $form = ActiveForm::begin(
            array(
                'options' => array('class' => 'form-horizontal'),
                'action'  => array('event/remove')
            )
        );
    ?>

    <?php echo Html::hiddenInput('id', $event->id); ?>
    <p>
        <?php echo Html::submitButton('Delete', array('class' => 'btn btn-danger')); ?>
        <a class="btn" href="<?php echo Html::url(array('event/dashboard')); ?>">Cancel</a>
    </p>
    <?php ActiveForm::end(); ?>
</div>