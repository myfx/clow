<?php

class AjaxController extends Controller {
    
    public function actionCity()
    {
        $code = Yii::app()->getRequest()->getQuery('code');
        $city = Yii::app()->getRequest()->getQuery('city');
        $cities = Cities::model()->findAll(array('order'=>'city', 'condition'=>'code=:code', 'params'=>array(':code' => $code)));
     
	//$cities = Cities::model()->findAll('code=:code', array(':code' => $code));
        $this->renderPartial('city', array('cities' => $cities, 'c' => $city));
    }
}
