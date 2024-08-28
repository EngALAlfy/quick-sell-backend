<div class="form-check custom-option custom-option-icon checked">
    <label class="form-check-label custom-option-content" for="{{$id??$name}}">
                                            <span class="custom-option-body">
                                              <i class="bx {{$icon}}"></i>
                                              <span class="custom-option-title">{{$title}}</span>
                                              <small>{{$description}}</small>
                                            </span>
        <label class="switch switch-square switch-success">
            <input type="hidden" name="{{$name}}" value="0">

            <input type="checkbox" value="1" name="{{$name}}" id="{{$id??$name}}" @checked($checked??false) class="switch-input">
            <span class="switch-toggle-slider">
                                                    <span class="switch-on">
                                                      <i class="bx bx-check"></i>
                                                    </span>
                                                    <span class="switch-off">
                                                      <i class="bx bx-x"></i>
                                                    </span>
                                                  </span>
            <span class="switch-label">{{__('ON')}}</span>
        </label>
    </label>
</div>
