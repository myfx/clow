<?php


class ProfileController extends Controller {
    
    
    
    public function actionUser()
    {

        $id   = Yii::app()->getRequest()->getQuery('id');
        
        if(empty($id))
            $this->redirect(Yii::app()->createUrl('index/index'));
        
        $user = Users::model()->findByPk($id);
        $pets = Pets::model()->findAll('uid=:uid', array(':uid' => $id));
        


	   $title = '';
        if(!empty($pets)) {
		foreach ($pets as $pet) {
			if($pet->pet_status == 'nothing') continue;
			$subTitle = $pet->pet_status . ' ';
			if(!empty($pet->breed)) 	
				$subTitle .= $pet->breed;
			else
				$subTitle .= $pet->type;

$subTitle = preg_replace('/sell/i', 'buy', $subTitle);

			if(!empty($title)) 
				$title .= ', '. $subTitle;
			else
				$title = ucfirst($subTitle);
	
		}
		if(!empty($title)) {
			$town = ' on 4Claw.com';			
			if(!empty($pet->country)) 
				$town = ' in ' . WorldCities::getCountryNameByCode($pet->country) . '.';
			if(!empty($pet->city))
				$town = ' in ' . $pet->city . '.';
		}
		$title .= $town;
	   }

	if(empty($title)) {
		   $title = $user->first_name . ' ' . $user->last_name . ' profile - 4Claw.com';
	}



$this->pageTitle = $title;

$d = (!preg_match('/profile/', $title)) ? '4Claw.com': '';

$this->pageDescription = $title . ' ' . $d . ' - it is the best place to search for an ideal breeding pair for your dog or cat. Buy pretty kitty or puppy through here too!';

        $this->render('user', array(
            'user' => $user,
            'pets' => $pets,
        ));
    }
    
    
    public function actionEdit()
    {
        $id   = Yii::app()->user->id;
        if (empty($id)) {
            $this->redirect(Yii::app()->createUrl('index/index'));
        }
        


        $model = new UsersEdit();
        $user = Users::model()->findByPk($id);
        	   $title = $user->first_name . ' ' . $user->last_name . ' profile edit - 4Claw.com';
$this->pageTitle = $title;
$this->pageDescription = $title;
        if (!empty($_POST['UsersEdit'])) {
            $model->attributes = $_POST['UsersEdit'];
            if($model->validate()) {
                
                $model->image       = CUploadedFile::getInstance($model,'image');
                if (!empty($model->image)) {
                    $name               = $model->image->name;
                    $fullname           = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR.$name;
                    $url                = Yii::app()->request->baseUrl.'/avatars/'.$name;
                    $model->url_photo   = $url;
                }
                
                $attributes        = array();
                if (!empty($model->url_photo) && isset($model->url_photo))  $attributes['url_photo'] = $model->url_photo;
                $attributes['first_name'] = $model->first_name;  
                $attributes['last_name'] = $model->last_name;  
                $attributes['country'] = $model->country;   
                $attributes['phone'] = $model->phone; 
                $attributes['city'] = $model->city;  
                $attributes['site'] = $model->site;

if (isset($attributes['url_photo'])){
                    $model->image->saveAs($fullname);
                }


                UsersEdit::model()->updateByPk($id, $attributes);
                
                $this->redirect(Yii::app()->createUrl('profile/user', array('id' => $id)));
            }
        }
        
        $this->render('edit', array(
            'user'  => $user,
            'model' => $model,
        ));
    }
    
    
    
    
    
}
