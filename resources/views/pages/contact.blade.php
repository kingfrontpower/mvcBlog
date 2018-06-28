@extends('main')

@section('title',' | Contact Page')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Us</h1>
            <hr />
            <form action="" >
                <div class="form-group">
                    <label name="email">Email:</label>
                    <input type="email" name='email' id="email" class='form-control'>
                </div>

                <div class="form-group">
                    <label name="subject">Subject:</label>
                    <input type="subject" name='subject' id="subject" class='form-control'>
                </div>

                <div class="form-group">
                    <label name="message">message:</label>
                    <textarea type="text" name='message' id="message" class='form-control' placeholder='Type your message here...'></textarea>
                </div>

                <input type="submit" value='Send Message' class="btn btn-success">

            </form>
        </div>
    </div>
</div>
@endsection
