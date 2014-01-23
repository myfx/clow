<div id="featured-style1" >
    <div class="col-lg-12 col-sm-12" style="padding:30px 0px 50px 0px;">
        <div class='sign_in'>
	<div class='find-main'>
        <img src="/img/circle-icons/arrow-down.png" class="icon-cloud info-icon" alt="Sign in to 4Claw" />
	<h1>Sign in to 4Claw</h1>
	</div>
        <p>Please enter your email and password. <a href="<?php echo Yii::app()->createUrl('index/index'); ?>">Sign up here</a> if you are not registered yet.</p>
                <?php $form = $this->beginWidget('CActiveForm'); ?>
                <?php echo $form->errorSummary($model); ?>
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email', array(
                        'placeholder' => 'Your Email',
                        'class'       => 'email',
                    )); ?>
                    <?php echo $form->labelEx($model,'password'); ?>
                   <?php echo $form->passwordField($model,'password', array(
                       'value' => '', 
                       'placeholder' => 'Your Password',
                   )); ?>
                   <?php echo CHtml::submitButton('Submit', array(
                       'class'=> 'submit button-style-1',
                       'value'=> 'Sign In')); 
                   ?>
                <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div class="col-lg-12 col-sm-12">
    <img src="/img/pets.jpg" width="100%">
</div>
