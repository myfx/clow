<div class="container margint40 marginb40">
		<div class="row side-navigation">
			<ul class=" col-lg-3 col-sm-3 tab-style3">
				<li class="active"><a href="<?php echo Yii::app()->createUrl('profile/user', array('id' => $user->id)) ?>">
                                        <i class="icon-globe"></i> My Page</a></li>
				<li><a href="#tab2"><i class="icon-glass"></i> Messages</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('profile/edit', array('id' => Yii::app()->user->id)) ?>">
                                        <i class="icon-cloud"></i> Edit Profile</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('pet/add'); ?>"><i class="icon-comment-alt"></i> Add Pet</a></li>
			</ul>
			<div class="col-lg-9 col-sm-9 tab-content">
                            <div class="user" style="min-height: 100%"> 
                                <div class="user-photo pull-left text-center">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $user->url_photo; ?>"/>
                                </div>
                                
                                <div class="user-info pull-left user-edit-form" style="width: 430px;">
                                    <?php $form = $this->beginWidget('CActiveForm', array(
                                                'id'=>'',
                                                'enableAjaxValidation'=>false,
                                                'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                            )); ?>
                                            <?php echo $form->errorSummary($model); ?>
                                    
                                            <?php echo $form->labelEx($model,'url_photo'); ?>
                                            <?php echo $form->fileField($model,'image'); ?>
                                            <p>(<?php echo Yii::t('main', 'Upload a PNG, JPG, or GIF image.'); ?>)</p>

                                            <?php echo $form->labelEx($model,'first_name'); ?>
                                            <?php echo $form->textField($model,'first_name', array(
                                                'class' => 'name', 
                                                'placeholder' => 'First Name',
                                                'value'       => $user->first_name,
                                            )); ?>
                                    
                                            <?php echo $form->labelEx($model,'last_name'); ?>
                                            <?php echo $form->textField($model,'last_name', array(
                                                'class' => 'name', 
                                                'placeholder' => 'Last Name',
                                                'value'       => $user->last_name,
                                            )); ?>
                                    
                                            <?php echo $form->labelEx($model,'country'); ?>
                                            <select class="select" name="UsersEdit[country]" id="UsersEdit[country]">
                                                <option value="">Country</option>
                                                <?php $countries = WorldCities::getCountryArray(); ?>
                                                <?php foreach($countries as $key => $country) { ?>
                                                    <option  <?php if($user->country == $key)echo 'selected' ?> value="<?php echo $key ?>"><?php echo $country; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo $form->labelEx($model,'city'); ?>
                                            <select class="select" name="UsersEdit[city]" id="UsersEdit_city">
                                                <?php if(!empty($user->city)){ ?>
                                                <option value="<?php echo $user->city ?>"><?php $user->city; ?></option>
                                                <?php } else { ?>
                                                <option value="">City</option>
                                                <?php } ?>
                                            </select>
                                            <div class='ajax-loader hidden'></div>
                                            <?php echo $form->labelEx($model,'phone'); ?>
                                            <?php echo $form->textField($model,'phone', array(
                                                'class' => 'name', 
                                                'value'       => $user->phone,
                                                    )); ?>
                                    
                                            <?php echo $form->labelEx($model,'site'); ?>
                                            <?php echo $form->textField($model,'site', array(
                                                        'class' => 'name', 
                                                        'value'       => $user->site,
                                                    )); ?>
                                            
                                            <?php echo CHtml::submitButton('Submit', array(
                                                'class'=> 'submit button-style-1',
                                                'value'=> 'Save')); ?>
                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                           
                        </div>
		</div>
	</div>
