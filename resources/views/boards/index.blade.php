@extends('layouts.app')

@section('content')

    <div id="board">
        <div class="container py-4">
            <drag-drop-board :initial-data="{{$statuses}}"></drag-drop-board>
        </div>
    </div>
@endsection
