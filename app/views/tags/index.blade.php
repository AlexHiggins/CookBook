@extends('layout.default')

@section('content')

<div class="container">

	@section('title', 'Tags')

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 tag-container white-box">
      <ul>
      @foreach($tags as $tag)
        <li>
          <a href="{{ route('tag.show', [$tag->slug]) }}">{{ $tag->name }}
            <span class="{{ $tag->id }}-count pull-right">{{ $tag->count }}</span>
          </a>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

@stop