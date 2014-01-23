	<div id="featured-style1" >
		<div class="container marginb40">
			<div class="row">
				<div class="col-lg-6 col-sm-6 margint20">
                    <div class='find-main'>
                        <h1>Adopt or buy dog and cat</h1>
                        Find the best breeding pair for cat and dog, and follow your perfect breed.
                    </div>
					<div style='margin-top:15px' class="form-search">
						<form method="GET" name="search" style='width:400px;' action="<?php echo Yii::app()->createUrl('pet/search'); ?>">
							<select class="selectViewads" name="pet_status">
								<option value="" selected>Action</option>
								<option value="sell">Sell</option>
                                                                <option value="adopt">Adopt</option>
                                                                <option value="breed">Breed</option>
							</select>
							<select class="select" name="pet">
								<option value="" selected>Pet</option>
								<option value="dog">Dog</option>
								<option valhue="cat">Cat</option>
							</select>
							<select id="any-breed" class="select" name="breed">
								<option value="" selected>Breed(Any)</option>
							</select>
                                                        <select  id="dog-breed" class="select hidden" name="breed">
                                                            <?php echo Pets::model()->getDogBreeds(); ?>
                                                        </select>
                                                        <select  id="cat-breed" class="select hidden" name="breed">
                                                            <?php echo Pets::model()->getCatBreeds(); ?>
                                                        </select>
							<select class="select" name="gender">
								<option value="" selected>Gender</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
							<select class="select" name="age">
								<option value="" >Age</option>
								<option value="1">0 - 6 month</option>
                                                                <option value="2">6 month - 1 years</option>
                                                                <option value="3">1 - 3 years</option>
                                                                <option value="4">3 - 5 years</option>
                                                                <option value="5">5+ years</option>
							</select>
							<select class="select" name="country">
								<option value="" selected>Country</option>
								<?php $countries = WorldCities::getCountryArray(); ?>
                                                                <?php foreach($countries as $key => $country) { ?>
                                                                <option value="<?php echo $key ?>"><?php echo $country; ?></option>
                                                                <?php } ?>
							</select>
							<select class="select" name="city">
								<option value="" selected>City</option>
								<?php $cities = array(); ?>
                                                                <?php foreach($cities as $cCode => $aCities){ ?>
                                                                    <?php foreach($aCities as $city){ ?>
                                                                        <option class="hidden city <?php echo $cCode; ?>" value="<?php echo $city ?>"><?php echo $city; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
							</select>
							<div class="ajax-loader hidden"></div>
							<input class="submit button-style-1" value="Search" type="submit">
						</form>
					<div class="a1"><a href="/pet/search">Advanced Search</a></div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 margint20">
                                        <div class='signup-desc'>
                                        <h2>Become a member now</h2>
                                        Pet's owners and breeders from all over the world on 4Claw.com
                                        </div>
					<div style='margin-top:15px;' class="form-signup">
                                            <?php $form = $this->beginWidget('CActiveForm', array(
                                                        'id'=>'users-signup-form',
                                                        'enableAjaxValidation'=>false,
                                                    )); ?>
                                            <?php echo $form->errorSummary($model); ?>
                                                    <?php echo $form->labelEx($model,'first_name'); ?>
                                                    <?php echo $form->textField($model,'first_name', array(
                                                        'class' => 'name', 
                                                        'placeholder' => 'First Name',
                                                    )); ?>
                                                    <?php echo $form->labelEx($model,'last_name'); ?>
                                                    <?php echo $form->textField($model,'last_name', array(
                                                        'class' => 'name', 
                                                        'placeholder' => 'Last Name',
                                                    )); ?>
                                                    <?php echo $form->labelEx($model,'email'); ?>
                                                    <?php echo $form->textField($model,'email', array(
                                                        'class' => 'email', 
                                                        'placeholder' => 'Your Email',
                                                    )); ?>
                                                    <?php echo $form->labelEx($model,'password'); ?>
                                                    <?php echo $form->passwordField($model,'password', array(
                                                        'placeholder' => 'Your Password',
                                                        'class'       => 'password',
                                                    )); ?>
                                                    <?php echo CHtml::submitButton('Submit', array(
                                                        'class'=> 'submit button-style-1',
                                                        'value'=> 'Sign Up')); ?>
                                                <?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- SERVICES -->
	<div id="main-info" class="margint60 pos-center">
		<div class="container">
			<div class="information">
				<h2>Find all you and your pet needs on <span class="important-text">4claw.com</span></h2>
			</div>
			<div class="row margint40 info">	
				<div class="col-lg-3 col-sm-6 col3-box">
					<div class="pad20">
						<img src="/img/circle-icons/globe.png" class="icon-cloud info-icon" alt="" />
						<h3 class="margint10">Find pets</h3>
						<p class="margint10">Adopt pets, help them to find home. Buy pretty kitty or puppy through here too. Easy search help your to find pet.</p>
						<a class="margint10" href="#">READ MORE <i class="icon-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col3-box">
					<div class="pad20">
						<img src="/img/circle-icons/compose.png" class="icon-cloud info-icon" alt="" />
						<h3 class="margint10">Make pet ads</h3>
						<p class="margint10">Make your ads for sale puppies and kittens. We help you to sale! Create ads to search breeding pair. It’s free!</p>
						<a class="margint10" href="#">READ MORE <i class="icon-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col3-box">
					<div class="pad20">
						<img src="/img/circle-icons/chat.png" class="icon-cloud info-icon" alt="" />
						<h3 class="margint10">Comunicate with breeders</h3>
						<p class="margint10">Pet’s owners and breeders from all over the world on 4claw.com. It is the best place to search for an ideal breeding pair for your beloved pets. Follow your perfect breed.</p>
						<a class="margint10" href="#">READ MORE <i class="icon-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col3-box">
					<div class="pad20">
						<img src="/img/circle-icons/rocket.png" class="icon-cloud info-icon" alt="" />
						<h3 class="margint10">Register pet services</h3>
						<p class="margint10">Soon. Register your company. hotels, haircut, training, shop, clinic for pets and other services.  Find new clients and get more feedback.</p>
						<a class="margint10" href="#">READ MORE <i class="icon-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- FEATURED -->
	<div id="portfolio" class="margint60 full-width">
		<p class="section-title margint60">Our beautiful pets</p>
		<hr class="underline">
		<ul id="prtfl-list">
			<li>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/temp/portfolio1_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio2_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/temp/portfolio3_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/temp/portfolio4_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio5_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio1_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio2_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio3_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio4_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
			<li>
				<img src="temp/portfolio5_s.jpg" class="img-responsive" alt="" />
				<div class="mask">
					<div class="prt-lnk-wrppr clearfix">
	                	<div class="pull-left popup"><a href="#" class="prettyPhoto"><i class="icon-search"></i></a></div>
	                	<div class="pull-left extlink"><a href="#"><i class="icon-link"></i></a></div>
	                </div>
                </div>
			</li>
		</ul>
		<ul id="prtfl-list-controller" class="margint40 clearfix">
			<li><a id="prev" href="#"><i class="icon-angle-left"></i></a></li>
			
			<li><a id="next" href="#"><i class="icon-angle-right"></i></a></li>
		</ul>
	</div>
