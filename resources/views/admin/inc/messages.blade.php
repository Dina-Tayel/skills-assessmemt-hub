@if (Session::has('success'))
<div id="success-msg" class="alert alert-success text-center">
    {{ Session::get('success') }}
</div>
@endif