@foreach($modules as $module)
    @if($module->parent == 0 && $module->has_sub == 0)
    <div class="custom-control custom-checkbox">
    @foreach($useraccess as $ua)
        @if($ua->module_id == $module->id && $ua->grant == 1)
        {{ $ua->id }}
            <input type="checkbox" class="custom-control-input" name="isParent" id="isParent{{$module->id}}" value="{{ $module->id }}" checked>
            <label class="custom-control-label" for="isParent{{$module->id}}">{{ $module->name }}</label>
        @elseif($ua->module_id == $module->id && $ua->grant == 0)
            <input type="checkbox" class="custom-control-input" name="isParent" id="isParent{{$module->id}}" value="{{ $module->id }}">
            <label class="custom-control-label" for="isParent{{$module->id}}">{{ $module->name }}</label>
        @endif
    @endforeach
    </div>

@elseif($module->has_sub > 0 && $module->parent == 0)

    <div class="custom-control custom-checkbox">
    @foreach($useraccess as $ua)
        @if($ua->module_id == $module->id && $ua->grant == 1)
            <input type="checkbox" class="custom-control-input" name="hasSub" id="hasSub{{$module->id}}" value="{{$module->id}}" checked>
            <label class="custom-control-label" for="hasSub{{$module->id}}">{{ $module->name }}</label>

            <ul id="collapse">
            @foreach($modules as $sub_module)
                @if($sub_module->parent == $module->id)
                <li>
                    <div class="custom-control custom-checkbox">
                    @foreach($useraccess as $uaa)
                    @if($uaa->module_id == $sub_module->id && $uaa->grant == 1)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}" checked>
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @elseif($uaa->module_id == $sub_module->id && $uaa->grant == 0)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}">
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @endif
                    @endforeach
                    </div>
                <li>

                @endif
            @endforeach
        </ul>
        @elseif($ua->module_id == $module->id && $ua->grant == 0)
         <input type="checkbox" class="custom-control-input" name="hasSub" id="hasSub{{$module->id}}" value="{{$module->id}}">
            <label class="custom-control-label" for="hasSub{{$module->id}}">{{ $module->name }}</label>

            <ul id="collapse">
            @foreach($modules as $sub_module)
                @if($sub_module->parent == $module->id)
                <li>
                    <div class="custom-control custom-checkbox">
                    @foreach($useraccess as $uaa)
                    @if($uaa->module_id == $sub_module->id && $uaa->grant == 1)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}" checked>
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @elseif($uaa->module_id == $sub_module->id && $uaa->grant == 0)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}">
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @endif
                    @endforeach
                    </div>
                <li>

                @endif
            @endforeach
        </ul>
        @endif
    @endforeach

    </div>
@endif
@endforeach
