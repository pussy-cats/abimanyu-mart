@if (session('flash'))
<div class="alert alert-{{ session('flash')['card'] }} alert-dismissible fade show" role="alert">
    {{ session('flash')['message'] }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
