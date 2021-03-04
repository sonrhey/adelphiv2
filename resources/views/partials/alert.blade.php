@if ($errors->any())
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn btn-xs close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @if(count($errors->all()) > 1)
            @foreach ($errors->all() as $error)
                <li><strong>Error!</strong> {{ $error }}</li>
            @endforeach
        @else
            <strong>Error!</strong> {{ $errors->first() }}
        @endif
    </div>
@elseif($message = session('message'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn btn-xs close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $message }}
    </div>
@elseif($error_message = session('error_message'))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn btn-xs close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $error_message }}
    </div>
@endif