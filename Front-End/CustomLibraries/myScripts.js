			$(window).scroll(function () {
				var header_position = $("div.header").offset().top;
				var header_height = $("div.header").height();
				
				var curScrollPos = $(this).scrollTop();
				
				if (curScrollPos >= (header_position + header_height)) {
					$('#banglaDrama').text('Bangla Drama');
					
				} else {
				   $('#banglaDrama').text('');
				}
				// scrollPos = curScrollPos;
			});
			
			function openTab(evt, categoryName) {
				var i,x, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				x= document.getElementsByClassName(categoryName);
				
				for (i = 0; i < x.length; i++){
					x[i].style.display = "inline-block";
				}
				
				$(this).addClass('active');
			}

			
			$(document).ready(function(){
				$("div.row div a img").on('click touchstart',function(){
					var ShakeR=$(this).attr('src');
					//alert(ShakeR);
					$(this).parent().parent().parent().css("background-image","url("+ ShakeR +")");
				});
			});
			/*
			$(document).ready(function(){
				$(document).mouseup(function(e){
					var container = $("#mySidenav");
					// if the target of the click isn't the container nor a descendant of the container
					if (container.attr('width', '176px') && e.target.id != container.attr('mySidenav')) {	
						$("#mySidenav").css('width', '0');
					}
					else{
						// alert('after');
					}
				});
			});
			*/
			
			function openNav() {
				document.getElementById("mySidenav").style.width = "176px";
			}

			function closeNav() {
				document.getElementById("mySidenav").style.width = "0";
			}
			
			$(document).ready(function(){
				$("#mySidenav").mouseleave(function(){
					$("#mySidenav").css('width', '0');
				});
			});
			
			function goCategory(event, goCategory){	
				if(goCategory === 'Single' || goCategory === 'Serial'){
					document.location.href = 'more.php?dramaType='+ window.btoa(goCategory);
				}else{
					document.getElementById("Serial").scrollIntoView();							
				}
			}
			
			function showHint(str){
				if (str.length == 0){ 
					document.getElementById("txtHint").innerHTML = '';
					return;
				}else {
					var request = new XMLHttpRequest();
					request.onreadystatechange = function(response){
						if (this.readyState == 4 && this.status == 200){
							document.getElementById('txtHint').innerHTML = '';	
							var newOption = document.createElement('option');
							newOption.value = this.responseText.trim();
							document.getElementById('txtHint').appendChild(newOption);
						}
					};
					request.open('GET', 'gethint.php?q='+str, true);
					request.send();
				}
			}
			
			function showSearchBar(){
				var selector = document.getElementsByClassName('modal');
				
				if (selector[0].style.display == 'block'){
					selector[0].style.display = 'none';
				} else {
					selector[0].style.display = 'block';
				}
			}