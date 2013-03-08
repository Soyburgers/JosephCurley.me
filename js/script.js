//Hey Thanks for checking out my website and peaking around in my code! The next 100 lines of code I wrote entirely myself over the course of a week as part of a web design class offered through RISD in July of 2012. A lot of things are sloppy and not very DRY (I repeat myself quite a bit). I had a very tight deadline with making this site as it was an assignment and I plan to eventually re-write this in CoffeeScript which I have recently begun learning. The code after line 100 or so is part of my contact box which was made through help of a tutorial. Anyway, thanks! -Joseph 

$(function(){
	var portfolio = [
		["Cat's Cradle", '"images/portfolio/catscradle.png"',"Poster Design", "500px"],
		['Brandire', '"images/portfolio/brandire.png"' , "Typeface Design", "500px"],
		['Piet Mondrian','"images/portfolio/mondrian.png"', 'Logo Design', '750px'],
		['Singolo','"images/portfolio/singolo.png"', "Logo Design", "900px"],
		['Bodoni', '"images/portfolio/bodoni.png"', "Logo + Postcard", "532px"],
		['The Conformist', '"images/portfolio/conformist.png"',"Poster Design", "550px"],
		['BayEnd Farm', '"images/portfolio/bayendfarm.png"' ,"Website", "750px"],
		['Vegan Cookbook', '"images/portfolio/cookbook1.png"', "Book Design", "750px", '"images/portfolio/cookbook_spread1.png"', '"images/portfolio/cookbook_spread2.png"' , '"images/portfolio/cookbook_spread3.png"'],
		["Gennaro's Restaurant", '"images/portfolio/gennaros.jpg"', "Website", "570px"]

	];
	var l = 3;
	var index;
	var openWork = function(){
		$('.link_up').remove();
		$('#about').hide();
		$('p.description').hide();	
		$('p.description').eq(index).show().prepend('<a href="#workview" class="link_up">Check it out again?</a>');
		$('hgroup h1').html(portfolio[index][0]);
		$('hgroup h2').html(portfolio[index][2]);
		$('#workhide').css('max-width', portfolio[index][3]);
	}
	function slideShow() {
		if ( index < 8) {
			index++
		} else if (index >= 8){
			index = 0
		}
		$('#workframe').unbind('click');
		openWork();
		$('#workframe img.current_image').hide('slide', {direction: 'left'}, 500, function(){
			$('#workframe').html('<img class="current_image" src='+ portfolio[index][1]+' alt="'+portfolio[index][2]+'" />');			
			$('#workframe img.current_image').hide().show('slide', {direction: 'right'}, 500, function() {
				$('#workframe').bind('click', slideShow);
			});
		}).removeClass('current_image').addClass('prev_image');
	}		
	function closeWork(){
		$('#workview').slideUp([200]);
		$('.current_image').removeClass('current_image').slideUp([200]);
		$('p.description').hide();
		$('#about').show();
		$('hgroup h2').html("I'm a designer");
		$('hgroup h1').html("Hey I'm Joseph!");
		$('.link_up').remove();
		return false;
	}
	$('#click').click(function() {
		$('#interested').slideDown([200]);
	});
	
	$('#close a').click(function(){
		$('#interested').slideUp([200]);
	});

	$('#link_close').click(closeWork);
			
	$("#thumbnails a").click(function () {
		index = $("#thumbnails a").index(this);		
		openWork();
    	$('#workframe').empty();
		$('#workframe').html('').append('<img class="current_image" src='+ portfolio[index][1]+' alt="'+portfolio[index][2]+'" />');
		$('#workview').slideDown([200]);
		return false;
	 });
	 $('#workframe').click(slideShow);
	 
     $(document).keydown(function(e){
		if (e.keyCode == 40) { 
	    	$('#thumbnails a').eq(0).trigger('click');
	    	return false;
	    } else if (e.keyCode == 38){
	    	$('#link_close').trigger('click');
	    }
	  });
	  
	  $(document).keydown(function(e){
		if (e.keyCode == 39){ 
			slideShow();
			return false;
		} else if (e.keyCode == 37){
    		if (index > 0){
				index--
				} else if (index <= 0){
					index = 8
				}
			$('#workframe').unbind('click');
			openWork();
    		$('#workframe img.current_image').hide('slide', {direction: 'right'}, 500, function(){
				$('#workframe').html('<img class="current_image" src='+ portfolio[index][1]+' alt="'+portfolio[index][2]+'" />');			
				$('#workframe img.current_image').hide().show('slide', {direction: 'left'}, 500, function() {
    				$('#workframe').bind('click', slideShow);
    			});
			}).removeClass('current_image').addClass('prev_image');
		}
	});	
});

