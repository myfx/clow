<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $city
 * @property string $zipcode
 * @property string $country
 * @property string $phone
 * @property string $about
 * @property string $date_created
 * @property string $last_seen
 * @property string $url_photo
 * @property string $date_birthday
 * @property string $sex
 * @property string $site
 */
class UsersEdit extends CActiveRecord
{
        public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name', 'required'),
			array('first_name, last_name,site,  email, password, city, country, url_photo', 'length', 'max'=>255),
			array('zipcode', 'length', 'max'=>10),
			array('phone', 'length', 'max'=>20),
			array('sex', 'length', 'max'=>1),
                    
                        array('image', 'file', 'types'=>'jpg, gif, png', 'maxSize' => 1048576, 'allowEmpty'=>true ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, site, last_name, email, password, city, zipcode, country, phone, about, date_created, last_seen, url_photo, date_birthday, sex', 'safe', 'on'=>'search'),
		
                    );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

        public function beforeSave()
        {
            $this->date_created = date('Y-m-d H:i:s');
            return true;
        }
        


        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
			'city' => 'City',
			'zipcode' => 'Zipcode',
			'country' => 'Country',
			'phone' => 'Phone',
			'about' => 'About',
			'date_created' => 'Date Created',
			'last_seen' => 'Last Seen',
			'url_photo' => 'Avatar',
			'date_birthday' => 'Date Birthday',
			'sex' => 'Sex',
                        'site' => 'Site',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_seen',$this->last_seen,true);
		$criteria->compare('url_photo',$this->url_photo,true);
		$criteria->compare('date_birthday',$this->date_birthday,true);
		$criteria->compare('sex',$this->sex,true);
                $criteria->compare('site',$this->site,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}