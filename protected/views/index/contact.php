<div class="col-lg-12 col-sm-12" style='border-top:1px solid #EDEDEB;padding-top:20px;'>

<div class="container marginb40">
    <?php if( (Yii::app()->user->hasFlash('success')) ) { ?>
        <div class="title-h1"><?php echo Yii::app()->user->getFlash('success'); ?></div>
    <?php } else { ?>
    <div class='find-main'>
	    <img src="/img/circle-icons/mail.png" class="icon-cloud info-icon" alt="Contact Us" />
	    <h1>We are all loving Customers</h1>
    </div>
    <p class="margint20">If you have some idea for improve 4Claw.com, please contact us.</p>
    <div class="row margint20 contact-form">
            <div class="col-lg-8 col-sm-8">
                    <h4 class="margint30">Contact Us</h4>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                    //    'id'=>'ajax-contact-form',
                    //    'enableAjaxValidation'=>false,
                    )); ?>
                    <?php echo $form->errorSummary($model); ?>
                    <div class="contact-input-area margint20">
                            <div class="form-group clearfix">
 
                                    <?php echo $form->labelEx($model,'name', array(
                                        'class' => 'pull-left inpt-name'
                                    )); ?>
                                    <div class="pull-left">
                                        <?php echo $form->textField($model,'name'); ?>
                                    </div>
                            </div>
                            <div class="form-group margint20 clearfix">
                                    <?php echo $form->labelEx($model,'email', array(
                                        'class' => 'pull-left inpt-name'
                                    )); ?>
                                    <div class="pull-left">
                                        <?php echo $form->textField($model,'email'); ?>
                                    </div>
                            </div>
                            <div class="form-group margint20">
                                <div>
                                    <?php echo $form->labelEx($model,'message'); ?>
                                </div>
                                <div class="margint10">
                                    <?php echo $form->textArea($model,'message'); ?>
                                </div>
                            </div>
                            <div class="pull-right margint10">
                                     <?php echo CHtml::submitButton('Submit' , array(
                                         'class' => 'form-button',
                                     )); ?>
                            </div>
                    </div>
                    <?php $this->endWidget(); ?>
            </div>
            <div class="col-lg-4 col-sm-4">
                    <h4 class="margint30">Social</h4>
                    <ul class="margint20 contact-social">
                            <li><a  target='blank'  href="https://www.facebook.com/pages/4Clawcom/181786425365389"><i class="icon-facebook"></i> Find on Facebook</a></li>
                            <li><a  target='blank' href="https://twitter.com/4Clawcom"><i class="icon-twitter"></i> Find on Twitter</a></li>
                            <li><a  target='blank' href="https://plus.google.com/communities/103234469114965487677?partnerid=ogpy0"><i class="icon-google-plus"></i> Find on Google Plus</a></li>
                    </ul>
            </div>
    </div>
    <?php } ?>
</div>
</div>