//Color Thumbnail Switcher
$(function() {
    $("img")
        .mouseover(function() { 
            var src = $(this).attr("src").replace("icons_bw", "icons_color");
            $(this).attr("src", src);
        })
        .mouseout(function() {
            var src = $(this).attr("src").replace("icons_color", "icons_bw");
            $(this).attr("src", src);
        });
});
	
    		


//ContactBox
$(function(){

	//set global variables and cache DOM elements for reuse later
	var form = $('#contact-form').find('form'),
		formElements = form.find('input[type!="submit"],textarea'),
		formSubmitButton = form.find('[type="submit"]'),
		errorNotice = $('#errors'),
		successNotice = $('#success'),
		loading = $('#loading'),
		errorMessages = {
			required: ' is a required field',
			email: 'You have not entered a valid email address for the field: ',
			minlength: ' must be greater than '
		}
	
	//feature detection + polyfills
	formElements.each(function(){

		//if HTML5 input placeholder attribute is not supported
		if(!Modernizr.input.placeholder){
			var placeholderText = this.getAttribute('placeholder');
			if(placeholderText){
				$(this)
					.addClass('placeholder-text')
					.val(placeholderText)
					.bind('focus',function(){
						if(this.value == placeholderText){
							$(this)
								.val('')
								.removeClass('placeholder-text');
						}
					})
					.bind('blur',function(){
						if(this.value == ''){
							$(this)
								.val(placeholderText)
								.addClass('placeholder-text');
						}
					});
			}
		}
		
		//if HTML5 input autofocus attribute is not supported
		if(!Modernizr.input.autofocus){
			if(this.getAttribute('autofocus')) this.focus();
		}
		
	});
	
	//to ensure compatibility with HTML5 forms, we have to validate the form on submit button click event rather than form submit event. 
	//An invalid html5 form element will not trigger a form submit.
	formSubmitButton.bind('click',function(){
		var formok = true,
			errors = [];
			
		formElements.each(function(){
			var name = this.name,
				nameUC = name.ucfirst(),
				value = this.value,
				placeholderText = this.getAttribute('placeholder'),
				type = this.getAttribute('type'), //get type old school way
				isRequired = this.getAttribute('required'),
				minLength = this.getAttribute('data-minlength');
			
			//if HTML5 formfields are supported			
			if( (this.validity) && !this.validity.valid ){
				formok = false;
				
				console.log(this.validity);
				
				//if there is a value missing
				if(this.validity.valueMissing){
					errors.push(nameUC + errorMessages.required);	
				}
				//if this is an email input and it is not valid
				else if(this.validity.typeMismatch && type == 'email'){
					errors.push(errorMessages.email + nameUC);
				}
				
				this.focus(); //safari does not focus element an invalid element
				return false;
			}
			
			//if this is a required element
			if(isRequired){	
				//if HTML5 input required attribute is not supported
				if(!Modernizr.input.required){
					if(value == placeholderText){
						this.focus();
						formok = false;
						errors.push(nameUC + errorMessages.required);
						return false;
					}
				}
			}

			//if HTML5 input email input is not supported
			if(type == 'email'){ 	
				if(!Modernizr.inputtypes.email){ 
					var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
				 	if( !emailRegEx.test(value) ){	
						this.focus();
						formok = false;
						errors.push(errorMessages.email + nameUC);
						return false;
					}
				}
			}
			
			//check minimum lengths
			if(minLength){
				if( value.length < parseInt(minLength) ){
					this.focus();
					formok = false;
					errors.push(nameUC + errorMessages.minlength + minLength + ' charcters');
					return false;
				}
			}
		});
		
		//if form is not valid
		if(!formok){
			
			//animate required field notice
			$('#req-field-desc')
				.stop()
				.animate({
					marginLeft: '+=' + 5
				},150,function(){
					$(this).animate({
						marginLeft: '-=' + 5
					},150);
				});
			
			//show error message 
			showNotice('error',errors);
			
		}
		//if form is valid
		else {
			loading.show();
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				success: function(){
					showNotice('success');
					form.get(0).reset();
					loading.hide();
				}
			});
		}
		
		return false; //this stops submission off the form and also stops browsers showing default error messages
		
	});

	//other misc functions
	function showNotice(type,data)
	{
		if(type == 'error'){
			successNotice.hide();
			errorNotice.find("li[id!='info']").remove();
			for(x in data){
				errorNotice.append('<li>'+data[x]+'</li>');	
			}
			errorNotice.show();
		}
		else {
			errorNotice.hide();
			successNotice.show();	
		}
	}
	
	String.prototype.ucfirst = function() {
		return this.charAt(0).toUpperCase() + this.slice(1);
	}
		
});



