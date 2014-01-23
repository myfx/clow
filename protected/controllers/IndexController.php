<?php

class IndexController extends Controller
{

    public function actionIndex()
    {
	$this->pageTitle = 'Find breeding or sale dog or cat on 4claw.com';
	$this->pageDescription = 'Pet\'s owners and breeders from all over the world on 4claw.com. Make ads for sale pet. Find the best breeding pair for cat and dog, and follow your perfect breed.';

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)));
        }
        
        $model = new Users();
         if (!empty($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if($model->validate()) {
                if ($model->model()->count("email = :email", array(':email' => $model->email))) {
                    $model->addError('email', 'User with this email already registered');
                    $this->render("index", array('model' => $model));
                 } else {
                    $model->password = md5($model->password);
                    $model->save();
                    $this->render("success");
                }
           } 
           else {
               $this->render("index", array('model' => $model));
           }
         } 
         else {
            $this->render("index", array('model' => $model));
        }
    }
    
    
    public function actionLogin()
    {

	$this->pageTitle = 'Sing In your account for sale you pet or search breeding';

	$this->pageDescription = 'Sign In your account. Want buy cool pet or sale your pets? 4Claw.com - it�s best place for search breeding and adopt dogs or cats.';

        $model = new UsersAuth();
        
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('profile/user', array('id' => Yii::app()->user->id)));
         } 
         else {
                          
            if (!empty($_POST['UsersAuth'])) {
                $model->attributes = $_POST['UsersAuth'];
                if($model->validate()) {
                    $this->redirect(Yii::app()->createUrl('index/index'));
                } 
            } 
            $this->render('login', array('model' => $model));
            return;
        }
        
        $this->render('login', array('model' => $model));
    }    
    
    
    
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->user->returnUrl);
    }
    
    
    public function actionContact()
    {
		$this->pageTitle = 'Contact us - 4Claw.com';		
	$this->pageDescription = 'If you have some idea for improve 4Claw.com, please contact us.';

        $model = new Contact();
        if(isset($_POST['Contact'])) {
            $model->attributes= Yii::app()->getRequest()->getPost('Contact');
            if($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', 'You message has been send.');
                $this->refresh();
            }
        }
        
        $this->render('contact', array(
            'model' => $model,
        ));
    }

	public function actionSitemap()
	{
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
          
            ini_set("max_execution_time", "99999");
            ini_set('user_agent', 'PHP');
            ini_set("memory_limit", "2000M");
	    $actions = array('sell', 'buy', 'adopt');
            $result  = '<?xml version="1.0" encoding="UTF-8"?>
                        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	    $i = 0;
            $j = 0;
            
             $codes = WorldCities::getCountryArray();
             foreach($codes as $code => $country) {
                $cities  = Cities::model()->findAll('code=:code', array(':code' => $code));
	        foreach($actions as $action) {
                   foreach(Pets::model()->getDogBreedArray() as $breed) {
                       foreach($cities as $city) {
                           $i++;
                           $url = 'http://4claw.com/pet/search.html?pet_status=' . $action .'&amp;pet=dog&amp;breed=' . $breed . '&amp;gender=&amp;age=&amp;country=' . $code . '&amp;city=' . $city->city;
                           $result .= "<url>
                                        <loc>" . $url . "</loc>
                                        <changefreq>daily</changefreq>
                                        <priority>0.8</priority>
                                      </url>";
                           
                           if($i > 10000) {
                               $result .= '</urlset>';
                               $j++;
                               file_put_contents('sitemap' . $j . '.xml', $result);
                               
                               $i = 0;
                               $result  = '<?xml version="1.0" encoding="UTF-8"?>
                                            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                               
                               //if($j > 3)die();
                           }
                       }
                   }		
                }
             }
	}


}
