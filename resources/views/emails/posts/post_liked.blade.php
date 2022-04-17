@component('mail::message')
# Your Post was Liked

## Great news {{ucfirst($post->user->name)}},<br>{{ucfirst($liker->name)}} liked one of your posts.

@component('mail::button', ['url' => route('posts.show', $post)])
View post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent