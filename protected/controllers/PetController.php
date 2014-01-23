<?php


class PetController extends Controller 
{
    
    public function actionIndex()
    {
        $this->redirect(Yii::app()->createUrl('pet/search'));
    }
 
	public function actionView()
	{
		$id = Yii::app()->getRequest()->getQuery('id');
		if (empty($id)) {
			$this->redirect(Yii::app()->createUrl('index/index'));		
		}
		$pet = Pets::model()->findByPk($id);
		if (empty($pet)) {
			$this->redirect(Yii::app()->createUrl('index/index'));
		}
		$this->render('view', array(
			'pet' => $pet,		
		));
	
	}    


    public function actionAdd()
    {
        $model = new Pets();
        
         if (!empty($_POST['Pets'])) {
            
              $model->attributes = $_POST['Pets'];
             
              if($model->validate()) {
                  $model->image       = CUploadedFile::getInstance($model,'image');
                  if (!empty($model->image)) {
                    $name                   = $model->image->name;
                    $fullname               = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pet_photo'.DIRECTORY_SEPARATOR.$name;
                    $url                    = Yii::app()->request->baseUrl.'/pet_photo/'.$name;
                    $model->photo_preview   = $url;
                }
                if (isset($model->photo_preview)){
                    $model->image->saveAs($fullname);
                }
                $model->save();

                $this->redirect(Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)));
              }
         }
        
        $this->render('add', array(
            'model' => $model,
        ));
    }
    
    
    public function actionEdit()
    {
        $model = new Pets();
        
        $id   = Yii::app()->getRequest()->getQuery('id');
        $pet  = Pets::model()->findByPk($id);
        if (empty($pet) || $pet->uid != Yii::app()->user->id) {
            $this->redirect(Yii::app()->createUrl('index/index'));
        }
        
        if (!empty($_POST['Pets'])) {
            $model->attributes = $_POST['Pets'];
            if($model->validate()) {
                
                $model->image       = CUploadedFile::getInstance($model,'image');
                if (!empty($model->image)) {
                    $name               = $model->image->name;
                    $fullname           = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'pet_photo'.DIRECTORY_SEPARATOR.$name;
                    $url                = Yii::app()->request->baseUrl.'/pet_photo/'.$name;
                    $model->photo_preview   = $url;
                }
                
                
                $attributes        = array();
                if (!empty($model->photo_preview) && isset($model->photo_preview))  $attributes['photo_preview'] = $model->photo_preview;
                $attributes['type'] = $model->type;  
                $attributes['pet_status'] = $model->pet_status;  
                $attributes['name'] = $model->name;   
                $attributes['breed'] = $model->breed; 
                $attributes['date_birthday'] = $model->date_birthday;  
                $attributes['color'] = $model->color;
                $attributes['tattoo'] = $model->tattoo;
                $attributes['veterinary'] = $_POST['Pets']['veterinary'];
                $attributes['vaccinations'] = $_POST['Pets']['vaccinations'];
                $attributes['show_class'] = $_POST['Pets']['show_class'];
                $attributes['certificate'] = $_POST['Pets']['certificate'];
                $attributes['honors'] = $_POST['Pets']['honors'];
                $attributes['neutered_spayed'] = $_POST['Pets']['neutered_spayed'];
                
                $attributes['price'] = $model->price;

                if (isset($attributes['url_photo'])){
                    $model->image->saveAs($fullname);
                }

                Pets::model()->updateByPk($id, $attributes);
                
                $this->redirect(Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)));
            }
        }
        
        $this->render('edit', array(
            'model' => $model,
            'pet'   => $pet,
        ));
    }




    
    public function actionSearch()
    {
	$title = 'Buy or find breeding dog or cat on 4Claw.com';
        $desc = "4Claw - it is the best place to search for an ideal breeding pair for your dog or cat. Buy pretty kitty or puppy through here too!";

        $veterinary     = Yii::app()->getRequest()->getQuery('veterinary');
        $show_class     = Yii::app()->getRequest()->getQuery('show_class');
        $honors         = Yii::app()->getRequest()->getQuery('honors');
        $vaccinations   = Yii::app()->getRequest()->getQuery('vaccinations');
        $certificate    = Yii::app()->getRequest()->getQuery('certificate');
        $neutered_spayed  = Yii::app()->getRequest()->getQuery('neutered_spayed');
        
        $age = Yii::app()->getRequest()->getQuery('age');
        if (!empty($age)) {
            switch ($age) {
                case 1:
                    $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - 365/2*24*60*60);
                    $dateTo   = date('Y-m-d');
                    break;
                case 2:
                    $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - 365*24*60*60);
                    $dateTo   = date('Y-m-d', strtotime(date('Y-m-d')) - 365/2*24*60*60);
                    break;
                case 3:
                    $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - 3*365*24*60*60);
                    $dateTo   = date('Y-m-d', strtotime(date('Y-m-d')) - 365*24*60*60);
                    break;
                case 4:
                    $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - 5*365*24*60*60);
                    $dateTo   = date('Y-m-d', strtotime(date('Y-m-d')) - 3*365*24*60*60);
                    break;
                case 5:
                    $dateFrom = date('Y-m-d', strtotime(date('Y-m-d')) - 30*365*24*60*60);
                    $dateTo   = date('Y-m-d', strtotime(date('Y-m-d')) - 5*365*24*60*60);
                    break;

                default:
                    $dateFrom = date('Y-m-d', 5*365*24*60*60);
                    $dateTo   = date('Y-m-d', 30*365*24*60*60);
            }
        }
        
        $filter = array(
            'action'    => Yii::app()->getRequest()->getQuery('pet_status'),
            'pet'       => Yii::app()->getRequest()->getQuery('pet'),
            'breed'     => Yii::app()->getRequest()->getQuery('breed'),
            'gender'    => Yii::app()->getRequest()->getQuery('gender'),
            'age'       => !empty($age) ? array('date_from' => $dateFrom, 'date_to' => $dateTo) : '',
            'country'   => Yii::app()->getRequest()->getQuery('country'),
            'city'         => Yii::app()->getRequest()->getQuery('city'),
            'veterinary'   => isset($veterinary) ? 1 : 0,
            'show_class'   => isset($show_class) ? 1 : 0,
            'honors'       => isset($honors) ? 1 : 0,
            'vaccinations' => isset($vaccinations) ? 1 : 0,
            'certificate'  => isset($certificate) ? 1 : 0,
            'neutered_spayed'  => isset($neutered_spayed) ? 1 : 0,
        );

	$tAction = (!empty($filter['action']))?ucfirst($filter['action']):'Buy';
	$tPet = (!empty($filter['breed']))?$filter['breed']:'';
	$tPet = (!empty($tPet))?$tPet:$filter['pet'];
	$tPet = (!empty($tPet))?$tPet: 'dog or cat';

	$town = (!empty($filter['city']))?$filter['city']:WorldCities::getCountryNameByCode($filter['country']);

	$copy = (!empty($town))? 'in ' . $town . ' - 4Claw.com':'on 4Claw.com';

	$title1  = $tAction . ' ' . $tPet . ' ' . $copy;
	$desc1	   = $title1 . ' it\'s the best place to search for an ideal breeding pair for your dog or cat. Buy pretty kitty or puppy through here too!'; 

	$this->pageTitle = (empty($_GET))?$title:$title1;
	$this->pageDescription = (empty($_GET))?$desc:$desc1;

        $pets = Pets::model()->findPetsByFilter($filter);
        $filter['age'] = $age;
        $uids = array();
        foreach ($pets as $pet) {
            $uids[] = $pet['uid'];
        }
        
        $criteria = new CDbCriteria;
        $criteria->addInCondition('id', $uids);
        $users    = Users::model()->findAll($criteria);
        
        $owners = array();
        foreach ($pets as $key => $pet) {
            foreach ($users as $user) {
                if ($pet['uid'] == $user['id']) {
                    $owners[$pet['id']] = $user;
                }
            } 
        }

        $this->render('index', array(
            'pets'      => $pets,
            'owners'    => $owners,
            'filter'    => $filter,
        ));
    }
}
