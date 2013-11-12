$(document).ready(function() {  
	
	$('.addcomment').submit(function(){
		var uid = $('.uid').val();
		var uname = $('.uname').val();
		if(jQuery.isEmptyObject(uid) || jQuery.isEmptyObject($('.uname').val())) {
			alert('You must be logged in to leave a comment')
			return false;
		}
		else {
			var nid = $('.nid').val();
			var comment = $('.comment').val();
			$.ajax({
				url: 'db/comments.php',
				type: 'POST',
				data: {nid:nid, uid:uid, comment:comment, uname:uname},
				success: function(data){
					//window.location.reload();
					$('.new_comment').prepend('<div class="media" style="background-color: #143778; color: white;">'+
									'<a class="pull-left"><img class="media-object" src="img/defaultpic.jpg" width=50 height=50></a>'+
									'<div class="media-body">'+
										'<h5 class="media-heading">'+uname+'</h5>'+
										'<p>'+comment+'</p>'+
									'</div><!--end media body-->'+
								'</div><!--end media-->'
					);
				}
			});
			return false;
		}
	});

	
	$('#logout').click(function(){
		console.log('logoutclick');
		
		$.ajax({
			url: 'db/logout.php',
			type: 'POST',
			success: function(){
					window.location.reload();			
				}
			});
		return false;
	});
	
	// trigger click on keydown
	$('.keydownsel').keydown(function(event){    
    if(event.keyCode==13){
       $('#modfoot').trigger('click');
    }
	});
	
	$('#modfoot').click(function(){
		$('.help-inline').animate({ opacity: "hide"}, "fast");

		var handle = $('#inputHandle').val();
		var pwd = $('#inputPassword').val();
		console.log(handle);
	
		var url = $('.form-horizontal').attr('id');
		console.log(url);
		$.ajax({
				url: url,
				type: "POST",
				data: {handle:handle, pwd:pwd},
				dataType: 'text',
				success: function(data){
					
					if(data==1) {
						$('.myerror').addClass('error');
						$('#myerrortext').animate({opacity: "show"}, "fast");
						console.log(data);
					}
					else if(data==2){
						$('.myerror').addClass('error');
						$('#myerrortext2').animate({opacity: "show"}, "fast");
					}					
					else {
						//$('#navsignin').replaceWith('<ul class="nav pull-right"><li><a class="brand" href="index.php">Welcome '+data+'</a></li><li><a id="logout" style="cursor:pointer;">Log out</a></li></ul>');			
						//$('.modal').modal('hide');
						location.reload();
					}
				}
			})
			return false;
		});
	
	// trigger click on keydown
	$('#inputName').keydown(function(event){    
    if(event.keyCode==13){
       $('#nominator').trigger('submit');
    }
	});

	$('#nominator').submit(function(){
		$('.help-inline').animate({opacity: "hide"}, "fast");

		var username = $('#inputName').val();
		console.log(username);
		
		$.ajax({
				url: "nominate.php",
				type: "POST",
				data: {username:username},
				success: function(data){
					if(data=='error') {
						$('#nomerror').addClass('error');
						
						$('#nomerrortext').animate({
opacity: "show"}, "fast");
						console.log(data);
					}
					else {
						var url = "index.php?nid="+data;
						window.location = window.location.href.replace = url;
					}
				}
			})
			return false;
		});
	
	$('#login').click(function(){
		if($('.myerror').hasClass('error')){
			$('.myerror').removeClass('error');
		}
		$('#modhead').text('Log In');
		$('#modfoot').text('Log In');
		$('#myerrortext').text('User not found!').hide();
		$('.form-horizontal').attr('id','db/login.php');
		$('.modal').modal();
	});
	
	$('#signup').click(function(){
		if($('.myerror').hasClass('error')){
			$('.myerror').removeClass('error');
		}
		$('#modhead').text('Sign Up');
		$('#modfoot').text('Create Account');
		$('#myerrortext').text('Username already exists!').hide();
		$('.form-horizontal').attr('id', 'db/signup.php');		
		$('.modal').modal();
	});
	
	$('.modalclose').click(function(){
		$(this).closest('.modal').modal('hide');
	});
	

/*	$('.vote').click(function(){
		nid = $(this).attr('id');
		
		$.ajax({
				url: "db/vote.php",
				type: "POST",
				data: {nid:nid},
				success: function(data){
							$('#'+nid+'').prev().text(data);
						}
			})
			return false;
		});
*/
	var w = $('.addcomment').width();
	$('#editor').css('height', w);
	$('.viewer').css('height', w);
	
	var sketchpad = Raphael.sketchpad("editor", {
		width: w,
		height: w,
		editing: true
	});
	
	// make height of hero unit always equal to nominat profile section
	var h = $('#nominator').height();
	$('.span8').css('min-height', h);
	
	// grab all the hidden inputs that contain stroke information
	var allStrokes = $(':input[class=allstrokes]');
	
	// iterate through each input and attach strokes to pictures
	var i=0;
	for(i; i<allStrokes.length; i++){
		var strokesval = $(':input[id=strokes_'+i+']').val();
		var strokes = eval(strokesval);
		
		// since the sketchpad attaches each stroke to an id, attach each stroke to a unique div id
		var viewpad = Raphael.sketchpad("viewer"+i+"", {
			width: w,
			height: w-5,
			strokes: strokes,
			editing: false
		});
	}

	sketchpad.change(function(){
		$(':input[name=data]').val(sketchpad.json());
	});

	// clear the sketchpad
	$("#editor_clear").click(function() {
		sketchpad.clear();		
		return false;
	});


	$('#savelines').click(function(){
		var strokelen = $('input[name=data]').val().length;
		if (strokelen == 2){ 
			alert('Nothing to save!');
			return false;
		} //needed 2 if statements in order to make it work...
		if (jQuery.isEmptyObject($('input[name=data]').val())){
			alert('Nothing to save!');
			return false;
		}
	});
	
	// enable or disable clearing the sketchpad
	function enable(element, enable) {
		if (enable) {
			$(element).removeClass("disabled");
		} else {
			$(element).addClass("disabled");
		}
	};
	
	function select(element1, element2) {
		$(element1).addClass("selected");
		$(element2).removeClass("selected");
	}

});
