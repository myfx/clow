(function() {
    
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });
    
    
    var MAIN = MAIN || {};
    var copyElBreed;
    var copyDogBreed;
    var copyCatBreed;
    var copyAnyBreed;
    
    MAIN.navigation = function() {
        var location_url = window.location.href,
            hostname 	 = window.location.protocol+'//'+window.location.hostname;
	
        $('#responsive-menu > ul > li > a').each(function () {
            var self = $(this);
	
		var flag = (location_url.search($(this).attr('href'))>=0 && $(this).attr('href')!='/')
			 ? true
			 : false;
            if(location_url==hostname + $(this).attr('href') || location_url == hostname + $(this).attr('href')+'/' || flag) {
                self.addClass('active');
            }
	
	    if(location_url.search('/profile')>=0 && $(this).attr('href').search('/profile') >= 0) {
		self.addClass('active');
	    }
        });
    };
    
    MAIN.breedChange = function() {
	
	copyDogBreed = $('#dog-breed').clone().removeClass('hidden');
	copyCatBreed = $('#cat-breed').clone().removeClass('hidden');
        copyAnyBreed = $('#any-breed').clone().removeClass('hidden');
	
	var def = $('[name="pet"]').val();
	if(def == 'dog') {
		$('#cat-breed').remove();
		$('#any-breed').remove();
	}
	else if(def == 'cat') {
		$('#dog-breed').remove();
		$('#any-breed').remove();
	}
	else {
		$('#dog-breed').remove();
		$('#cat-breed').remove();
	}

        $('[name="pet"]').on('change', function() {
            var val = $(this).val();
            if(val == 'cat') {
                $('select[name="breed"]').remove();
                $('select[name="pet"]').after(copyCatBreed);
            }
            else if(val == 'dog') {
                $('select[name="breed"]').remove();
                $('select[name="pet"]').after(copyDogBreed);
            }
            else {
                 $('select[name="breed"]').remove();
                $('select[name="pet"]').after(copyAnyBreed);
            }
        });
    };
    
    
    MAIN.breedPet = function() {
        copyElBreed = $('#Pets_breed.hidden').clone();
        $('#Pets_breed.hidden').remove();
        copyElBreed.removeClass('hidden');
        
        $('#Pets_type').on('change', function() {
            var value = $(this).val();
            console.log(copyElBreed);
            if(value == 'cat') {
                $('[for="Pets_breed"]').after(copyElBreed);
                copyElBreed = $('.dog-breed').clone();
                $('.dog-breed').remove();
            }
            else if(value == 'dog') {
                $('[for="Pets_breed"]').after(copyElBreed);
                copyElBreed = $('.cat-breed').clone();
                $('.cat-breed').remove();
            }
        });
    };
    
    MAIN.countryChange = function() {
        $('[name="country"]').on('change', function(){
            var value = $(this).val();
	    var selectCity = $('[name="city"]'),
		loader	   = $('.ajax-loader');
	    selectCity.attr('disabled', 'disabled');
	    loader.removeClass('hidden');
            $.ajax({
                method: 'GET',
                data: {'code': value},
                url: '/ajax/city/',
                success: function(data){
		    selectCity.removeAttr('disabled');
		    loader.addClass('hidden');
                    $('[name="city"]').html(data);
                }
            });
        });
        
        $('[name="UsersEdit[country]"]').on('change', function(){
            var value = $(this).val(),
		city  =  $('[name="UsersEdit[city]"]'),
	     	loader = $('.ajax-loader');
 	    
	    loader.removeClass('hidden');
            city.attr('disabled', 'disabled');
            $.ajax({
                method: 'GET',
                data: {'code': value},
                url: '/ajax/city/',
                success: function(data){
		   city.removeAttr('disabled');
		   loader.addClass('hidden');
		   
                   city.html(data);
                }
            });
        });
    };
    
    MAIN.editProfile = function() {
        $('[name="UsersEdit[country]"]').on('change', function(){
             var value = $(this).val();
             $('[name="UsersEdit[city]"] option.city').addClass('hidden'); 
             $('[name="UsersEdit[city]"] option.'+value+'').removeClass('hidden');
             $('[name="UsersEdit[city]"] option').not('.city').attr('selected', 'selected');
        });
    };
    
    
    MAIN.petSearch = function() {
        if($_GET['country'] !== '' && (typeof $_GET['country'] != "undefined")) {
	    var selectCity = $('[name="city"]'),
		loader	   = $('.ajax-loader');
	    selectCity.attr('disabled', 'disabled');
	    loader.removeClass('hidden');
             $.ajax({
                method: 'GET',
                data: {'code': $_GET['country'], 'city': $_GET['city']},
                url: '/ajax/city/',
                success: function(data){
		    selectCity.removeAttr('disabled');
		    loader.addClass('hidden');
                    $('[name="city"]').html(data);
                }
            });
        }
        
        var city = $('[name="UsersEdit[city]"]').val();
        var code = $('[name="UsersEdit[country]"]').val();
       
        if((city !== '' && (typeof city != "undefined")) || (code !== '' && (typeof code != "undefined"))) {
	     $('[name="UsersEdit[city]"]').attr('disabled', 'disabled');
	     var loader = $('.ajax-loader');
 	     loader.removeClass('hidden');
             $.ajax({
                method: 'GET',
                data: {'code': code, 'city': city},
                url: '/ajax/city/',
                success: function(data){
		    $('[name="UsersEdit[city]"]').removeAttr('disabled');
		    loader.addClass('hidden');
                    $('[name="UsersEdit[city]"]').html(data);
                }
            });
        }
    };
    
    
    $(function(){
        MAIN.navigation();
        MAIN.breedChange();
        MAIN.breedPet();
        MAIN.countryChange();
        MAIN.editProfile();
        MAIN.petSearch();
    });
})();
