@extends('layouts.app')

@section('nav_items')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            キャラクター<span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <router-link :to="'/character?page=1'" tag="li" v-cloak>
                <a>キャラクター一覧</a>
            </router-link>
            <router-link :to="'/character/user'" tag="li" v-cloak>
                <a>所有キャラクター</a>
            </router-link>
            <router-link :to="'/character/create'" tag="li" v-cloak>
                <a>新規作成</a>
            </router-link>
        </ul>
    </li>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <router-view></router-view>
@endsection
