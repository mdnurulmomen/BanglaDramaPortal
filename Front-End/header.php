
	<div class='row'>
		<div class='menubar text-left'>
			<div class='col-sm-2 col-xs-2'>	
				<i class="fa fa-bars" onclick="openNav()"></i>
			</div>
			<div class='col-sm-4 col-xs-4'>
				<span id='banglaDrama'><strong></strong></span>
			</div>
			<div class='col-sm-6 col-xs-6 text-right' style='padding:2px;'>
				<a href='index.php'><i class="fa fa-home"></i></a>
				<a href='index.php'><i class="fa fa-user-circle-o"></i></a>
				<i class='fa fa-search' onclick='showSearchBar()'></i>
			</div>
		</div>
		
		<div class='header'>
			<div class='col-sm-7 col-xs-7 text-right' style='padding:15px 0 0 0;'>
				<a href="index.php">
					<span><strong>Bangla <span class="coloredBackgroundName">Drama</span></strong></span>
				</a>
			</div>
			<div class='col-sm-5 col-xs-5 text-center'>
				<img src="images/logo18.png" alt="Logo">
			</div>
		</div>

		<div class='modal animate'>
			<form action='searchPage.php' method='GET'>
				<input type='text' list='txtHint' name='searchName' placeholder='Enter Drama Name' onkeyup='showHint(this.value)' autocomplete='off' required />
				<datalist id='txtHint'></datalist>
				<button type='submit' class='btn-primary'>Search</button>
			</form>
		</div>
	</div>
