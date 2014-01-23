<?php

/**
 * This is the model class for table "pets".
 *
 * The followings are the available columns in table 'pets':
 * @property string $id
 * @property string $type
 * @property string $breed
 * @property string $name
 * @property string $date_birthday
 * @property string $sex
 * @property string $color
 * @property string $tattoo
 * @property string $sire
 * @property string $dame
 * @property string $owner_type
 * @property string $honors
 * @property string $photo_preview
 * @property string $date_created
 * @property string $pet_status
 * @property string $about
 * @property integer $uid
 * @property string $address
 * @property string $veterinary
 * @property string $vaccinations
 * @property string $show_class
 * @property string $certificate
 * @property string $country
 * @property string $city
*  @property string $price
 * @property string $neutered_spayed
 */
class Pets extends CActiveRecord
{
        public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pets the static model class
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
		return 'pets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('breed, name, date_birthday, pet_status', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('type, breed, ,price, name, color, tattoo, sire, dame, owner_type, photo_preview, pet_status', 'length', 'max'=>255),
			array('sex', 'length', 'max'=>25),
			array('veterinary, neutered_spayed, vaccinations, show_class, certificate', 'length', 'max'=>1),
                    
                        array('image', 'file', 'types'=>'jpg, gif, png', 'maxSize' => 1048576, 'allowEmpty'=>true ),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, price, type, breed, name, date_birthday, country, city, sex, color, tattoo, sire, dame, owner_type, honors, photo_preview, date_created, pet_status, about, uid, address, veterinary, neutered_spayed, vaccinations, show_class, certificate', 'safe', 'on'=>'search'),
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
	    //$user = new Users();
	    $user = Users::model()->findByPk(Yii::app()->user->id);
            
	    $country = $user->country;
	    $city    = $user->city;
	    $this->date_created = date('Y-m-d H:i:s');
            $this->uid          = Yii::app()->user->id;
            $this->country      = $country;
            $this->city         = $city;
            return true;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'breed' => 'Breed',
			'name' => 'Name',
			'date_birthday' => 'Date Birthday',
			'sex' => 'Sex',
			'color' => 'Color',
			'tattoo' => 'Tattoo',
			'sire' => 'Sire',
			'dame' => 'Dame',
			'owner_type' => 'Owner Type',
			'honors' => 'Honors',
			'photo_preview' => 'Photo',
			'date_created' => 'Date Created',
			'pet_status' => 'Action',
			'about' => 'About',
			'uid' => 'Uid',
			'address' => 'Address',
			'veterinary' => 'Veterinary',
			'vaccinations' => 'Vaccinations',
			'show_class' => 'Show Class',
			'certificate' => 'Certificate',
                        'city'         => 'City',
                        'country'         => 'Country',
                        'price' => 'Price, $',
                        'neutered_spayed' => 'Neutered/Spayed',
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
		$criteria->compare('price',$this->price,true);

