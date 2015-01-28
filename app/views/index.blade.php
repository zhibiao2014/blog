@if(!empty($notFound))
<p>不好意思，没有找到！</p>
@else
@foreach($posts as $post)
	<article class="post">
		<header class="post-header">
			<h1 class="post-title">
				{{link_to_route('post.show',$post->title,$post->id)}}
			</h1>
			<div class="clearfix">
				<span class="left date">{{explode(' ',$post->created_at)[0]}}</span>
				<span class="right label">{{$post->comment_count}} 个评论 </span>
			</div>
		</header>
		<div class="post-content">
			<p>{{$post->read_more.' ...'}}</p>
			<span>{{link_to_route('post.show','读取全文',$post->id)}}
		</div>
		<footer class="post-footer">
			<hr>
		</footer>
	</article>
@endforeach
{{$posts->links()}}
@endif
