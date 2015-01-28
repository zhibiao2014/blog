{{ Form::open(['url' => 'search','method'=>'get']) }}
	<div class="row">
		<div class="small-8 large-8 column">
			{{ Form::text('s',Input::old('username'),['placeholder'=>'搜索博客...']) }}
		</div>
			{{ Form::submit('搜索',['class'=>'button tiny radius']) }}
	</div>
{{ Form::close() }}
<div>
	<h3>最近文章</h3>
	<ul>
	@foreach($recentPosts as $post)
		<li>{{link_to_route('post.show',$post->title,$post->id)}}</li>
	@endforeach
	</ul>
</div>

