@include("includes.multi-lang-input",
[
    "name" => "name" ,
    "title" => __('Permission group name') ,
    "placeholder" => __('Enter permission group') ,
    "required" => true,
    "floating" => false,
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])


<div class="col-12 text-center mt-5">
    <button type="submit" class="btn btn-primary me-sm-3 me-1"><i class="fa fa-save me-2"></i>{{__('Save permission group')}}
    </button>
    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">{{__('Cancel')}}</button>
</div>
