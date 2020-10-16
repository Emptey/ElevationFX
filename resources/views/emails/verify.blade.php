@component('mail::message')
# {{ $details['title'] }}

<div style="margin:2% auto 3%; text-align: center">
    <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo" style=" width: 130px !important; height: 130px;" />
</div>

<p> {{ $details['body'] }}</p>

<style>
    a.link {
        display: block;
        margin-top: 1.5%;
        text-decoration: none;
        background: #181818;
        box-shadow: 4px 4px 10px #000000, -4px -4px 10px #272626;
        color: #ff8800 !important;
        font-weight: bold;
        border-radius: 10px;
        padding: 3%;
        width: fit-content !important;
    }

    a.link:hover {
        text-decoration: none;
    }
</style>


<a class="link" href="{{ $details['url'] }}">Restore account</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
