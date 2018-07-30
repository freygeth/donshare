$(document).ready(function () {
	$('#btn-u').on('click', function(u){				
		u.preventDefault();		
		var l_email = $.trim($('#u-email').val());
		var l_pass = $('#u-pass').val();
		var exp_ = /\w+@\w+\.+[a-z]/;
		if(l_email.length == 0 || l_pass.length == 0 || !exp_.test(l_email)){
			$('#res-log').html('completa correctamente.');
		}else{			
			$.ajax({
				  type: 'POST',
			      url: 'log.php',
			      dataType: 'json',
			      data:{l_email:l_email, l_pass:l_pass},
			      beforeSend: function (){
      				$('#res-log').html('<img src="img/loading.gif" width="20" alt=""/>');},
      			  success: function(log){ 
				        if(log == 1){
				          	$(location).attr('href', 'home.php');				            			        
				        }else{
					        $('#res-log').html('Error, intenta nuevamente');			            
					           } 
      				}
			});
		}
	});	
	$('#btn-r').on('click', function(r){				
		r.preventDefault(); 	
		var r_email = $('#r-email').val();
		var r_user = $.trim($('#r-username').val());
		var r_pass1 = $('#r-pass1').val();
		var r_pass2 = $('#r-pass2').val();
		var exp = /\w+@\w+\.+[a-z]/;
		var patt   = /[^0-9a-z]/;		
		var space = r_user.indexOf(' ');
		if(r_email.length == 0 || r_user.length == 0 || r_pass1 < 6 || !exp.test(r_email)){
			$('#res-reg').html('completa correctamente.');
		}else{
			if(r_pass1 == r_pass2){
				if(space >= 0){
					$('#res-reg').html('escriba su nombre sin espacios.');
				}else{	
						if(r_user.match(patt)){
							$('#res-reg').html('sólo minúsculas(No ñ/tíldes) y números.');
						}else{
							$.ajax({
							  type: 'POST',
						      url: 'register.php',
						      dataType: 'json',
						      data:{r_email:r_email,  r_user:r_user, r_pass1:r_pass1},
						      beforeSend: function (){
			      				$('#res-reg').html('<img src="img/loading.gif" width="20" alt=""/>');},
			      			  success: function(resp){ 
							        if(resp == 1){
							          	$('#res-reg').html('Usted se registro.');			            			        
							        }else{
								        $('#res-reg').html('Error, vuelva a intentarlo con otro Username o Email');			            
								           } 
			      				}
							});
						}					
				}
			}else{
				$('#res-reg').html('Sus passwords deben ser iguales.')
			}
		}
	});
	$('#btn-c').on('click', function(){						
			$.ajax({
				type: 'GET',
			    url: 'courses.php',
			    dataType: 'text',			    			    
			    beforeSend: function (){
			    	$('#courses').html('<div id="gif1" class="col-12 text-center"><img src="img/loading.gif" width="15" alt=""/><p>Cargando...</p></div>');  	
			        },
			    success: function (rc){
			    	if( rc == 0){
			    		$('#gif1').hide();
			    		$('#courses').html('<div class="col-10"><p>Ya estás en todos los cursos. O surgio un error? intentalo luego.</p></div>');
			    	}else{			    		
			    		var rc = $.parseJSON(rc);
						var rc_len = rc.length;
						$('#gif1').hide();
						for(i = 0; i < rc_len; i++){
							$('#courses').append('<div class="col-10"><h6>'+rc[i].titu+'</h6><h6>Dia y hora:<small>'+rc[i].dia+':'+rc[i].hora+'</small></h6><h6>Participantes: <small>'+rc[i].nper+' persona(s)</small></h6><div id="boxc-'+rc[i].id_e+'"><button type="button" id="c-'+rc[i].id_e+'"class="btn-sm" onclick="getc(this.id)"><b>Unirse</b></button></div><hr></div>');	
						}
			    	 }			   
			    }
			});			
	});	
	$('#btn-mc').on('click', function(){				
			$.ajax({
				type: 'GET',
			    url: 'mycourses.php',
			    dataType: 'text',			    
			    beforeSend: function (){
			    	$('#mycourses').html('<div id="gif2" class="col-12 text-center"><img src="img/loading.gif" id="" width="15" alt=""/><p>Cargando...</p></div>');			    	
			    },
			    success: function (rmc){
			    	if( rmc == 0){
			    		$('#gif2').hide();
			    		$('#mycourses').html('<div class="col-10 text-center">No tienes cursos inscritos</div>');
			    	}else{
						var rmc = $.parseJSON(rmc);
						var rmc_len = rmc.length;
						$('#gif2').hide();
						for(i = 0; i < rmc_len; i++){
							$('#mycourses').append('<div class="col-10"><h6>'+rmc[i].titu+'</h6><h6>Dia y hora:<small>'+rmc[i].dia+':'+rmc[i].hora+'</small></h6> <h6>Participantes: <small>'+rmc[i].nper+' persona(s)</small></h6><a href="open.php?id='+rmc[i].id_e+'">Ver Taller</a><hr></div>');
						}
			    	 }			   
			    }
			});			
	});
	$('#post').on('click',function(){
		var post = $.trim($('#text_user').val());
		var ev_id = $(this).data('evid');
		var name_u = $(this).data('user');
		var dia = new Date()
		var mes = ((dia.getMonth().length+1) === 1)? (dia.getMonth()+1) :(dia.getMonth()+1);
		var hoy = dia.getDate() + "-0" + mes + "-" + dia.getFullYear();
		if(post.length  == 0){
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: 'post.php',
				dataType: 'json',
				data:{post:post, ev_id:ev_id},
				beforeSend: function(){
					$('#load-post').html('<img src="img/loading.gif"  id="i-loadp" width="15" alt="15"/>');
				},
				success: function (poste){
					if(poste == 1){
						$('#w').prepend('<div class="comment-main-level">'+
                                '<div class="comment-box">'+
                                    '<div class="comment-head">'+
                                        '<h5 class="name ml-1 mb-0">&lt;'+name_u+'&gt;</h5>'+
                                        '<h6 class="tiempo float-right mr-1">'+hoy+'</h6>'+
                                    '</div>'+
                                    '<p>'+post+'</p>'+
                                '</div>'+                                        
                            '</div>');
						$('#text_user').val('');
					    $('#i-loadp').hide();	
					}else{
						$('#load-post').html('No hay conexion, vuelva intentarlo en unos minutos.');
					}
				}
			});
		}
	});
	$('#btnc-e button').on('click',function(){
		var postid = $(this).data('postid');
		var nameu = $(this).data('user');
		var com = $.trim($('#c-'+postid).val());
		var dia = new Date()
		var mes = ((dia.getMonth().length+1) === 1)? (dia.getMonth()+1) :(dia.getMonth()+1);
		var hoy = dia.getDate() + "-" + mes + "-" + dia.getFullYear();
		if(com.length  == 0){
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: 'rcom.php',
				dataType: 'json',
				data:{postid:postid, com:com},
				beforeSend: function (){
					 $('#loadec-'+postid).html('<img src="img/loading.gif" id="gif1-'+postid+'" width="15" alt="15"/>');
				},
				success: function (rcom){
					if(rcom == 1){
						$('#r-'+postid).html('<div class="comment-reply">'+
	                                            '<div class="comment-box">'+
	                                                '<div class="comment-head">'+
	                                                    '<h5 class="name ml-1 mb-0">&lt;'+nameu+'&gt;</h5>'+
	                                                    '<h6 class="tiempo float-right mr-1">'+hoy+'</h6>'+
	                                                '</div>'+                                              
	                                                '<p>'+com+'</p>'+                       
	                                            '</div>'+
	                                        '</div>'); 
						$('#c-'+postid).val('');
						$('#gif1-'+postid).hide();
					}else{
						$('#loadec-'+postid).html('Error, vuelva intentarlo en minutos.');
					}

				}
			});
		}
	});
	$('#reply-e button').on('click',function(){
		var idpost = $(this).attr('id');
		$(this).hide();
		$.ajax({
			type: 'GET',
			url: 'com.php',
			dataType: 'text',
			data:{idpost:idpost},
			beforeSend:function (){				
				$('#r_c-'+idpost).html('<img src="img/loading.gif" id="gif2-'+idpost+'" width="15"/>');				
			},
			success: function (rc){
				if(rc == 0){
					$('#r_c-'+idpost).html('No hay comentarios');
				}else{
					var rc = $.parseJSON(rc);
					var rc_len = rc.length;
					for(i = 0; i < rc_len; i++){
						$('#r_c-'+idpost).append('<div class="comment-reply">'+
	                                            '<div class="comment-box">'+
	                                                '<div class="comment-head">'+
	                                                    '<h5 class="name ml-1 mb-0">&lt;'+rc[i].user+'&gt;</h5>'+
	                                                    '<h6 class="tiempo float-right mr-1">'+rc[i].time+'</h6>'+
	                                                '</div>'+                                              
	                                                '<p>'+rc[i].text+'</p>'+                       
	                                            '</div>'+
	                                        '</div>');
					}
					$('#gif2-'+idpost).hide();
				}
			}
		});
	}); 
    $('#btn-nt').on('click', function(){
    	$.ajax({
			type: 'GET',
			url: 'q.php',
			dataType: 'text', 
			beforeSend:function (){				
				$('#ntf').html('<img src="img/loading.gif" id="gif-ntf" width="15"/>');				
			},
			success: function (ntf){
				if(ntf == 0){
					$('#ntf').html('No tienes notificaciones.');
				}else{
					var ntf = $.parseJSON(ntf);
					var ntf_len = ntf.length;
					for(i = 0; i < ntf_len; i++){
						$('#ntf').append('<p>'+ntf[i].user+' respondio a tu publicación el '+ntf[i].time+' <a href="open.php?id='+ntf[i].ide+'">Aquí</a></p>');
					}
					$('#gif-ntf').hide();
				}
			}
		});    	
    });
    $('#btn1-nt').on('click', function(){
    	$.ajax({
			type: 'GET',
			url: 'q1.php',
			dataType: 'text', 
			beforeSend:function (){				
				$('#ntf1').html('<img src="img/loading.gif" id="gif-ntf1" width="15"/>');				
			},
			success: function (ntf1){
				if(ntf1 == 0){
					$('#ntf1').html('No tienes notificaciones.');
				}else{
					var ntf1 = $.parseJSON(ntf1);
					var ntf1_len = ntf1.length;
					for(i = 0; i < ntf1_len; i++){
						$('#ntf1').append('<p>'+ntf1[i].user+' a publicación el '+ntf1[i].time+' en uno de tus cursos <a href="open.php?id='+ntf1[i].ide+'">Aquí</a></p>');
					}
					$('#gif-ntf1').hide();
				}
			}
		});    	
    });     
});
