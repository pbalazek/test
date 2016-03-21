@extends('app')

@section('title')
{{ $user->name }}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Pridružen dne {{$user->created_at->format('d.m.Y \o\b h:i') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Število objav</td>
					<td> {{$posts_count}}</td>
					@if($author && $posts_count)
					<td><a href="{{ url('/my-all-posts')}}">Prikaz vseh</a></td>
					@endif
				</tr>
				<tr>
					<td>Published Posts</td>
					<td>{{$posts_active_count}}</td>
					@if($posts_active_count)
					<td><a href="{{ url('/user/'.$user->id.'/posts')}}">Show All</a></td>
					@endif
				</tr>
				<tr>
					<td>Posts in Draft </td>
					<td>{{$posts_draft_count}}</td>
					@if($author && $posts_draft_count)
					<td><a href="{{ url('my-drafts')}}">Show All</a></td>
					@endif
				</tr>
			</table>
		</li>
		<li class="list-group-item">
			Skupno število komentarjev: {{$comments_count}}
		</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>Latest Posts</h3></div>
	<div class="panel-body">
		@if(!empty($latest_posts[0]))
		@foreach($latest_posts as $latest_post)
			<p>
				<strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
				<span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
			</p>
		@endforeach
		@else
		<p>You have not written any post till now.</p>
		@endif
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>Zadnji komentarji</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
		@foreach($latest_comments as $latest_comment)
			<div class="list-group-item">
				<p>Komentar: {{ $latest_comment->body }}</p>
				<p>ID: {{ $latest_comment->id }}</p>
				<p>Dne {{ $latest_comment->created_at->format('d.m.Y \o\b h:i') }}</p>
				<p>Objava: <a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
			</div>
		@endforeach
		@else
		<div class="list-group-item">
			<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
		</div>
		@endif
	</div>
</div>
@endsection
