<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin(array('options' => array('class' => 'form-horizontal')));
?>
<h1><?php echo Html::encode($this->title); ?></h1>

<p>Please fill out the following fields to register:</p>

<?php echo $form->field($model, 'first_name')->textInput(); ?>
<?php echo $form->field($model, 'last_name')->textInput(); ?>
<?php echo $form->field($model, 'email')->textInput(); ?>
<?php echo $form->field($model, 'password')->passwordInput(); ?>
<?php echo $form->field($model, 'password2')->passwordInput(); ?>

<div class="form-actions">
    <?php echo Html::submitButton('Register', array('class' => 'btn btn-primary')); ?>
</div>

<?php ActiveForm::end(); ?>
