

<div id="featured-style1"> 
    <div class="container margint40 marginb40">
        <div class="row">
            <div class="col-lg-12 col-sm-12 margint20 pet-search">
                <form method="GET" name="search" action="<?php echo Yii::app()->createUrl('pet/search'); ?>">
                    <div style="min-height: 125px;">
                        <div class="pull-left" style='width:585px;'>
                            <div>
                                <select style="width: 554px;" class="select" name="pet_status">
                                   <option value="">Action</option>
                                   <option <?php if(isset($filter['action']) && $filter['action'] == 'sell')echo 'selected' ?> value="sell">
                                       Sell
                                   </option>
                                   <option <?php if(isset($filter['action']) && $filter['action'] == 'adopt')echo 'selected' ?> value="adopt">Adopt</option>
                                   <option <?php if(isset($filter['action']) && $filter['action'] == 'breed')echo 'selected' ?> value="breed">Breed</option>
                               </select>
                            </div>
                            <div>
                                <select class="select" name="pet">
                                   <option value="">Pet</option>
                                   <option <?php if(isset($filter['pet']) && $filter['pet'] == 'dog')echo 'selected' ?> value="dog">
                                       Dog
                                   </option>
                                   <option <?php if(isset($filter['pet']) && $filter['pet'] == 'cat')echo 'selected' ?> value="cat">Cat</option>
                               </select>
			       <?php 
				$dogFlag = false;
				$catFlag = false;
				if(isset($filter['breed'])) {
					foreach(Pets::model()->getDogBreedArray() as $breed){ 
					    if($filter['breed'] == $breed) $dogFlag = true;
					}
					foreach(Pets::model()->getCatBreedArray() as $breed){ 
					    if($filter['breed'] == $breed) $catFlag = true;
					}
				}
				
				?>				

                               <select  id="any-breed" class="select <?php if($dogFlag || $catFlag)echo 'hidden'; ?>" name="breed">
                                    <option value="" selected>Breed(Any)</option>
                                </select>
                                <select id="dog-breed" class="select  <?php if(!$dogFlag) echo 'hidden'; ?>" name="breed">
                                    <?php foreach(Pets::model()->getDogBreedArray() as $breed){ ?>
				    	<option <?php if(isset($filter['breed']) && $filter['breed'] == $breed)echo 'selected' ?> value="<?php echo $breed; ?>"><?php echo $breed; ?></option>
				    <?php } ?>
                                </select>
                                <select  id="cat-breed" class="select <?php if(!$catFlag) echo 'hidden'; ?>" name="breed">
                                    <?php foreach(Pets::model()->getCatBreedArray() as $breed){ ?>
				    	<option <?php if(isset($filter['breed']) && $filter['breed'] == $breed)echo 'selected' ?>  value="<?php echo $breed; ?>"><?php echo $breed; ?></option>
				    <?php } ?>
                                </select>
                                <select class="select" name="gender">
                                    <option value="">Gender</option>
                                    <option <?php if(isset($filter['gender']) && $filter['gender'] == 'male')echo 'selected' ?> value="male">Male</option>
                                    <option <?php if(isset($filter['gender']) && $filter['gender'] == 'female')echo 'selected' ?> value="female">Female</option>
                                </select>
                            </div>
                            <div>                                
                                <select class="select" name="age">
                                        <option value="" >Age</option>
                                        <option <?php if(isset($filter['age']) && $filter['age'] == '1')echo 'selected' ?> value="1">0 - 6 month</option>
                                        <option <?php if(isset($filter['age']) && $filter['age'] == '2')echo 'selected' ?> value="2">6 month - 1 years</option>
                                        <option <?php if(isset($filter['age']) && $filter['age'] == '3')echo 'selected' ?> value="3">1 - 3 years</option>
                                        <option <?php if(isset($filter['age']) && $filter['age'] == '4')echo 'selected' ?> value="4">3 - 5 years</option>
                                        <option <?php if(isset($filter['age']) && $filter['age'] == '5')echo 'selected' ?> value="5">5+ years</option>
                                </select>
                                <select class="select" name="country">
                                    <option value="">Country</option>
                                    <?php $countries = array(); ?>
                                    <?php foreach($countries as $key => $country) { ?>
                                        <option  <?php if(isset($filter['country']) && $filter['country'] == $key)echo 'selected' ?> value="<?php echo $key ?>"><?php echo $country; ?></option>
                                    <?php } ?>
                               </select>
                               <select class="select" name="city">
                                    <option value="">City</option>
                               </select>
			       <div class="ajax-loader hidden"></div>
                           </div>
                       </div>
                       <div class="pull-left margin-left40">
                           <div class="pull-left">
                                
				<div style='height:40px'> 
                                    <input <?php if(isset($filter['veterinary']) && $filter['veterinary'])echo 'checked' ?>  name="veterinary" id="Pets_veterinary" type="checkbox">                         
                                    <img src="/img/icons/Identity-Card-32.png" class="icon-cloud info-icon" alt="" style='' />
                                    <label style='' for="Pets_veterinary">Veterinary</label>        
				 </div>             
                                
                               <div style='height:40px'> 
                                    <input <?php if(isset($filter['neutered_spayed']) && $filter['neutered_spayed'])echo 'checked' ?>  name="neutered_spayed" id="Pets_neutered_spayed" type="checkbox">                            
                                    <img src="/img/icons/Syringe-01-32.png" class="icon-cloud info-icon" alt="" style='' />
                                    <label  style='' for="Pets_neutered_spayed">Neutered/Spayed</label>                        
                                </div> 
                            </div>
                           <div class="pull-left margin-left40">
                               <div> 
                                    <input <?php if(isset($filter['vaccinations']) && $filter['vaccinations'])echo 'checked' ?>  name="vaccinations" id="Pets_vaccinations" type="checkbox">                            
                                    <img src="/img/icons/Syringe-01-32.png" class="icon-cloud info-icon" alt="" style='' />
                                    <label  style='' for="Pets_vaccinations">Vaccinations</label>                        
                                  </div> 
  				   <div> 
                                    <input <?php if(isset($filter['show_class']) && $filter['show_class'])echo 'checked' ?>  name="show_class" id="Pets_show_class"type="checkbox">                            
                                    <img src="/img/icons/Shape-Star2-32.png" class="icon-cloud info-icon" alt="" />
                                    <label style='' for="Pets_show_class">Show Class</label>                        
                               </div> 
                            
                            </div>
                           <div class="pull-left margin-left40">
                                 <div>
                                    <input <?php if(isset($filter['certificate']) && $filter['certificate'])echo 'checked' ?> name="certificate" id="Pets_certificate" value="1" type="checkbox">                            
                                    <img src="/img/icons/Certificate-01-32.png" class="icon-cloud info-icon" alt="" style='' />
                                    <label  style='' for="Pets_certificate">Certificate</label>                        
                                </div> 
				 <div> 
                                   <input <?php if(isset($filter['honors']) && $filter['honors'])echo 'checked' ?> name="honors" id="Pets_honors" type="checkbox">                            
                                   <img src="/img/icons/Agreement-01-32.png" class="icon-cloud info-icon" alt="" />
                                   <label  style='' for="Pets_honors">Honors</label>                        
                                 </div> 
                           </div>
                       </div>
                    </div>
                   <div style="width:100%">
                        <input class="submit button-style-1 find_button" value="Search" type="submit">
                   </div>
                </form>	
            </div>
        </div>
        
    </div>
</div>
<div id="main-info" class="margint40 pos-center">
    <div class="container">
        <div class="row portfolio-box">
            <?php if (isset($pets) && count($pets) > 0) { ?>
                <?php foreach($pets as $pet) { ?>
                    <div class="col-lg-3 col-sm-3 item photography">
                            <div class="prtf-itm prtf-itm-4">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $pet->photo_preview; ?>" width="280" higth="280" class="" alt="<?php echo $pet->breed; ?>" />
                                    <div class="mask">
                                            <div class="prt-lnk-wrppr clearfix">
                                                <div class="pull-left popup"><a href="/temp/prtcl1.jpg" class="prettyPhoto"><i class="icon-search"></i></a></div>
                                                <div class="pull-left extlink"><a href="portfolio-single.html"><i class="icon-link"></i></a></div>
                                            </div>
                                    </div>
                            </div>
                            <div class="portfolio-info-box">
                                    <p><a href="portfolio-single.html"><?php echo $pet->name; ?></a></p>
                            </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
