@extends('layouts/mail')

@section('username')
{{$user->name}}
@endsection

@section('event')
{{$ticket->event->name}}
@endsection

@section('date')
{{DateTime::createFromFormat('Y-m-d', $ticket->event->date)->format('d-m-Y')}}
@endsection

@section('time')
{{DateTime::createFromFormat('H:i:s', $ticket->event->timeStart)->format('H:i') . ' '}}{{$ticket->event->timeEnd != null ? ' - ' . DateTime::createFromFormat('H:i:s', $ticket->event->timeEnd)->format('H:i') : ''}}
@endsection

@section('place')
{{$ticket->event->location}}
@endsection

@section('img')
"{{$message->embed('http://www.acaraid.com/public/storage/upload/' . str_replace(' ', '%20', $ticket->event->image))}}"
@endsection
