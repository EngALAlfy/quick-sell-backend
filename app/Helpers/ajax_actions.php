<?php

if (!function_exists('ajax_actions_init')) {
    /**
     * Generate the javascript listener for button click of action
     * Button must have class `ajax-btn`
     * @return string
     */
    function ajax_actions_init(): string
    {
        return <<<HTML
        <!-- ajax html actions -->
        <script>
            $(document).on("click" , ".ajax-btn" , function(e){
                e.preventDefault();
                let url =  $(this).data('href') ?? $(this).attr('href');
                let type =  $(this).data('html-type') ?? "modal";
                let title =  $(this).data('html-title');
                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(result) {
                        if(type === "modal") {
                            $('#html-modal-title').html(title);
                            $('#html-modal-body').html(result);
                            $('#html-modal').modal("show");
                        }else if(type === "offcanvas") {
                            $('#html-offcanvas-title').html(title);
                            $('#html-offcanvas-body').html(result);
                            let htmlOffcanvas = new bootstrap.Offcanvas($('#html-offcanvas'))
                            htmlOffcanvas.show();
                        }
                    },
                });
            });
            // modal event
            $(document).on('shown.bs.modal' , "#html-modal", function () {
                $('button[type="reset"]').attr('data-bs-dismiss', 'modal');
                if(typeof onAjaxActionModalShow != "undefined"){
                    onAjaxActionModalShow();
                }
            })
            // offcanvas event
            $(document).on('shown.bs.offcanvas' , "#html-offcanvas", function () {
                $('button[type="reset"]').attr('data-bs-dismiss', 'offcanvas');
                if(typeof onAjaxActionOffcanvasShow != "undefined"){
                    onAjaxActionOffcanvasShow();
                }
            })
        </script>
        HTML;
    }
}


if (!function_exists('ajax_actions_modal')) {
    /**
     * Generate the html modal for view form or action of ajax
     * Modal body must have id `html-modal-body`
     * Modal title must have id `html-modal-title`
     * @return string
     */
    function ajax_actions_modal(): string
    {
        return <<<HTML
        <!-- modal -->
        <div id="html-modal" class="modal modal-lg fade" role="dialog"
             aria-labelledby="html-modal-title" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="html-modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="html-modal-body"></div>
                </div>
            </div>
        </div>
        HTML;
    }
}

if (!function_exists('ajax_actions_offcanvas')) {
    /**
     * Generate the html offcanvas for view form or action of ajax
     * Offcanvas body must have id `html-offcanvas-body`
     * Offcanvas title must have id `html-offcanvas-title`
     * @return string
     */
    function ajax_actions_offcanvas(): string
    {
        return <<<HTML
        <!-- offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="html-offcanvas" aria-labelledby="html-offcanvas-title">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="html-offcanvas-title"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" id="html-offcanvas-body"></div>
        </div>
        HTML;
    }
}


if (!function_exists('ajax_button')) {
    /**
     * Generate the html ajax button for
     *
     * @param $child
     * @param string $classes
     * @param string $route
     * @param string $title
     * @param string $type
     * @param string $attr
     * @return string
     */
    function ajax_button($child , string $classes , string $route , string $title , string $attr = '' , string $type = "modal" ): string
    {
        return <<<HTML
        <!-- ajax btn -->
        <button data-href="$route" $attr data-html-type="$type" class="$classes ajax-btn" data-html-title="$title">
            $child
        </button>
        HTML;
    }
}
