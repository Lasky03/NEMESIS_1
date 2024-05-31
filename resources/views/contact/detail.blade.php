@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="title" class="form-control" 
                value="{{ $contact->name }}" readonly>
            </div>
    <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact" class="form-control" 
                value="{{ $contact->contact }}" readonly>
    </div>
    <div class="form-group">
                <label for="subject">subject</label>
                <input type="text" id="subject" name="subject" class="form-control" 
                value="{{ $contact->subject }}" readonly>
    </div>
    <div class="form-group">
                <label for="message">Message</label>
                <input type="text" id="message" name="message" class="form-control" 
                value="{{ $contact->message }}" readonly>
    </div>

    <a href="{{ URL::to('contact/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection