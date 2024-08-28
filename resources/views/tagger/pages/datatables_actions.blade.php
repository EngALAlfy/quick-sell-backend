<div class="btn-group align-items-center">
    <button style="border-radius: 4px!important;line-height: 1.5;font-size: 12px;padding: 1px 5px" type="button"
            class="btn btn-primary btn-sm dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
        @lang("Actions")
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu" role="menu"
        style="padding: 5px 0!important;top: 120%!important;margin: 2px 0 0!important;">
        <li>
                <a data-html-title="{{__("View Page")}}" href="{{route("tagger.pages.show" , $id)}}" class="ajax-btn" style="padding: 3px 20px!important;color: #777!important;">
                <i class="fa fa-eye" aria-hidden="true"></i>
                @lang("View")
            </a>
        </li>
        <li>
            <a data-html-title="{{__("Edit Page")}}" href="{{route("tagger.pages.edit" , $id)}}" class="ajax-btn" style="padding: 3px 20px!important;color: #777!important;">
                <i class="fa fa-edit" aria-hidden="true"></i>
                @lang("Edit")
            </a>
        </li>
        <li>
            {{ html()->form('DELETE')->route("tagger.pages.destroy" , $id)->open() }}
            <a role="button" class="delete-button" style="padding: 3px 20px!important;color: #777!important;">
                <i class="fa fa-trash" aria-hidden="true"></i>
                @lang("Delete")
            </a>
            {{html()->form()->close() }}
        </li>
    </ul>
</div>
