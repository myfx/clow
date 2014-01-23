<div class="container margint40 marginb40">
    <div class="row side-navigation">
        <ul class=" col-lg-3 col-sm-3 tab-style3">
                <li class="active"><a href="<?php echo Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)) ?>">
                        <i class="icon-globe"></i> My Page</a></li>
                <li><a href="#tab2"><i class="icon-glass"></i> Messages</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('profile/edit', array('id' => Yii::app()->user->id)) ?>">
                                        <i class="icon-cloud"></i> Edit Profile</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('pet/add'); ?>"><i class="icon-comment-alt"></i> Add Pet</a></li>
        </ul>
        <div class="col-lg-9 col-sm-9 tab-content">
            <div class="user" style="min-height: 100%"> 
            <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'',
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                )); ?>
                <div style="clear: both;height:600px;">
                    <div class="user-info pull-left user-edit-form" style="width: 400px;">
                        <?php echo $form->errorSummary($model); ?>

                        <?php echo $form->labelEx($model,'type'); ?>
                        <?php echo $form->dropDownList($model,'type',array('cat'=>'Cat','dog'=>'Dog'), array('class' => 'name'));  ?>
                        
                        <?php echo $form->labelEx($model,'photo_preview'); ?>
                        <?php echo $form->fileField($model,'image'); ?>
                        <p>(<?php echo Yii::t('main', 'Upload a PNG, JPG, or GIF image.'); ?>)</p>

                        <?php echo $form->labelEx($model,'pet_status'); ?>
                        <?php echo $form->dropDownList($model,'pet_status',array('nothing' => 'Nothing', 'sell'=>'Sell', 'adopt' => 'Adopt', 'breed' => 'Breed'), array('class' => 'name'));  ?>
                        
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model,'name', array(
                            'class' => 'name', 
                        )); ?>

                        <?php echo $form->labelEx($model,'price'); ?>  
                        <?php echo $form->textField($model,'price', array(
                            'class' => 'name', 
                        )); ?>
                     
                        <?php echo $form->labelEx($model,'breed'); ?>  
                        <?php echo $form->dropDownList($model,'breed',  Pets::model()->getCatBreedArray(), array('class' => 'cat-breed name breed'));  ?>
                        <?php echo $form->dropDownList($model,'breed',  Pets::model()->getDogBreedArray(), array('class' => 'dog-breed name hidden breed'));  ?>
                       

                        <?php echo $form->labelEx($model,'date_birthday'); ?>
                        <?php echo $form->textField($model,'date_birthday', array(
                            'class' => 'name', 
'id' => 'datepicker',
                        )); ?>

                        <?php echo $form->labelEx($model,'sex'); ?>
                        <?php echo $form->dropDownList($model,'sex',array('male'=>'Male','female'=>'Female'), array('class' => 'name'));  ?>

                        <?php echo $form->labelEx($model,'color'); ?>
                        <?php echo $form->textField($model,'color', array(
                            'class' => 'name', 
                        )); ?>
                        
                        <?php echo $form->labelEx($model,'tattoo'); ?>
                        <?php echo $form->textField($model,'tattoo', array(
                            'class' => 'name', 
                        )); ?>
                    </div>
                    <div class="pull-left margin-left40" style="width: 200px;">
                        <p>
                            <?php echo $form->checkBox($model,'veterinary'); ?>
                            <?php echo $form->labelEx($model,'veterinary'); ?>
                        </p>
                        <p>
                            <?php echo $form->checkBox($model,'neutered_spayed'); ?>
                            <?php echo $form->labelEx($model,'neutered_spayed'); ?>
                        </p>                        
                        <p>
                            <?php echo $form->checkBox($model,'vaccinations'); ?>
                            <?php echo $form->labelEx($model,'vaccinations'); ?>
                        </p>
                        <p>
                            <?php echo $form->checkBox($model,'show_class'); ?>
                            <?php echo $form->labelEx($model,'show_class'); ?>
                        </p>
                        <p>
                            <?php echo $form->checkBox($model,'certificate'); ?>
                            <?php echo $form->labelEx($model,'certificate'); ?>
                        </p>
                         <p>
                            <?php echo $form->checkBox($model,'honors'); ?>
                            <?php echo $form->labelEx($model,'honors'); ?>
                        </p>
                    </div>
                </div>
                <?php echo CHtml::submitButton('Submit', array(
                    'class'=> 'submit button-style-1 margin-left43 save_button save_pet',
                    'value'=> 'Save')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>