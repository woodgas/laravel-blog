@props(['thumbnail'])
<img src="{{
    asset($thumbnail ? 'storage/'.$thumbnail : 'images/avatar.png')
    }}" alt="User avatar"
{{ $attributes }}
>
