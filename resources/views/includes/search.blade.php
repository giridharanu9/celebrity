<div class="row" align="center">
	<div class="col-md-8 col-md-push-2">
		<h4>Search Over Here</h4>
		<form  role="form" method="get" action="{{url('celebrity/search')}}">
			<div id="custom-search-input">
				<div class="input-group col-md-12">
					<input type="text" name="name" id="search" value="{{isset($searchText->name) ? $searchText->name : null}}" class="form-control input-lg" placeholder="Search" />
					<span class="input-group-btn">
						<button class="btn btn-info btn-lg" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
			</div>
			<a href="{{url('advanceSearch')}}" style="float: right;font-size:20px;margin-top:20px;">Advance Filter</a>
			<div class="row advance-search" style="margin-top:30px;display:none;">
				<div class="col-md-2">
					<div class="form-group">
						<select class="form-control search-panel" name="activity">
							<option value="{{NULL}}">Sort By</option>
							<option value="like">Likes</option>
							<option value="dislike">Dislikes</option>
							<option value="follow">Followers</option>
						</select>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<select class="form-control search-panel" name="categoryid">
							<option value="{{NULL}}">Category</option>
							<?php $categories = App\Category::get(); ?>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->categorytitle}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<select class="form-control search-panel" name="gender">
							<option value="{{NULL}}">Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Others">Others</option>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<select class="form-control search-panel" name="age">
							<option value="{{NULL}}">Age</option>
							<option value="20"> >=20 </option>
							<option value="30"> >=30 </option>
							<option value="40"> >=40 </option>
							<option value="50"> >=50 </option>
							<option value="60"> >=60 </option>
							<option value="70"> >=70 </option>
							<option value="80"> >=80 </option>
							<option value="90"> >=90 </option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>
</div><br><br><br>