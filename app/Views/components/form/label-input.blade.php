{{-- label render --}}
<label class="col-form-label">
    @if (isset($label))
      @if (isset($required) && $required)
          {{ $label }} *
      @else
        {{ $label }}
      @endif
    @endif
</label>
<div class="col-sm-8">
    <div class="input-group">

       {{-- icon render --}}
        @if (isset($icon))
          <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-{{ $icon }}"></i>
              </span>
          </div>
        @endif

        @if (isset($type) && $type==='select')
            <select name="{{ $name }}"
               class="form-control {{ session('error.'.$name) ? 'is-invalid' : '' }}"
               value="{{ old($name) }}"
               placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
               required={{ isset($required) ? $required : false }}
              >
              <option>select</option>
              @if (isset($options) && is_array($options))
                @foreach ($options as $key => $option)
                  <option value="{{ $option }}"> {{ $option }} </option>
                @endforeach
              @endif
            </select>
          @elseif (isset($type) && $type==='model-select')
            <select name="{{ $name }}"
               class="form-control {{ session('error.'.$name) ? 'is-invalid' : '' }}"
               value="{{ old($name) }}"
               placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
               required={{ isset($required) ? $required : false }}
              >
              <option value="">select</option>
              @if (isset($items) && is_array($items))
                @foreach ($items as $key =>  $item)
                  <option value="{{ $item['id'] }}">
                    {{ $item[$option] }} {{ isset($option2) ? $item[$option2] : '' }}
                  </option>
                @endforeach
              @endif
            </select>
        @elseif ($type==='file')
          <input type="file" name="{{ $name }}"
           class="form-control {{ session('error.'.$name) ? 'is-invalid' : '' }}"
           placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
           required={{ isset($required) ? $required : false }}
           >
        @elseif (isset($type))
          <input type="{{ $type }}" name="{{ $name }}"
           class="form-control {{ session('error.'.$name) ? 'is-invalid' : '' }}"
           value="{{ old($name) }}"
           placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
           required={{ isset($required) ? $required : false }}
           >
         @else
          <input type="text" name="{{ $name }}"
           class="form-control {{ session('error.'.$name) ? 'is-invalid' : '' }}"
           value="{{ old($name) }}"
           placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
           required={{ isset($required) ? $required : false }}
           >
        @endif

        {{--error render --}}
        @if (session(isset($name) ? 'error.'.$name : ''))
          <div class="invalid-feedback">
            <h6>
              {{ session(isset($name) ? 'error.'.$name : '') }}
            </h6>
          </div>
        @endif
    </div>
</div>
