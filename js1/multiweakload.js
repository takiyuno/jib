			var upload_form = new Array();
			var upload_status = new Array();

			function upload_select(x_this,x_container,id){
				var product_code = id;
				var file_array = x_this[0].files;
				var thumbnail_reader = new Array();
				var l_start = x_container.find(".upload_container").length;
				var l = l_start;
				var check_mimetype = true;
				while( l < (file_array.length + l_start) ){

					var i = l - l_start;

					var file_mimetype = file_array[i].type.split("/");

					var file_mime = file_mimetype[0];
					var file_type = file_mimetype[1];

					//if( (file_mime != "image") && (file_mime != "video") ){
					if( (file_mime != "image") ){
						alert("อัพเฉพาะไฟล์ภาพเท่านั้น");
						check_mimetype = false;
						break;
					}

					l = l + 1;

				}

				l = l_start;

				if(check_mimetype){

					while( l < (file_array.length + l_start) ){

						var i = l - l_start;

						//console.log(file_array[i].name);

						var file_mimetype = file_array[i].type.split("/");
						var file_mime = file_mimetype[0];
						var file_type = file_mimetype[1];
						var theme_id = '<?=$theme_id?>';
						var layer_id = '<?=$layer_id?>';
						upload_form[l] = new FormData;
						upload_form[l].id = l;
						upload_form[l].append("do_what", "file_upload");
						upload_form[l].append("file_index", l);
						upload_form[l].append("product_code", product_code);
						upload_form[l].append("file_mime", file_mime);
						upload_form[l].append("file_type", file_type);
						upload_form[l].append(x_this.attr("name"), file_array[i]);
						

						x_container.append("<div class='upload_container'></div>");
						x_container.find(".upload_container:eq("+l+")").append("<img class='thumbnail'/>");
						x_container.find(".upload_container:eq("+l+")").append("<div class='upload_remove' onclick='upload_remove($(\"."+x_container.attr("class")+"\"),"+l+",0,0,$(this));'>x</div>");
						x_container.find(".upload_container:eq("+l+")").append("<div class='progress_backlight'></div>");
						x_container.find(".upload_container:eq("+l+")").append("<div class='progress_container'><div class='progress_bar'><div class='progress'></div></div></div>");

						if(file_mime == "image"){
							thumbnail_reader[i] = new FileReader();
							thumbnail_reader[i].id = l;
							thumbnail_reader[i].onload = function(e){
								$(".thumbnail:eq("+this.id+")").attr("src", e.target.result);
							};
							thumbnail_reader[i].readAsDataURL(file_array[i]);
						}else if(file_mime == "video"){
							//x_container.find(".upload_container:eq("+l+")").find(".thumbnail").attr("src", "img/video_play.png");
						}

						l = l + 1;

					}

				}

			};

			function edit_img_link(x,id){
				var images_id = id;
				var images_link = x.val();
	
				$.ajax({ 	type: "POST",
						url: "wk-query.php", 
						data: { do_what:"edit_img_link", images_id : images_id,images_link:images_link},
					})
					.done(function() {
					});
			}

			function upload_remove(x_container,x_index,type_cmd,id,x){
				
				if(type_cmd == 0){
					x.parent().remove();
					//x_container.find(".upload_container:eq("+x_index+")").remove();
					upload_form.splice(x_index, 1);
				}else if(type_cmd == 1){
					if( confirm("คุณต้องการลบรูปภาพนี้ใช่หรือไม่") ){
						
							$.ajax({ 	type:"POST",
										url:"wk-query.php",
										data: { do_what:"upload_remove", pic_name:id },
										cache: false,
									 })
							  .done(function() {
							  	// alert('55');
							  	x.parent().remove();
							  	upload_form.splice(x_index, 1);
							  });

					}

					
				}
				
				
			}

			function upload_submit(x_container,url,post_id,callback_func,do_what){
				
				var chk = 0;
				if(upload_form.length != 0){
					$.each( upload_form, function( k, v ) {//console.log(k);
						if( v != "" ){
							v.append("post_id", post_id);
							$.ajax({
								type: "POST",
								url: url,
								data: v,
								cache: false,
								processData: false,
								contentType: false,
								xhr: function(){
									var xhr = new window.XMLHttpRequest();
									xhr.upload.addEventListener("progress", function(evt){
										if(evt.lengthComputable){
											var percentComplete = Math.floor(evt.loaded / evt.total * 100);
											//console.log(percentComplete);
											x_container.find(".upload_container:eq("+k+")").find(".progress").css("width",percentComplete+"%");
										}
									}, false);
									return xhr;
								},
								success: function(result){

									//x_container.find(".upload_container:eq("+k+")").find(".progress").css("width","0%");
									x_container.find(".upload_container:eq("+k+")").find(".progress_backlight").fadeOut();
									x_container.find(".upload_container:eq("+k+")").find(".progress_container").hide();
									upload_status.push("complete");
									chk = chk + 1;
									if(chk === upload_form.length){
										$("#submit_project").click();
									}
								}
							});
						
						}
					});
				}else{
					$("#submit_project").click();
				}
			};
