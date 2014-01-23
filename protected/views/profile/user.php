
<div class="container margint40 marginb40">
	<div class="row side-navigation">
        <div id="featured-style1" >
            <div class="col-lg-12 col-sm-12">
               <div class="user"> 
                    <div class="user-photo pull-left">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $user->url_photo; ?>"/>
                    </div>
                        <div class="user-info pull-left">
                            <h3><?php echo $user->first_name ?> <?php echo $user->last_name; ?></h3>
                            <?php if(Yii::app()->user->id == $user->id) { ?>
                                <p><a href="<?php echo Yii::app()->createUrl('profile/edit', array('id' => $user->id)); ?>">Edit Profile</a></p>
                            <?php } ?>
                            <?php if(!empty($user->date_birthday) && $user->date_birthday !== '0000-00-00') { ?>
                            <p>Date Birthday: <?php echo $user->date_birthday; ?></p>
                            <?php } ?>
                            <?php if(!empty($user->country)) { ?>
                            <p>Country: <?php echo WorldCities::getCountryNameByCode($user->country); ?></p>
                            <?php } ?>
                            <?php if(!empty($user->city)) { ?>
                            <p>City: <?php echo $user->city; ?></p>
                            <?php } ?>
                            <p>Email: <?php echo $user->email; ?></p>
                            <?php if(!empty($user->site)) { ?>
                            <p>Site: <?php echo $user->site; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
			<ul class=" col-lg-3 col-sm-3 tab-style3">
                            <?php if (!Yii::app()->user->isGuest) { ?>
				<li class="active"><a href="<?php echo Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)) ?>">
                                        <i class="icon-globe"></i> My Page</a></li>
                            <?php } ?>
                            <?php if (!Yii::app()->user->isGuest){ ?>
				<li><a href="#tab2"><i class="icon-glass"></i> Messages</a></li>
                            <?php } ?>
                            <?php if (!Yii::app()->user->isGuest && Yii::app()->user->id == $user->id) { ?>
				<li><a href="<?php echo Yii::app()->createUrl('profile/edit', array('id' => Yii::app()->user->id)) ?>">
                                        <i class="icon-cloud"></i> Edit Profile</a></li>
                            <?php } ?>
                            <?php if (!Yii::app()->user->isGuest && Yii::app()->user->id == $user->id){ ?>
				<li><a href="<?php echo Yii::app()->createUrl('pet/add'); ?>"><i class="icon-comment-alt"></i> Add Pet</a></li>
                            <?php } ?>
                        </ul>
                        <?php if (count($pets) > 0) { ?>
                        <?php foreach($pets as $pet) { ?>
			<div class="col-lg-9 col-sm-9 tab-content" style='float:right'>
                            <div class="pet" > 
                                <div class="pet-photo pull-left">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $pet->photo_preview; ?>"/>
                                </div>
                                <div class="pet-info pull-left">
                                    <div class="pull-left">
                                        <h3><?php echo $pet->name; ?></h3>
                                        <p>Action: <?php echo ucfirst($pet->pet_status); ?></p>
                                         <?php if(Yii::app()->user->id == $user->id) { ?>
                                            <p><a href="<?php echo Yii::app()->createUrl('pet/edit', array('id' => $pet->id)) ?>">Edit</a></p>
                                         <?php } ?>
                                        <p>Breed: <?php echo $pet->breed; ?></p>
                                        <p>Date Brithday: <?php echo $pet->date_birthday; ?></p>
                                        <?php if($pet->price > 0) { ?>
                                        <p>Price: $<?php echo $pet->price; ?></p>
                                        <?php } ?>
                                        <p>Color: <?php echo $pet->color; ?></p>
                                        <?php if(!empty($pet->tattoo)) { ?>
                                        <p>Tattoo: <?php echo $pet->tattoo; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="pull-left margint20 margin-left40">
                                        <p>
                                            <input disabled <?php if (!empty($pet->veterinary)) echo "checked='checked'"; ?> name="Pets[veterinary]" id="Pets_veterinary" value="<?php echo (!empty($pet->veterinary))?1:0; ?>" type="checkbox">                            
                                            <label for="Pets_veterinary">Veterinary</label>                        
                                        </p>
                                        <p>
                                            <input disabled <?php if (!empty($pet->neutered_spayed)) echo "checked='checked'"; ?> name="Pets[neutered_spayed]" id="Pets_neutered_spayed" value="<?php echo (!empty($pet->neutered_spayed))?1:0; ?>" type="checkbox">                            
                                            <label for="Pets_neutered_spayed">Neutered/Spayed</label>                        
                                        </p>
                             
                                        <p>
                                            <input disabled  <?php if (!empty($pet->vaccinations)) echo "checked='checked'"; ?> name="Pets[vaccinations]" id="Pets_vaccinations" value="<?php echo (!empty($pet->vaccinations))?1:0; ?>" type="checkbox">                            
                                            <label for="Pets_vaccinations">Vaccinations</label>                        
                                        </p>
                                        <p>
                                            <input disabled  <?php if (!empty($pet->show_class)) echo "checked='checked'"; ?> name="Pets[show_class]" id="Pets_show_class" value="<?php echo (!empty($pet->show_class))?1:0; ?>" type="checkbox">                            
                                            <label for="Pets_show_class">Show Class</label>                        
                                        </p>
                                        <p>
                                            <input disabled <?php if (!empty($pet->certificate)) echo "checked='checked'"; ?> name="Pets[certificate]" id="Pets_certificate" value="<?php echo (!empty($pet->certificate))?1:0; ?>" type="checkbox">                            
                                            <label for="Pets_certificate">Certificate</label>                        
                                        </p>
                                        <p>
                                           <input disabled  <?php if (!empty($pet->honors)) echo "checked='checked'"; ?> name="Pets[honors]" id="Pets_honors" value="<?php echo (!empty($pet->honors))?1:0; ?>" type="checkbox">                            
                                           <label for="Pets_honors">Honors</label>                        
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        
		</div>
	</div>