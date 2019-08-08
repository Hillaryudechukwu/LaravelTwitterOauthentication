@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
   <div class="card">
      <div class="card-header">
         <h1 class="text-center">Twitter Feed</h1>
      </div>
      <div class="card-body">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
         <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{url('/search')}}">Trends for you</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor02">
               <ul class="navbar-nav mr-auto">
               </ul>
               <form  action="{{('/home')}}" method="GET" class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="text"  name="search" required>
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
               </form>
            </div>
         </nav>
         <section id="main">
            <div class="container">
               <div class="row">
                  <div class="col">
                     <table class="table table-striped">
                        <thead class="thead-inverse">
                           <th>Posted on</th>
                           <th>Username</th>
                           <th>Tweent</th>
                        </thead>
                        @if (!empty($tweets->statuses))
                        @foreach ($tweets->statuses as $tweet)  
                        <tr>
                           <td> {{ date('Y-m-d H:i', strtotime($tweet->created_at)) }}</td>
                           <td><img src="{{ $tweet->user->profile_image_url }}"/><a target="_blank" href="https://twitter.com/">{{$tweet->user->name}}</a></td>
                           <td> {{ $tweet->text }}</td>
                        </tr>
                        @endforeach
                     </table>
                  </div>
               </div>
         </section>
         @else
         <section id="main">
         <div class="container">
         <div class="row">
         <div class="col">
         <table class="table table-striped">
         <thead class="thead-inverse">
         <th>Posted on </th>
         <th>Tweent</th>
         <th>Retweented</th>
         <th>Favorite</th>
         </thead>
         @foreach ($statuses as $key)
         <tr>
         <td>{{ $key->created_at }}</td>
         <td>{{$key->text }}</td>
         <td>{{$key->retweet_count }}</td>
         <td>{{$key->favorite_count }}</td>
         </tr>
         @endforeach
         @endif
         </table>
         </div>
         </div>
         </section>
         </div>
         </div>
      </div>
   </div>
</div>
@endsection