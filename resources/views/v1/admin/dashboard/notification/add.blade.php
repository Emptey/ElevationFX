@extends('v1.master.admin')

@section('title', 'notification management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <h3 class="bottom-border">Send Notification</h3>
            
                <!-- add admin -->
                <form action="{{ route('post-create-notification') }}" method="post">
                    @csrf

                    <div class="form-group x2-margin-top">
                        <label for="category">Recipient</label>
                        <select name="recipient" id="recipient">
                            <option value="">-SELECT RECIPEINT CATEGORY-</option>
                            <option value="1">Students</option>
                            <option value="2">Investors</option>
                        </select>
                        <p class="text-danger">
                            @error('recipient')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="name">Title</label>
                        <input type="text" name="title" id="title" placeholder="ENTER NOTIFICATION TITLE" autocomplete="off" value="{{ Request::old('title') }}" />
                        <p class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="message">Message</label>
                        <textarea name="message" id="" cols="30" rows="10" style="height: 350px"></textarea>
                        <p class="text-danger">
                            @error('message')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top no-padding">
                        <button type="submit" style="margin: 0"> Send Notification</button>
                    </div>
                </form>
                <!-- end admin -->

            </div>
        </div>
    </div>

@stop