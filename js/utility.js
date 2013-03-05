// JavaScript Document
$(function(){
	// global variable
	var domainName = $('meta[name*="url"]').attr('content');
	var timeoutFadelogin;
	
	
	/* add category -- form */
	$('#addcategorybtn').click(function() {
		var cntr = 0;
		
		$('.categorybox > div').each(function() {
			cntr++;
		});
						
		$.post(domainName + 'ajax/ajaxproper/addcategory', {id:cntr})
		.success(function(data) {

			$('.categorybox').append(data);
			$('select' + '#' + cntr).unbind('change').bind('change', cboaddcategory);
			$('#closebtn' + cntr).unbind('click').bind('click', closebtn);
			$('.hastooltip').bind('mousemove', evntmousemoveTooltip).bind('mouseout', evntmouseout);
		});
		
		return false;
	});
	
	$('div > span[cbo]').unbind('click').bind('click', closebtn);
	$('div > select[name*=category]').unbind('change').bind('change', cboaddcategory);
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* start of event listener *
	//+++++++++++++++++++++++++++++++++++++
	function cboaddcategory() {
		var id = $(this).attr('value');
		var curElem = $(this);
		
		$.post(domainName + 'ajax/ajaxproper/addsubcategory', {cat_id: id})
		.success(function(data) {
			curElem.parent().children('div').empty().append(data);
		});
	}
	
	function closebtn() {
		var cbo =  $(this).attr('cbo');
		
		// unbinds event listeners
		$('#' + cbo).unbind('change');
		$(this).unbind('click', closebtn);
		
		// removes elements from the DOM
		$(this).parent().remove();
		
	}	
	// *** end of event listener ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* sign-up form *
	//+++++++++++++++++++++++++++++++++++++
	
		$('#ismember').click(function() {
			loadLogin();
		});
		
		$('#isnotmember').click(function() {
			loadRegister();
		});
		
		function loadRegister() {
			$.post(domainName + 'ajax/ajxsignup/load_register')
			.success(function(data) {
				$('#signup_form').empty().append(data);
			});
		}
		
		function loadLogin() {
			$.post(domainName + 'ajax/ajxsignup/load_login')
			.success(function(data) {
				$('#signup_form').empty().append(data);
			});
		}
	// *** end of sign-up form ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* sign-in/log-in form/link *
	//+++++++++++++++++++++++++++++++++++++		
		function fadeLogin() {
			$('.popuplogin').fadeOut('slow');
		}
		
		var evntMouseOverSignin = function(e) {
			$('.popuplogin').fadeIn('slow');
		}
		
		var evntMouseOutSignin = function() {
			timeoutFadelogin = setTimeout(fadeLogin, 1250);
		}
		
		var evntElemFocus = function() {
			clearTimeout(timeoutFadelogin);
			
		}
		
		var popupLoginValidation = function() {
			var curElem = $(this);
			
			var username = $('input[name="uname"]', curElem).attr('value');
			var password = $('input[name="pword"]', curElem).attr('value');
			
			if(username != '' && password != '') {
				$.post(domainName + 'ajax/ajxsignup/validate_my_login', {uname: username, pword: password})
				.success(function(data) {
					if(data == 'true')
						window.location = domainName + 'advertiser/my';//alert('User found!');
					else if (data == 'false') {
						alert('User not found!');	
					}
				});
			} else {
				alert('Username and Password are required fields.');
			}
			
			/*			
			
			*/
			return false;
		}
		
		$('#signinlnk').bind('mouseenter', evntMouseOverSignin)
		.bind('mouseleave', evntMouseOutSignin);
		
		$('.popuplogin').bind('mouseenter', evntElemFocus)
		.bind('mouseleave', fadeLogin);
		
		$('.popuplogin form').bind('submit', popupLoginValidation);
		
	
	// *** end of sign-in/log-in form ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* package type form *
	//+++++++++++++++++++++++++++++++++++++
	
		$('#lststandard').click(function() {
			$.post(domainName + 'ajax/ajxpackagetype/packageType', {type: 'standard'})
			.success(function(data) {
				$('#packagetypebox').empty().append(data);
			});
		});
		
		$('#lstpremium').click(function() {
			$.post(domainName + 'ajax/ajxpackagetype/packageType', {type: 'premium'})
			.success(function(data) {
				$('#packagetypebox').empty().append(data);
			});
		});
		
		$('#perannum').click(function() {
			$('#lststandard').removeAttr('checked');
			$('#lstpremium').attr('checked', 'checked');
			
		});
		
		$('#permonth').click(function() {		
			$('#lststandard').removeAttr('checked');
			$('#lstpremium').attr('checked', 'checked');
			
		});
	
	// *** end of package type form ***
		
	// +++++++++++++++++++++++++++++++++++++
	// 		*  analytics per click  *
	//+++++++++++++++++++++++++++++++++++++
		
		$(".viewphone").click(function() {
			var lst_id =  $(this).attr('lst_id');
			curElem = $(this);

			$.post(domainName + "ajax/analytics/perclick", { link: 'phone', id: lst_id })
			.success(function(data) {
				
				if(data.toString().match(/true/gi))
					curElem.html(curElem.attr('anlytcvalue'));
			});
			
			return false;
		});
		
		$(".sendemail").click(function(){ 
			var lst_id =  $(this).attr('lst_id');
			
			//$.post(domainName + "ajax/analytics/perclick", { link: 'email', id: lst_id })
//			.success(function(data) {
				$('.submenuselector').removeClass('photos map enquiry').addClass('enquiry');
				$('.menutabs ul a').each(function(){
					$(this).removeClass('selected');
				});
				$('.menutabs ul li a[ctrltag=1]').addClass('selected');
				$('.overviewbox, .photosbox, .mapbox').addClass('hidden');
				$('form input[type=submit]').unbind('click', formvalidation);
				$('form input[type=submit]').bind('click', formvalidation);
				$('.enquirybox').removeClass('hidden');
			//});
			
			return false;
		});
		
		$(".viewsite").click(function() {
			var lst_id =  $(this).attr('lst_id');
			curElem = $(this);

			$.post(domainName + "ajax/analytics/perclick", { link: 'url', id: lst_id });
			
			return true;
		});
		
		/* page view */
		$('.businessdtl a, .businesslogo a').click(function(){
			var lst_id =  $(this).attr('lst_id');
			curElem = $(this);
			
			$.post(domainName + "ajax/analytics/perclick", { link: 'pageview', id: lst_id });			
		});
	// *** end of analytics ***
	
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* favorites *
	//+++++++++++++++++++++++++++++++++++++	
		/* defines event handler for favorites items on the serpsbox */		
		var addFav = function () {
			$curElem = $(this);			

			$.post(domainName + 'ajax/favorites/add', {id: $curElem.attr('lst_id')})
			.success(function(data) {
				$curElem.addClass('favcached removefavoritesbtn').html('<i class="splashy-star_full"></i> remove-favorites').removeClass('favoritesbtn')
				.unbind('click')
				.bind('click', removeFav);
				
				// adds fav item on sb
				//addfavitemsb($curElem.attr('lst_id'), $curElem.attr('adtitle'));

				$('.favorites ul').empty().append(data);
				
				$('.favorites .removefavsb').each(function(i){		
					$(this).bind('click', removeFavSB);
				});
			});
			
			return false;
		}
		
		/* defines event handler for favorites items on the serpsbox */
		function removeFav() {
			$curElem = $(this);

			$.post(domainName + 'ajax/favorites/remove', {id: $curElem.attr('lst_id')})
			.success(function(data) {
				$curElem.removeClass('favcached removefavoritesbtn').html('<i class="splashy-star_empty"></i> add to favorites')
				.unbind('click')
				.bind('click', addFav);
				
				// adds fav item on sb
				//addfavitemsb($curElem.attr('lst_id'), $curElem.attr('adtitle'));
				$('.favorites ul').empty().append(data);
				
				$('.favorites .removefavsb').each(function(i){
					$(this).bind('click', removeFavSB);
				});
				
			});

			return false;
					
		}
		
		/* defines event handler for favorites items on the sidebar */
		removeFavSB = function() {
			$curElem = $(this);
			
			$.post(domainName + 'ajax/favorites/remove', {id: $curElem.attr('lst_id')})
			.success(function(data) {
				$curElem.parent().remove();
				
				var cntr = 0;
				// checks the count of fav item
				$('.favorites ul li').each(function() {
					cntr++;
				});
				
				if(cntr==0)
					$('.favorites ul').append('<li><p><strong>No items found in your favorite list.</strong></p></li>');
			});
			
			// removes fav it from the serpsbox
			$('.search_panel .favcached').each(function(i){
				faviconserpsbox = $(this);
				
				if(faviconserpsbox.attr('lst_id') == $curElem.attr('lst_id'))
					faviconserpsbox.removeClass('favcached removefavoritesbtn').addClass('favoritesbtn').html('<span class="sprite"></span>add to favorites').unbind('click').bind('click', addFav); // changes the icon apperance
			});
			// end -- removes fav it from the serpsbox
		
			return false;
		}
		
		/* binds/unbinds into event handlers */
		$(".favoritesbtn").bind('click', addFav);
		$(".removefavoritesbtn").bind('click', removeFav);
		$(".removefavsb").bind('click', removeFavSB);
		
	// *** end of favorites ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* sidebar control box *
	//+++++++++++++++++++++++++++++++++++++	
		toggleCB = function() {
			curElem = $(this);
			
			if(curElem.hasClass('controlboxcollapsed')) { // collapsed
				curElem.removeClass('controlboxcollapsed');
				$('ul',curElem.parent()).slideDown('slow').css({display: 'block'});
				$.post(domainName + 'ajax/ajxsidebar/sbWrite', {control: curElem.attr('ctrltag')})/*
				.success(function(data){
					alert('returned data: ' + data);
				})*/;
			} else { // expanded
				curElem.addClass('controlboxcollapsed');
				$('ul',curElem.parent()).slideUp('slow');
				$.post(domainName + 'ajax/ajxsidebar/sbWrite', {control: curElem.attr('ctrltag')})
				/*.success(function(data){
					alert('returned data: ' + data);
				})*/;
			}
		}

		$('.controlbox').bind('click', toggleCB);
		
		// sidebar admin
		$('.sidebarmainmenu > ul > li > a').click(function() {
			var curElem = $(this);
			
			$('.sidebarmainmenu > ul > li').each(function() {
				$(this).removeClass('selected');
			});
			
			curElem.parent().addClass('selected');
			
			return false;
		});
		
	// *** end of sidebar control box ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* login  *
	//++++++++++++++++++++++++++++++++++++++	
		 // advertiser
		 $('input[name*=uname]').focus();
	
	// *** end of login ***
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* search  *
	//++++++++++++++++++++++++++++++++++++++	
		$('input[name*="searchquery"]').click(function(){
			$(this).attr('value', '');
			
		})
		.blur(function(){			
			var dfText =  'business title, description, location';
			var strValue = $(this).attr('value'); 
			
			if(strValue == dfText || strValue == '')
				$(this).attr('value', dfText);
				
			
		});
	// *** end of search ***
	
	// +++++++++++++++++++++++++++++++++++++
	//   * listing details sub menu tabs  *
	//++++++++++++++++++++++++++++++++++++++
	
		// event handlers
		
	
		$('.menutabs a').click(function() {
			curElem = $(this);
			//alert('Menutabs: ' + $(this).text());
		
/*			$('.wordpane').empty();*/
			$.post(domainName + 'ajax/ajxlistingdetails/toggleMenuTab', {tab : curElem.attr('ctrltag'), id : curElem.attr('lst_id')})
			.success(function(data) {
				//$('.wordpane').append(data);
								
				// updates the selected tab
				$('.menutabs ul a').each(function(){
					$(this).removeClass('selected');
				});
				curElem.addClass('selected');
				
				// menuselector
				mnuSelector = $('.submenuselector');
				n = curElem.attr('ctrltag');
				
				selector = $('.submenuselector');
				switch(n) {
					case '8':
						selector.removeClass('photos map enquiry');
						$('.photosbox, .enquirybox').addClass('hidden');
						$('.mapbox').css({visibility: 'hidden'});
						$('.overviewbox').removeClass('hidden');
						break;
					case '4':
						selector.removeClass('photos map enquiry').addClass('photos');
						$('.overviewbox, .mapbox, .enquirybox').addClass('hidden');
						$('.photosbox').removeClass('hidden');
						break;
					case '2':
						selector.removeClass('photos map enquiry').addClass('map');
						$('.overviewbox, .photosbox, .enquirybox').addClass('hidden');
						$('.mapbox').removeClass('hidden').css({visibility: 'visible'});
						
						break;
					case '1':
						selector.removeClass('photos map enquiry').addClass('enquiry');
						$('.overviewbox, .photosbox, .mapbox').addClass('hidden');
						$('form input[type=submit]').unbind('click', formvalidation);
						$('form input[type=submit]').bind('click', formvalidation);
						$('.enquirybox').removeClass('hidden');
						
						break;
				}
			});
			
			return false;
		});
		
		$('.mapbutton a').click(function(){ //, .sendemail
			$('.menutabs ul a').each(function(){
				$(this).removeClass('selected');
			});
			$('.menutabs ul li a[ctrltag=2]').addClass('selected');
			$('.submenuselector').removeClass('photos map enquiry').addClass('map');			
			$('.overviewbox, .photosbox, .enquirybox').addClass('hidden');
			$('.mapbox').removeClass('hidden').css({visibility: 'visible'});
			
			return false;
		});
		
		$('.thumbnails > div > img').click(function() {
			curElem =  $(this);
			
			$('.imageviewer img').attr({src: domainName + 'ads/' + curElem.attr('advrpath') + '/' + curElem.attr('imgfile')});
			/*alert(curElem.attr('imgfile'));*/
			
			return false;
		});
	// *** end of sub menu tabs ***
	
	
	// +++++++++++++++++++++++++++++++++++++
	//   * advertiser profile page  *
	//++++++++++++++++++++++++++++++++++++++
	function evntDeletePost() {
		var curElem = $(this);
		var lstid = curElem.attr('lst_id');
		
		var answer = confirm('Are you sure you want to delete this post?');
		
		if(answer) {
			$.post(domainName + 'advertiser/my/delete_listing', {id : lstid})
			.success(function(data) {
				if(data != 'false') {
					$('.datatable table tbody').empty().append(data);
					//alert(data);
					
					$('.deletebtn').each(function() {
						$(this).bind('click', evntDeletePost);
						$('.hastooltip').bind('mousemove', evntmousemoveTooltip).bind('mouseout', evntmouseout);
					});
				}
			});
		}
		return false;
	}
	
	$('.deletebtn').bind('click', evntDeletePost);	
	// *** end of advertiser profile page ***	
	
	// +++++++++++++++++++++++++++++++++++++
	// 		* admin control panel  *
	//++++++++++++++++++++++++++++++++++++++	
	
		$('.advertiserbtn').click(function(){
			var curElem = $(this);
			var mStatus = $(this).attr('tooglestatus');
			var mAdvr = $(this).attr('advr_id');
			
			var answer = confirm('Are you sure you want to ' + ((mStatus == 1) ? 'ACTIVATE' : 'DEACTIVATE') + ' this account?');
			
			if(answer) {
				$.post(domainName + 'ajax/ajxadmin/toogleAdvertiserStatus', {status: mStatus, advr: mAdvr})			
				.success(function(data) {
					if(data == 'succeed') {
						//alert('Advertiser has been toggled');
						curElem.attr('tooglestatus', ((mStatus == 1) ? 0 : 1)).text((mStatus == 1) ? 'Deactivate' : 'Activate');
					}else {
						alert('Advertiser has not been toggled');
					}
				});
			}
			
			//console.log('status: ' + $(this).attr('tooglestatus') + ', ' + 'advr: ' + $(this).attr('advr_id'));
			return false;
		});
	
	// *** end admin control panel ***
	
	/*  tooltip  */
	var evntmousemoveTooltip = function(e) {
		$tooltip = $(this).attr('tooltip');
			
		$('.tooltipbox').empty().append($tooltip).removeClass('hide').css({'top': e.pageY + 10, 'left' : e.pageX + 10});
		
	}
	
	var evntmouseout = function(e) {
		$('.tooltipbox').addClass('hide');
	}
	
	$('.hastooltip').bind('mousemove', evntmousemoveTooltip).bind('mouseout', evntmouseout);
	
	
	// form validation
	formvalidation = function (){
			//alert('Submitting this form.');
			
			$('form .required').each(function(i,e) {
				fld = $(this);
				
				if(fld.attr('value').toString() == '') {
					fld.addClass('errorinputreq').focus();
					$('label', fld.parent()).addClass('errorreq');
					return false;											
				} else if(fld.hasClass('email')) {
					if(!isEmail(fld)) {
						fld.addClass('errorinputreq').focus();
						$('label', fld.parent()).addClass('errorreq');
						alert('Please enter a valid email address.');
						return false;				
					} else {
						fld.removeClass('errorinputreq');
						$('label', fld.parent()).removeClass('errorreq');
					}
				} else {
					fld.removeClass('errorinputreq');
					$('label', fld.parent()).removeClass('errorreq');
				}
			});														
			
			return false;
	}
	
	/*********************************
	/***  some utility functions   ***
	/*********************************
	
	/* Record select in the table */
	$('.cboxToggleSelectAll').click(function() {
		if($(this).prop('checked') == false)
			$('.cboxSelector').prop('checked', false);
		else
			$('.cboxSelector').prop('checked', true);
	});
	
	$('.cboxSelector').click(function() {
		$('.cboxSelector').each(function() {
			if($(this).prop('checked') == false) {
				$('.cboxToggleSelectAll').prop('checked', false);
				return;
			}
		});
	});	
	/*  end here */
	
	/* water mark text */
	if($('.watermarktext').val() == '' )
		$('.watermarktext').val('Enter Title Here').css({'color': '#ccc'}); // default text
		
	$('input.watermarktext').bind('click, focus',function() {
		var curElem = $(this);
		
		if(curElem.attr('value').toString().toLowerCase().indexOf('enter title here') == 0)
			curElem.attr('value', '').css({'color': '#000'});
		
	}).bind('blur', function() {
		var curElem = $(this);
		
		if(curElem.attr('value') == '')
			$(this).attr('value', 'Enter Title Here').css({'color': '#ccc'});
			
	});
	
	function isEmail(obj) {
		var pattern = /[a-zA-Z_\.]*@+[a-zA-Z0-9]*\.+(\w){2,4}/;
		
		if(!pattern.test(obj.attr('value')))
			return false;
	
		return true;
	}	
	
});