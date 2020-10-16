@extends('v1.master.admin')

@section('title', 'investment management')

@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="user-card">
                <h3 class="bottom-border">Edit Investment</h3>
            
                <!-- add admin -->
                <form action="{{ route('post-edit-investment') }}" method="post">
                    @csrf
                    <div class="form-group x2-margin-top">
                        <label for="name">Name</label>
                        <input type="hidden" name="id" value="{{ !empty($investment->id) ? $investment->id : '' }}" />
                        <input type="text" name="name" id="name" placeholder="ENTER INVESTMENT NAME" autocomplete="off" value="{{ !empty($investment->name) ? ucfirst($investment->name) : '' }}" />
                        <p class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" placeholder="ENTER INVESTMENT COST" autocomplete="off" value="{{ !empty($investment->name) ? $investment->price : '' }}" />
                        <p class="text-danger">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="slot">Slot</label>
                        <input type="number" name="slot" id="slot" placeholder="ENTER SLOT OR LEAVE IT EMPTY" autocomplete="off" value="{{ !empty($investment->slot) ? $investment->slot : '' }}" />
                        <p class="text-danger">
                            @error('slot')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="percentage">Percentage</label>
                        <input type="number" name="percentage" id="percentage" placeholder="ENTER RETURN PERCENTAGE" autocomplete="off" value="{{ !empty($investment->percentage) ? $investment->percentage : '' }}" />
                        <p class="text-danger">
                            @error('percentage')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top">
                        <label for="duration">Duration</label>
                        <input type="number" name="duration" id="percentage" placeholder="ENTER RETURN PERCENTAGE" autocomplete="off" value="{{ !empty($investment->duration) ? $investment->duration : '' }}" />
                        <p class="text-danger">
                            @error('percentage')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="form-group x2-margin-top no-padding">
                        <button type="submit" style="margin: 0"> Save Investment</button>
                    </div>
                </form>
                <!-- end admin -->

            </div>
        </div>
    </div>

@stop