		$criteria->compare('type',$this->type,true);
		$criteria->compare('breed',$this->breed,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_birthday',$this->date_birthday,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('tattoo',$this->tattoo,true);
		$criteria->compare('sire',$this->sire,true);
		$criteria->compare('dame',$this->dame,true);
		$criteria->compare('owner_type',$this->owner_type,true);
		$criteria->compare('honors',$this->honors,true);
		$criteria->compare('photo_preview',$this->photo_preview,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('pet_status',$this->pet_status,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('veterinary',$this->veterinary,true);
		$criteria->compare('vaccinations',$this->vaccinations,true);
		$criteria->compare('show_class',$this->show_class,true);
		$criteria->compare('certificate',$this->certificate,true);
                $criteria->compare('neutered_spayed',$this->certificate,true);
                

                $criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);

                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function findPetsByFilter($filter = array())
        {
            if (empty($filter)) return Pets::model()->findAll();
            
            $criteria = new CDbCriteria();
            
            if (array_key_exists('action', $filter) && !empty($filter['action'])) {
                $criteria->compare('pet_status', $filter['action']);
            }
            
            if (array_key_exists('pet', $filter) && !empty($filter['pet'])) {
                $criteria->compare('type', $filter['pet']);
            }
            
            if (array_key_exists('breed', $filter) && !empty($filter['breed'])) {
                $criteria->compare('breed', $filter['breed']);
            }
            
            if (array_key_exists('gender', $filter) && !empty($filter['gender'])) {
                $criteria->compare('sex', $filter['gender']);
            }
            
            if (array_key_exists('age', $filter) && !empty($filter['age'])
                    && is_array($filter['age'])
                    ) {
                $criteria->compare('date_birthday', '>' . $filter['age']['date_from']);
                $criteria->compare('date_birthday', '<' . $filter['age']['date_to']);
            }
            
            if (array_key_exists('country', $filter) && !empty($filter['country'])) {
                $criteria->compare('country', $filter['country']);
            }
            
            if (array_key_exists('city', $filter) && !empty($filter['city'])) {
                $criteria->compare('city', $filter['city']);
            }
            
            if (array_key_exists('veterinary', $filter) && !empty($filter['veterinary'])) {
                $criteria->compare('veterinary', $filter['veterinary']);
            }
            
            if (array_key_exists('neutered_spayed', $filter) && !empty($filter['neutered_spayed'])) {
                $criteria->compare('neutered_spayed', $filter['neutered_spayed']);
            }
            
            if (array_key_exists('show_class', $filter) && !empty($filter['show_class'])) {
                $criteria->compare('show_class', $filter['show_class']);
            }
            
            if (array_key_exists('honors', $filter) && !empty($filter['honors'])) {
                $criteria->compare('honors', $filter['honors']);
            }
            
            if (array_key_exists('vaccinations', $filter) && !empty($filter['vaccinations'])) {
                $criteria->compare('vaccinations', $filter['vaccinations']);
            }
            
            if (array_key_exists('certificate', $filter) && !empty($filter['certificate'])) {
                $criteria->compare('certificate', $filter['certificate']);
            }
            
            $foundedPets = self::model()->findAll($criteria);
            
            return $foundedPets;
        }
        
        
        
        
        
        public function getCatBreeds()
        {
            return '<option value="">Breed(Any)</option>
                    <option value="Abyssinian">Abyssinian</option>
                    <option value="Aegean">Aegean</option>
                    <option value="American Bobtail">American Bobtail</option>
                    <option value="American Curl">American Curl</option>
                    <option value="American Polydactyl">American Polydactyl</option>
                    <option value="American Shorthair">American Shorthair</option>
                    <option value="American Wirehair">American Wirehair</option>
                    <option value="Arabian Mau">Arabian Mau</option>
                    <option value="Asian">Asian</option>
                    <option value="Asian Semi-longhair">Asian Semi-longhair</option>
                    <option value="Australian Mist">Australian Mist</option>
                    <option value="Balinese">Balinese</option>
                    <option value="Bambino">Bambino</option>
                    <option value="Bengal">Bengal</option>
                    <option value="Birman">Birman</option>
                    <option value="Bombay">Bombay</option>
                    <option value="Brazilian Shorthair">Brazilian Shorthair</option>
                    <option value="British Longhair">British Longhair</option>
                    <option value="British Shorthair">British Shorthair</option>
                    <option value="Burmese">Burmese</option>
                    <option value="Burmilla">Burmilla</option>
                    <option value="California Spangled">California Spangled</option>
                    <option value="Chantilly-Tiffany">Chantilly-Tiffany</option>
                    <option value="Chartreux">Chartreux</option>
                    <option value="Chausie">Chausie</option>
                    <option value="Cheetoh">Cheetoh</option>
                    <option value="Colorpoint Shorthair">Colorpoint Shorthair</option>
                    <option value="Cornish Rex">Cornish Rex</option>
                    <option value="Cymric">Cymric</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Devon Rex">Devon Rex</option>
                    <option value="Donskoy or Don Sphynx">Donskoy or Don Sphynx</option>
                    <option value="Dragon Li">Dragon Li</option>
                    <option value="Dwelf">Dwelf</option>
                    <option value="Egyptian Mau">Egyptian Mau</option>
                    <option value="European Shorthair">European Shorthair</option>
                    <option value="Exotic Shorthair">Exotic Shorthair</option>
                    <option value="German Rex">German Rex</option>
                    <option value="Havana Brown">Havana Brown</option>
                    <option value="Havana Brown">Highlander</option>
                    <option value="Himalayan-Colorpoint Persian">Himalayan-Colorpoint Persian</option>
                    <option value="Japanese Bobtail">Japanese Bobtail</option>
                    <option value="Javanese">Javanese</option>
                    <option value="Khao Manee">Khao Manee</option>
                    <option value="Korat">Korat</option>
                    <option value="Kurilian Bobtail">Kurilian Bobtail</option>
                    <option value="LaPerm">LaPerm</option>
                    <option value="Maine Coon">Maine Coon</option>
                    <option value="Manx">Manx</option>
                    <option value="Mekong bobtail">Mekong bobtail</option>
                    <option value="Minskin">Minskin</option>
                    <option value="Munchkin">Munchkin</option>
                    <option value="Napoleon">Napoleon</option>
                    <option value="Nebelung">Nebelung</option>
                    <option value="Norwegian Forest">Norwegian Forest</option>
                    <option value="Ocicat">Ocicat</option>
                    <option value="Ojos Azules">Ojos Azules</option>
                    <option value="Oregon Rex">Oregon Rex</option>
                    <option value="Oriental Bicolor">Oriental Bicolor</option>
                    <option value="Oriental Longhair">Oriental Longhair</option>
                    <option value="Oriental Shorthair">Oriental Shorthair</option>
                    <option value="Persian">Persian</option>
                    <option value="Peterbald">Peterbald</option>
                    <option value="Pixie-bob">Pixie-bob</option>
                    <option value="Ragamuffin">Ragamuffin</option>
                    <option value="Ragdoll">Ragdoll</option>
                    <option value="Russian Black, White or Tabby">Russian Black, White or Tabby</option>
                    <option value="Russian Blue">Russian Blue</option>
                    <option value="Savannah">Savannah</option>
                    <option value="Scottish Fold">Scottish Fold</option>
                    <option value="Selkirk Rex">Selkirk Rex</option>
                    <option value="Serengeti">Serengeti</option>
                    <option value="Serrade petit">Serrade petit</option>
                    <option value="Siamese">Siamese</option>
                    <option value="Siberian">Siberian</option>
                    <option value="Singapura">Singapura</option>
                    <option value="Snowshoe">Snowshoe</option>
                    <option value="Sokoke">Sokoke</option>
                    <option value="Somali">Somali</option>
                    <option value="Sphynx">Sphynx</option>
                    <option value="Swedish forest">Swedish forest</option>
                    <option value="Thai">Thai</option>
                    <option value="Tonkinese">Tonkinese</option>
                    <option value="Toyger">Toyger</option>
                    <option value="Turkish Angora">Turkish Angora</option>
                    <option value="Turkish Van">Turkish Van</option>
                    <option value="Ukrainian Levkoy">Ukrainian Levkoy</option>
                    <option value="York Chocolate">York Chocolate</option>';
        }
        
        
        public function getDogBreeds()
        {
            return '<option value="">Breed(Any)</option>
                    <option value="Affenpinscher">Affenpinscher</option>
                    <option value="Afghan Hound">Afghan Hound</option>
                    <option value="Airedale Terrier">Airedale Terrier</option>
                    <option value="Akita">Akita</option>
                    <option value="Alapaha Blue Blood Bulldog">Alapaha Blue Blood Bulldog</option>
                    <option value="Alaskan Malamute">Alaskan Malamute</option>
                    <option value="American Bulldog">American Bulldog</option>
                    <option value="American Cocker Spaniel">American Cocker Spaniel</option>
                    <option value="Anatolian Shepherd">Anatolian Shepherd</option>
                    <option value="Australian Cattle Dog">Australian Cattle Dog</option>
                    <option value="Australian Shepherd">Australian Shepherd</option>
                    <option value="Australian Silky Terrier">Australian Silky Terrier</option>
                    <option value="Australian Terrier">Australian Terrier</option>
                    <option value="Basenji">Basenji</option>
                    <option value="Basset Bleu De Gascogne">Basset Bleu De Gascogne</option>
                    <option value="Basset Fauve De Bretagne">Basset Fauve De Bretagne</option>
                    <option value="Basset Griffon Vendeen">Basset Griffon Vendeen</option>
                    <option value="Basset Hound">Basset Hound</option>
                    <option value="Bavarian Mountain Hound">Bavarian Mountain Hound</option>
                    <option value="Beagle">Beagle</option>
                    <option value="Bearded Collie">Bearded Collie</option>
                    <option value="Beauceron">Beauceron</option>
                    <option value="Bedlington Terrier">Bedlington Terrier</option>
                    <option value="Belgian Shepherd Dog">Belgian Shepherd Dog</option>
                    <option value="Bergamasco">Bergamasco</option>
                    <option value="Bernese Mountain Dog">Bernese Mountain Dog</option>
                    <option value="Bichon Frise">Bichon Frise</option>
                    <option value="Biewer Terrier">Biewer Terrier</option>
                    <option value="Bloodhound">Bloodhound</option>
                    <option value="Boerboel">Boerboel</option>
                    <option value="Bolognese">Bolognese</option>
                    <option value="Border Collie">Border Collie</option>
                    <option value="Border Terrier">Border Terrier</option>
                    <option value="Borzoi">Borzoi</option>
                    <option value="Boston Terrier">Boston Terrier</option>
                    <option value="Bouvier Des Flandres">Bouvier Des Flandres</option>
                    <option value="Boxer">Boxer</option>
                    <option value="Bracco Italiano">Bracco Italiano</option>
                    <option value="Briard">Briard</option>
                    <option value="Brittany Spaniel">Brittany Spaniel</option>
                    <option value="Bullmastif">Bullmastif</option>
                    <option value="Cairn Terrier">Cairn Terrier</option>
                    <option value="Canaan Dog">Canaan Dog</option>
                    <option value="Canadian Eskimo Dog">Canadian Eskimo Dog</option>
                    <option value="Cane Corso">Cane Corso</option>
                    <option value="Catalan Sheepdog">Catalan Sheepdog</option>
                    <option value="Caucasian Shepherd Dog">Caucasian Shepherd Dog</option>
                    <option value="Cavachon">Cavachon</option>
                    <option value="Cavalier King Charles Spaniel">Cavalier King Charles Spaniel</option>
                    <option value="Cavapoo">Cavapoo</option>
                    <option value="Cesky Terrier">Cesky Terrier</option>
                    <option value="Chesapeake Bay Retriever">Chesapeake Bay Retriever</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Chinese Crested">Chinese Crested</option>
                    <option value="Chow Chow">Chow Chow</option>
                    <option value="Clumber Spaniel">Clumber Spaniel</option>
                    <option value="Cockapoo">Cockapoo</option>
                    <option value="Cocker Spaniel">Cocker Spaniel</option>
                    <option value="Coonhound">Coonhound</option>
                    <option value="Curly Coated Retriever">Coton De Tulear</option>
                    <option value="Curly Coated Retriever">Curly Coated Retriever</option>
                    <option value="Dachshund">Dachshund</option>
                    <option value="Dalmatian">Dalmatian</option>
                    <option value="Dandie Dinmont Terrier">Dandie Dinmont Terrier</option>
                    <option value="Deerhound">Deerhound</option>
                    <option value="Dobermann">Dobermann</option>
                    <option value="Dogue De Bordeaux">Dogue De Bordeaux</option>
                    <option value="Dorset Old Tyme Bulldog">Dorset Old Tyme Bulldog</option>
                    <option value="English Bull Terrier">English Bull Terrier</option>
                    <option value="English Bulldog">English Bulldog</option>
                    <option value="English Setter">English Setter</option>
                    <option value="English Springer Spaniel">English Springer Spaniel</option>
                    <option value="English Toy Terrier">English Toy Terrier</option>
                    <option value="Entlebucher Mountain Dog">Entlebucher Mountain Dog</option>
                    <option value="Estrela Mountain Dog">Estrela Mountain Dog</option>
                    <option value="Eurasier">Eurasier</option>
                    <option value="Field Spaniel">Field Spaniel</option>
                    <option value="Finnish Lapphund">Finnish Lapphund</option>
                    <option value="Finnish Spitz">Finnish Spitz</option>
                    <option value="Flat coated Retriever">Flat coated Retriever</option>
                    <option value="Fox Terrier">Fox Terrier</option>
                    <option value="Foxhound">Foxhound</option>
                    <option value="French Bulldog">French Bulldog</option>
                    <option value="German Longhaired Pointer">German Longhaired Pointer</option>
                    <option value="German Shepherd">German Shepherd</option>
                    <option value="German Shorthaired Pointer">German Shorthaired Pointer</option>
                    <option value="German Spitz">German Spitz</option>
                    <option value="German Wirehaired Pointer">German Wirehaired Pointer</option>
                    <option value="Giant Schnauzer">Giant Schnauzer</option>
                    <option value="Glen of Imaal Terrier">Glen of Imaal Terrier</option>
                    <option value="Golden Retriever">Golden Retriever</option>
                    <option value="Goldendoodle">Goldendoodle</option>
                    <option value="Gordon Setter">Gordon Setter</option>
                    <option value="Grand Bleu De Gascogne">Grand Bleu De Gascogne</option>
                    <option value="Great Dane">Great Dane</option>
                    <option value="Greenland Dog">Greenland Dog</option>
                    <option value="Greyhound">Greyhound</option>
                    <option value="Griffon Bruxellois">Griffon Bruxellois</option>
                    <option value="Havanese">Havanese</option>
                    <option value="Hovawart">Hovawart</option>
                    <option value="Hungarian Puli">Hungarian Puli</option>
                    <option value="Hungarian Vizsla">Hungarian Vizsla</option>
                    <option value="Irish Setter">Irish Setter</option>
                    <option value="Irish Terrier">Irish Terrier</option>
                    <option value="Irish Water Spaniel">Irish Water Spaniel</option>
                    <option value="Irish Wolfhound">Irish Wolfhound</option>
                    <option value="Italian Greyhound">Italian Greyhound</option>
                    <option value="Italian Spinone">Italian Spinone</option>
                    <option value="Jack Russell">Jack Russell</option>
                    <option value="Japanese Akita Inu">Japanese Akita Inu</option>
                    <option value="Japanese Chin">Japanese Chin</option>
                    <option value="Japanese Shiba Inu">Japanese Shiba Inu</option>
                    <option value="Japanese Spitz">Japanese Spitz</option>
                    <option value="Jug">Jug</option>
                    <option value="Keeshond">Keeshond</option>
                    <option value="Kerry Blue Terrier">Kerry Blue Terrier</option>
                    <option value="King Charles Spaniel">King Charles Spaniel</option>
                    <option value="Komondor">Komondor</option>
                    <option value="Korthals Griffon">Korthals Griffon</option>
                    <option value="Kromfohrlander">Kromfohrlander</option>
                    <option value="Labradoodle">Labradoodle</option>
                    <option value="Labrador Retriever">Labrador Retriever</option>
                    <option value="Lakeland Terrier">Lakeland Terrier</option>
                    <option value="Lancashire Heeler">Lancashire Heeler</option>
                    <option value="Leonberger">Leonberger</option>
                    <option value="Lhasa Apso">Lhasa Apso</option>
                    <option value="Lowchen">Lowchen</option>
                    <option value="Lurcher">Lurcher</option>
                    <option value="Maltese Terrier">Maltese Terrier</option>
                    <option value="Maltipoo">Maltipoo</option>
                    <option value="Manchester Terrier">Manchester Terrier</option>
                    <option value="Mastiff">Mastiff</option>
                    <option value="Mexican Hairless">Mexican Hairless</option>
                    <option value="Mi-Ki">Mi-Ki</option>
                    <option value="Miniature Dachshund">Miniature Dachshund</option>
                    <option value="Miniature Pinscher">Miniature Pinscher</option>
                    <option value="Miniature Poodle">Miniature Poodle</option>
                    <option value="Miniature Schnauzer">Miniature Schnauzer</option>
                    <option value="Neapolitan Mastiff">Neapolitan Mastiff</option>
                    <option value="Newfoundland">Newfoundland</option>
                    <option value="Norfolk Terrier">Norfolk Terrier</option>
                    <option value="Northern Inuit">Northern Inuit</option>
                    <option value="Norwegian Elkhound">Norwegian Elkhound</option>
                    <option value="Norwich Terrier">Norwich Terrier</option>
                    <option value="Nova Scotia Duck Tolling Retriever">Nova Scotia Duck Tolling Retriever</option>
                    <option value="Old English Sheepdog">Old English Sheepdog</option>
                    <option value="Old Tyme Bulldog">Old Tyme Bulldog</option>
                    <option value="Otterhound">Otterhound</option>
                    <option value="Papillon">Papillon</option>
                    <option value="Parson Russell">Parson Russell</option>
                    <option value="Patterdale Terrier">Patterdale Terrier</option>
                    <option value="Pekingese">Pekingese</option>
                    <option value="Pharaoh Hound">Pharaoh Hound</option>
                    <option value="Pinscher">Pinscher</option>
                    <option value="Plummer Terrier">Plummer Terrier</option>
                    <option value="Pointer">Pointer</option>
                    <option value="Pomeranian">Pomeranian</option>
                    <option value="Poodle">Poodle</option>
                    <option value="Portuguese Podengo">Portuguese Podengo</option>
                    <option value="Portuguese Sheepdog">Portuguese Sheepdog</option>
                    <option value="Portuguese Water Dog">Portuguese Water Dog</option>
                    <option value="Pug">Pug</option>
                    <option value="Puggle">Puggle</option>
                    <option value="Pyrenean Mastiff">Pyrenean Mastiff</option>
                    <option value="Pyrenean Mountain Dog">Pyrenean Mountain Dog</option>
                    <option value="Pyrenean SheepdogPyrenean Sheepdog</option>
                    <option value="Rhodesian Ridgeback">Rhodesian Ridgeback</option>
                    <option value="Rottweiler">Rottweiler</option>
                    <option value="Rough Collie">Rough Collie</option>
                    <option value="Russian Black Terrier">Russian Black Terrier</option>
                    <option value="Saarloos Wolfdog">Saarloos Wolfdog</option>
                    <option value="Saint Bernard">Saint Bernard</option>
                    <option value="Saluki">Saluki</option>
                    <option value="Samoyed">Samoyed</option>
                    <option value="Schipperke">Schipperke</option>
                    <option value="Schnauzer">Schnauzer</option>
                    <option value="Schnoodle">Schnoodle</option>
                    <option value="Scottish Terrier">Scottish Terrier</option>
                    <option value="Sealyham Terrier">Sealyham Terrier</option>
                    <option value="Shar Pei">Shar Pei</option>
                    <option value="Shetland Sheepdog">Shetland Sheepdog</option>
                    <option value="Shih Tzu">Shih Tzu</option>
                    <option value="Siberian Husky">Siberian Husky</option>
                    <option value="Skye Terrier">Skye Terrier</option>
                    <option value="Sloughi">Sloughi</option>
                    <option value="Smooth Collie">Smooth Collie</option>
                    <option value="Soft Coated Wheaten Terrier">Soft Coated Wheaten Terrier</option>
                    <option value="Spanish Water DogSpanish Water Dog</option>
                    <option value="Sprocker">Sprocker</option>
                    <option value="Staffordshire Bull Terrier">Staffordshire Bull Terrier</option>
                    <option value="Standard Poodle">Standard Poodle</option>
                    <option value="Sussex Spaniel">Sussex Spaniel</option>
                    <option value="Tibetan Mastiff">Tibetan Mastiff</option>
                    <option value="Tibetan Spaniel">Tibetan Spaniel</option>
                    <option value="Tibetan Terrier">Tibetan Terrier</option>
                    <option value="Toy Poodle">Toy Poodle</option>
                    <option value="Utonagan">Utonagan</option>
                    <option value="Weimaraner">Weimaraner</option>
                    <option value="Welsh Collie">Welsh Collie</option>
                    <option value="Welsh Corgi">Welsh Corgi</option>
                    <option value="Welsh Springer Spaniel">Welsh Springer Spaniel</option>
                    <option value="Welsh Terrier">Welsh Terrier</option>
                    <option value="West Highland Terrier">West Highland Terrier</option>
                    <option value="Whippet">Whippet</option>
                    <option value="White Swiss Shepherd">White Swiss Shepherd</option>
                    <option value="Yorkshire Terrier">Yorkshire Terrier</option>';
        }
        
        
        public function getCatBreedArray()
        {
            return array(
                'Abyssinian'=>'Abyssinian',
                'Aegean'=>'Aegean',
                'American Bobtail'=>'American Bobtail',
                'American Curl'=>'American Curl',
                'American Polydactyl'=>'American Polydactyl',
                'American Shorthair'=>'American Shorthair',
                'American Wirehair'=>'American Wirehair',
                'Arabian Mau'=>'Arabian Mau',
                'Asian'=>'Asian',
                'Asian Semi-longhair'=>'Asian Semi-longhair',
                'Australian Mist'=>'Australian Mist',
                'Balinese'=>'Balinese',
                'Bambino'=>'Bambino',
                'Bengal'=>'Bengal',
                'Birman'=>'Birman',
                'Bombay'=>'Bombay',
                'Brazilian Shorthair'=>'Brazilian Shorthair',
                'British Longhair'=>'British Longhair',
                'British Shorthair'=>'British Shorthair',
                'Burmese'=>'Burmese',
                'Burmilla'=>'Burmilla',
                'California Spangled'=>'California Spangled',
                'Chantilly/Tiffany'=>'Chantilly/Tiffany',
                'Chartreux'=>'Chartreux',
                'Chausie'=>'Chausie',
                'Cheetoh'=>'Cheetoh',
                'Colorpoint Shorthair'=>'Colorpoint Shorthair',
                'Cornish Rex'=>'Cornish Rex',
                'Cymric'=>'Cymric',
                'Cyprus'=>'Cyprus',
                'Devon Rex'=>'Devon Rex',
                'DonskoyВ or Don Sphynx'=>'DonskoyВ or Don Sphynx',
                'Dragon Li'=>'Dragon Li',
                'Dwelf'=>'Dwelf',
                'Egyptian Mau'=>'Egyptian Mau',
                'European Shorthair'=>'European Shorthair',
                'Exotic Shorthair'=>'Exotic Shorthair',
                'German Rex'=>'German Rex',
                'Havana Brown'=>'Havana Brown',
                'Highlander'=>'Highlander',
                'Himalayan/Colorpoint Persian'=>'Himalayan/Colorpoint Persian',
                'Japanese Bobtail'=>'Japanese Bobtail',
                'Javanese'=>'Javanese',
                'Khao Manee'=>'Khao Manee',
                'Korat'=>'Korat',
                'Kurilian Bobtail'=>'Kurilian Bobtail',
                'LaPerm'=>'LaPerm',
                'Maine Coon'=>'Maine Coon',
                'Manx'=>'Manx',
                'Mekong bobtail'=>'Mekong bobtail',
                'Minskin'=>'Minskin',
                'Munchkin'=>'Munchkin',
                'Napoleon'=>'Napoleon',
                'Nebelung'=>'Nebelung',
                'Norwegian Forest'=>'Norwegian Forest',
                'Ocicat'=>'Ocicat',
                'Ojos Azules'=>'Ojos Azules',
                'Oregon Rex'=>'Oregon Rex',
                'Oriental Bicolor'=>'Oriental Bicolor',
                'Oriental Longhair'=>'Oriental Longhair',
                'Oriental Shorthair'=>'Oriental Shorthair',
                'Persian'=>'Persian',
                'Peterbald'=>'Peterbald',
                'Pixie-bob'=>'Pixie-bob',
                'Ragamuffin'=>'Ragamuffin',
                'Ragdoll'=>'Ragdoll',
                'Russian Black White or Tabby'=>'Russian Black White or Tabby',
                'Russian Blue'=>'Russian Blue',
                'Savannah'=>'Savannah',
                'Scottish Fold'=>'Scottish Fold',
                'Selkirk Rex'=>'Selkirk Rex',
                'Serengeti'=>'Serengeti',
                'Serrade petit'=>'Serrade petit',
                'Siamese'=>'Siamese',
                'Siberian'=>'Siberian',
                'Singapura'=>'Singapura',
                'Snowshoe'=>'Snowshoe',
                'Sokoke'=>'Sokoke',
                'Somali'=>'Somali',
                'Sphynx'=>'Sphynx',
                'Swedish forest'=>'Swedish forest',
                'Thai'=>'Thai',
                'Tonkinese'=>'Tonkinese',
                'Toyger'=>'Toyger',
                'Turkish Angora'=>'Turkish Angora',
                'Turkish Van'=>'Turkish Van',
                'Ukrainian Levkoy'=>'Ukrainian Levkoy',
                'York Chocolate'=>'York Chocolate',
            );
        }
        
        
        public function getDogBreedArray()
        {
            return array(
                'Affenpinscher'=>'Affenpinscher',
                'Afghan Hound'=>'Afghan Hound',
                'Airedale Terrier'=>'Airedale Terrier',
                'Akita'=>'Akita',
                'Alapaha Blue Blood Bulldog'=>'Alapaha Blue Blood Bulldog',
                'Alaskan Malamute'=>'Alaskan Malamute',
                'American Bulldog'=>'American Bulldog',
                'American Cocker Spaniel'=>'American Cocker Spaniel',
                'Anatolian Shepherd'=>'Anatolian Shepherd',
                'Australian Cattle Dog'=>'Australian Cattle Dog',
                'Australian Shepherd'=>'Australian Shepherd',
                'Australian Silky Terrier'=>'Australian Silky Terrier',
                'Australian Terrier'=>'Australian Terrier',
                'Basenji'=>'Basenji',
                'Basset Bleu De Gascogne'=>'Basset Bleu De Gascogne',
                'Basset Fauve De Bretagne'=>'Basset Fauve De Bretagne',
                'Basset Griffon Vendeen'=>'Basset Griffon Vendeen',
                'Basset Hound'=>'Basset Hound',
                'Bavarian Mountain Hound'=>'Bavarian Mountain Hound',
                'Beagle'=>'Beagle',
                'Bearded Collie'=>'Bearded Collie',
                'Beauceron'=>'Beauceron',
                'Bedlington Terrier'=>'Bedlington Terrier',
                'Belgian Shepherd Dog'=>'Belgian Shepherd Dog',
                'Bergamasco'=>'Bergamasco',
                'Bernese Mountain Dog'=>'Bernese Mountain Dog',
                'Bichon Frise'=>'Bichon Frise',
                'Biewer Terrier'=>'Biewer Terrier',
                'Bloodhound'=>'Bloodhound',
                'Boerboel'=>'Boerboel',
                'Bolognese'=>'Bolognese',
                'Border Collie'=>'Border Collie',
                'Border Terrier'=>'Border Terrier',
                'Borzoi'=>'Borzoi',
                'Boston Terrier'=>'Boston Terrier',
                'Bouvier Des Flandres'=>'Bouvier Des Flandres',
                'Boxer'=>'Boxer',
                'Bracco Italiano'=>'Bracco Italiano',
                'Briard'=>'Briard',
                'Brittany Spaniel'=>'Brittany Spaniel',
                'Bullmastif'=>'Bullmastif',
                'Cairn Terrier'=>'Cairn Terrier',
                'Canaan Dog'=>'Canaan Dog',
                'Canadian Eskimo Dog'=>'Canadian Eskimo Dog',
                'Cane Corso'=>'Cane Corso',
                'Catalan Sheepdog'=>'Catalan Sheepdog',
                'Caucasian Shepherd Dog'=>'Caucasian Shepherd Dog',
                'Cavachon'=>'Cavachon',
                'Cavalier King Charles Spaniel'=>'Cavalier King Charles Spaniel',
                'Cavapoo'=>'Cavapoo',
                'Cesky Terrier'=>'Cesky Terrier',
                'Chesapeake Bay Retriever'=>'Chesapeake Bay Retriever',
                'Chihuahua'=>'Chihuahua',
                'Chinese Crested'=>'Chinese Crested',
                'Chow Chow'=>'Chow Chow',
                'Clumber Spaniel'=>'Clumber Spaniel',
                'Cockapoo'=>'Cockapoo',
                'Cocker Spaniel'=>'Cocker Spaniel',
                'Coonhound'=>'Coonhound',
                'Coton De Tulear'=>'Coton De Tulear',
                'Curly Coated Retriever'=>'Curly Coated Retriever',
                'Dachshund'=>'Dachshund',
                'Dalmatian'=>'Dalmatian',
                'Dandie Dinmont Terrier'=>'Dandie Dinmont Terrier',
                'Deerhound'=>'Deerhound',
                'Dobermann'=>'Dobermann',
                'Dogue De Bordeaux'=>'Dogue De Bordeaux',
                'Dorset Old Tyme Bulldog'=>'Dorset Old Tyme Bulldog',
                'English Bull Terrier'=>'English Bull Terrier',
                'English Bulldog'=>'English Bulldog',
                'English Setter'=>'English Setter',
                'English Springer Spaniel'=>'English Springer Spaniel',
                'English Toy Terrier'=>'English Toy Terrier',
                'Entlebucher Mountain Dog'=>'Entlebucher Mountain Dog',
                'Estrela Mountain Dog'=>'Estrela Mountain Dog',
                'Eurasier'=>'Eurasier',
                'Field Spaniel'=>'Field Spaniel',
                'Finnish Lapphund'=>'Finnish Lapphund',
                'Finnish Spitz'=>'Finnish Spitz',
                'Flat coated Retriever'=>'Flat coated Retriever',
                'Fox Terrier'=>'Fox Terrier',
                'Foxhound'=>'Foxhound',
                'French Bulldog'=>'French Bulldog',
                'German Longhaired Pointer'=>'German Longhaired Pointer',
                'German Shepherd'=>'German Shepherd',
                'German Shorthaired Pointer'=>'German Shorthaired Pointer',
                'German Spitz'=>'German Spitz',
                'German Wirehaired Pointer'=>'German Wirehaired Pointer',
                'Giant Schnauzer'=>'Giant Schnauzer',
                'Glen of Imaal Terrier'=>'Glen of Imaal Terrier',
                'Golden Retriever'=>'Golden Retriever',
                'Goldendoodle'=>'Goldendoodle',
                'Gordon Setter'=>'Gordon Setter',
                'Grand Bleu De Gascogne'=>'Grand Bleu De Gascogne',
                'Great Dane'=>'Great Dane',
                'Greenland Dog'=>'Greenland Dog',
                'Greyhound'=>'Greyhound',
                'Griffon Bruxellois'=>'Griffon Bruxellois',
                'Havanese'=>'Havanese',
                'Hovawart'=>'Hovawart',
                'Hungarian Puli'=>'Hungarian Puli',
                'Hungarian Vizsla'=>'Hungarian Vizsla',
                'Irish Setter'=>'Irish Setter',
                'Irish Terrier'=>'Irish Terrier',
                'Irish Water Spaniel'=>'Irish Water Spaniel',
                'Irish Wolfhound'=>'Irish Wolfhound',
                'Italian Greyhound'=>'Italian Greyhound',
                'Italian Spinone'=>'Italian Spinone',
                'Jack Russell'=>'Jack Russell',
                'Japanese Akita Inu'=>'Japanese Akita Inu',
                'Japanese Chin'=>'Japanese Chin',
                'Japanese Shiba Inu'=>'Japanese Shiba Inu',
                'Japanese Spitz'=>'Japanese Spitz',
                'Jug'=>'Jug',
                'Keeshond'=>'Keeshond',
                'Kerry Blue Terrier'=>'Kerry Blue Terrier',
                'King Charles Spaniel'=>'King Charles Spaniel',
                'Komondor'=>'Komondor',
                'Korthals Griffon'=>'Korthals Griffon',
                'Kromfohrlander'=>'Kromfohrlander',
                'Labradoodle'=>'Labradoodle',
                'Labrador Retriever'=>'Labrador Retriever',
                'Lakeland Terrier'=>'Lakeland Terrier',
                'Lancashire Heeler'=>'Lancashire Heeler',
                'Leonberger'=>'Leonberger',
                'Lhasa Apso'=>'Lhasa Apso',
                'Lowchen'=>'Lowchen',
                'Lurcher'=>'Lurcher',
                'Maltese Terrier'=>'Maltese Terrier',
                'Maltipoo'=>'Maltipoo',
                'Manchester Terrier'=>'Manchester Terrier',
                'Mastiff'=>'Mastiff',
                'Mexican Hairless'=>'Mexican Hairless',
                'Mi-Ki'=>'Mi-Ki',
                'Miniature Dachshund'=>'Miniature Dachshund',
                'Miniature Pinscher'=>'Miniature Pinscher',
                'Miniature Poodle'=>'Miniature Poodle',
                'Miniature Schnauzer'=>'Miniature Schnauzer',
                'Neapolitan Mastiff'=>'Neapolitan Mastiff',
                'Newfoundland'=>'Newfoundland',
                'Norfolk Terrier'=>'Norfolk Terrier',
                'Northern Inuit'=>'Northern Inuit',
                'Norwegian Elkhound'=>'Norwegian Elkhound',
                'Norwich Terrier'=>'Norwich Terrier',
                'Nova Scotia Duck Tolling Retriever'=>'Nova Scotia Duck Tolling Retriever',
                'Old English Sheepdog'=>'Old English Sheepdog',
                'Old Tyme Bulldog'=>'Old Tyme Bulldog',
                'Otterhound'=>'Otterhound',
                'Papillon'=>'Papillon',
                'Parson Russell'=>'Parson Russell',
                'Patterdale Terrier'=>'Patterdale Terrier',
                'Pekingese'=>'Pekingese',
                'Pharaoh Hound'=>'Pharaoh Hound',
                'Pinscher'=>'Pinscher',
                'Plummer Terrier'=>'Plummer Terrier',
                'Pointer'=>'Pointer',
                'Pomeranian'=>'Pomeranian',
                'Poodle'=>'Poodle',
                'Portuguese Podengo'=>'Portuguese Podengo',
                'Portuguese Sheepdog'=>'Portuguese Sheepdog',
                'Portuguese Water Dog'=>'Portuguese Water Dog',
                'Pug'=>'Pug',
                'Puggle'=>'Puggle',
                'Pyrenean Mastiff'=>'Pyrenean Mastiff',
                'Pyrenean Mountain Dog'=>'Pyrenean Mountain Dog',
                'Pyrenean SheepdogPyrenean Sheepdog'=>'Pyrenean SheepdogPyrenean Sheepdog',
                'Rhodesian Ridgeback'=>'Rhodesian Ridgeback',
                'Rottweiler'=>'Rottweiler',
                'Rough Collie'=>'Rough Collie',
                'Russian Black Terrier'=>'Russian Black Terrier',
                'Saarloos Wolfdog'=>'Saarloos Wolfdog',
                'Saint Bernard'=>'Saint Bernard',
                'Saluki'=>'Saluki',
                'Samoyed'=>'Samoyed',
                'Schipperke'=>'Schipperke',
                'Schnauzer'=>'Schnauzer',
                'Schnoodle'=>'Schnoodle',
                'Scottish Terrier'=>'Scottish Terrier',
                'Sealyham Terrier'=>'Sealyham Terrier',
                'Shar Pei'=>'Shar Pei',
                'Shetland Sheepdog'=>'Shetland Sheepdog',
                'Shih Tzu'=>'Shih Tzu',
                'Siberian Husky'=>'Siberian Husky',
                'Skye Terrier'=>'Skye Terrier',
                'Sloughi'=>'Sloughi',
                'Smooth Collie'=>'Smooth Collie',
                'Soft Coated Wheaten Terrier'=>'Soft Coated Wheaten Terrier',
                'Spanish Water DogSpanish Water Dog'=>'Spanish Water DogSpanish Water Dog',
                'Sprocker'=>'Sprocker',
                'Staffordshire Bull Terrier'=>'Staffordshire Bull Terrier',
                'Standard Poodle'=>'Standard Poodle',
                'Sussex Spaniel'=>'Sussex Spaniel',
                'Tibetan Mastiff'=>'Tibetan Mastiff',
                'Tibetan Spaniel'=>'Tibetan Spaniel',
                'Tibetan Terrier'=>'Tibetan Terrier',
                'Toy Poodle'=>'Toy Poodle',
                'Utonagan'=>'Utonagan',
                'Weimaraner'=>'Weimaraner',
                'Welsh Collie'=>'Welsh Collie',
                'Welsh Corgi'=>'Welsh Corgi',
                'Welsh Springer Spaniel'=>'Welsh Springer Spaniel',
                'Welsh Terrier'=>'Welsh Terrier',
                'West Highland Terrier'=>'West Highland Terrier',
                'Whippet'=>'Whippet',
                'White Swiss Shepherd'=>'White Swiss Shepherd',
                'Yorkshire Terrier'=>'Yorkshire Terrier',
            );
        }
}
