{{-- DropZone STYLE --}}
<style>
    .dropzone:not(.dz-clickable) {
        opacity: .5 !important;
        cursor: not-allowed !important;
    }

    .dropzone.dz-drag-hover {
        border-style: solid !important;
    }

    .dropzone.dz-drag-hover .dz-message {
        opacity: .5 !important;
    }

    .dz-browser-not-supported.dropzone-box {
        min-height: auto !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        width: auto !important;
        cursor: default !important;
        transition: none !important;
    }

    .dz-thumbnail img[src] ~ .dz-nopreview {
        display: none !important;
    }


    .dz-browser-not-supported .dz-message {
        display: none !important
    }

    .dz-started .dz-message {
        display: none
    }

    .dz-complete .progress {
        display: none;
    }

    .dz-preview .progress {
        position: absolute;
        left: 1.25rem;
        right: 1.25rem;
        top: 50%;
        margin-top: -0.25rem;
        z-index: 30;
    }

    .dz-preview .progress, .dz-preview .progess-bar {
        height: 0.5rem;
    }

    .dz-filename:hover {
        white-space: normal !important;
        text-overflow: inherit !important;
    }


    .dz-remove {
        color: #697a8d !important;
        border-top: 1px solid #d9dee3 !important;
        border-bottom-right-radius: calc(0.375rem - 1px) !important;
        border-bottom-left-radius: calc(0.375rem - 1px) !important;
        display: block !important;
        text-align: center !important;
        padding: 0.375rem 0 !important;
        font-size: .75rem !important;
        cursor: pointer !important;
    }

    .dz-remove:hover, .dz-remove:focus {
        color: #697a8d !important;
        background: rgba(67, 89, 113, .1) !important;
        text-decoration: none !important;
        border-top-color: rgba(0, 0, 0, 0) !important;
    }
</style>
{{-- END STYLE --}}


{{-- DropZone Layout --}}
<div class="dropzone d-flex flex-wrap justify-content-center {{ $class ?? '' }}" id="{{ $id ?? 'myDropzone' }}" data-field="dz" style="border: 2px dashed #d9dee3;">
    <input type="hidden" id="uploaded_file_name" name="{{ $name ?? 'image' }}_name" value="{{ is_array($file_name) ? implode(',', $file_name) : ($file_name ?? "") }}">
    <input type="hidden" id="uploaded_file_public_path" name="{{ $name ?? 'image' }}_public_path" value="{{ is_array($public_path) ? implode(',', $public_path) : ($public_path ?? "") }}">
    <input type="hidden" id="uploaded_file_storage_path" name="{{ $name ?? 'image' }}_storage_path" value="{{ is_array($storage_path) ? implode(',', $storage_path) : ($storage_path ?? "") }}">

    <div class="dz-message needsclick"
         style="color: #566a7f; margin: 4.5rem 0; font-weight: 500; text-align: center; font-size: 1.625rem; width:100%; text-align:center;">
        Upload your {{$title ?? "photo"}}
        <span class="note needsclick mt-0"
              style="color: #697a8d; font-weight: 400; display: block; margin-top: 0.625rem; font-size: .9375rem;">(The uploaded file must be <span
                class="fw-medium">image</span> with max 300 KB)</span>
    </div>
    <div hidden id="preview-template-continer">
        <div class="dz-preview" id="dz-preview-template">
            <div class="dz-details dz-preview dz-processing me-4" style="
            width: fit-content;
            border: 0 solid #d9dee3;
            border-radius: 0.375rem;
            box-shadow: 0 2px 6px 0 rgba(67,89,113,.12);
            position: relative;
            vertical-align: top;
            background: #fff;
            font-size: .8125rem;
            box-sizing: content-box;
            cursor: default;
            ">

                <div class="dz-thumbnail" style="
                border-bottom: 1px solid #d9dee3;
                background: rgba(67,89,113,.025);
                border-top-left-radius: calc(0.375rem - 1px);
                border-top-right-radius: calc(0.375rem - 1px);
                width: 10rem;
                position: relative;
                padding: 0.625rem;
                height: 7.5rem;
                text-align: center;
                box-sizing: content-box;
            ">

                    <img data-dz-thumbnail style="
                max-height: 100%;
                max-width: 100%;
                top: 50%;
                position: relative;
                transform: translateY(-50%) scale(1);
                margin: 0 auto;
                display: block;
                ">

                    <span data-dz-nopreview id="nopreview" class="dz-nopreview" style="
                color: #a1acb8;
                font-weight: 500;
                text-transform: uppercase;
                font-size: .6875rem;
                position: relative;
                top: 50%;
                transform: translateY(-50%) scale(1);
                margin: 0 auto;
                display: block;
                ">No preview</span>

                    <div class="dz-success-mark" style="
                background-color: rgba(35,52,70,.5);
                display: block;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -1.875rem;
                margin-top: -1.875rem;
                height: 3.75rem;
                width: 3.75rem;
                border-radius: 50%;
                background-position: center center;
                background-size: 1.875rem 1.875rem;
                background-repeat: no-repeat;
                box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
                font-size: 38px;
                color: #4ad44a;
                ">✔
                    </div>

                    <div class="dz-error-mark" style="
                background-color: rgba(35,52,70,.5);
                display: block;
                position: absolute;
                left: 50%;
                top: 50%;
                margin-left: -1.875rem;
                margin-top: -1.875rem;
                height: 3.75rem;
                width: 3.75rem;
                border-radius: 50%;
                background-position: center center;
                background-size: 1.875rem 1.875rem;
                background-repeat: no-repeat;
                box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
                font-size: 38px;
                color: #ec4a4a;
                ">✘
                    </div>

                    <div class="dz-error-message" style="
                background: rgba(255,62,29,.8);
                border-top-left-radius: 0.375rem;
                border-top-right-radius: 0.375rem;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
                position: absolute;
                top: -1px;
                left: -1px;
                bottom: -1px;
                right: -1px;
                color: #fff;
                z-index: 40;
                width: 100%;
                text-align: left;
                overflow: auto;
                font-weight: 500;
                ">
                        <span data-dz-errormessage id="dz-error-message"></span>
                    </div>

                    <div class="progress">
                        <div data-dz-uploadprogress class="progress-bar progress-bar-primary" role="progressbar"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div data-dz-name class="dz-filename" style="
                position: absolute;
                overflow: hidden;
                padding: 0.625rem 0.625rem 0 0.625rem;
                background: #fff;
                white-space: nowrap;
                text-overflow: ellipsis;
                width: -webkit-fill-available;
            "></div>

                <div data-dz-size class="dz-size" style="
                color: #a1acb8;
                padding: 1.875rem 0.625rem 0.625rem 0.625rem;
                font-size: .6875rem;
                font-style: italic;
            ">
                    <strong></strong>
                </div>

            </div>

            <a data-dz-remove class="dz-remove" href="javascript:undefined;" style="
          color: #697a8d;
          border-top: 1px solid #d9dee3;
          border-bottom-right-radius: calc(0.375rem - 1px);
          border-bottom-left-radius: calc(0.375rem - 1px);
          display: block;
          text-align: center;
          padding: 0.375rem 0;
          font-size: .75rem;
        ">Remove file</a>
        </div>
    </div>
</div>
{{-- END LAYOUT --}}

{{-- DropZone Script --}}
    <script>
        $(document).ready(function () {
            var dz = $('#dz-preview-template').html();
            Dropzone.autoDiscover = false;
            let dropZone = $("div#{{ $id ?? 'myDropzone' }}").dropzone({
                url: "{{route('upload')}}",
                method: "post",
                addRemoveLinks: true,
                /**
                 * A string that contains the template used for each dropped
                 * file. Change it to fulfill your needs but make sure to properly
                 * provide all elements.
                 */
                previewTemplate: dz,

                parallelUploads: 1,

                filesizeBase: 1024,

                maxFilesize: 10,

                paramName: "file",

                renameFile: "updd",

                maxFiles: {{ $maxFiles ?? 1 }},

                /**
                 * The default implementation of `accept` checks the file's mime type or
                 * extension against this list. This is a comma separated list of mime
                 * types or file extensions.
                 * Eg.: `image/*,application/pdf,.psd`
                 */
                acceptedFiles: 'image/*',

                /**
                 * Sends the file as binary blob in body instead of form data.
                 */
                binaryBody: false,

                /**
                 * The text used before any files are dropped.
                 */
                dictDefaultMessage: "Drop files here to upload",

                /**
                 * The text that replaces the default message text it the browser is not supported.
                 */
                dictFallbackMessage:
                    "Your browser does not support drag'n'drop file uploads.",

                /**
                 * The text that will be added before the fallback form.
                 * If you provide a  fallback element yourself, or if this option is `null` this will
                 * be ignored.
                 */
                dictFallbackText:
                    "Please use the fallback form below to upload your files like in the olden days.",

                /**
                 * If the filesize is too big.
                 * `filesize` and `maxFilesize` will be replaced with the respective configuration values.
                 */
                dictFileTooBig: `File is too big ({filesize} MiB). Max filesize: {maxFilesize} MiB.`,

                /**
                 * If the file doesn't match the file type.
                 */
                dictInvalidFileType: "You can't upload files of this type.",

                /**
                 * If the server response was invalid.
                 * `statusCode` will be replaced with the servers status code.
                 */
                dictResponseError: `Server responded with {statusCode} code.`,

                /**
                 * If `addRemoveLinks` is true, the text to be used for the cancel upload link.
                 */
                dictCancelUpload: "Cancel upload",

                /**
                 * The text that is displayed if an upload was manually canceled
                 */
                dictUploadCanceled: "Upload canceled.",

                /**
                 * If `addRemoveLinks` is true, the text to be used for confirmation when cancelling upload.
                 */
                dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",

                /**
                 * If `addRemoveLinks` is true, the text to be used to remove a file.
                 */
                dictRemoveFile: "Remove file",

                /**
                 * If this is not null, then the user will be prompted before removing a file.
                 */
                dictRemoveFileConfirmation: "Uploaded file will be removed, are you sure?",

                /**
                 * Displayed if `maxFiles` is st and exceeded.
                 * The string `maxFiles` will be replaced by the configuration value.
                 */
                dictMaxFilesExceeded: "You can not upload any more files.",

                /**
                 * Allows you to translate the different units. Starting with `tb` for terabytes and going down to
                 * `b` for bytes.
                 */
                dictFileSizeUnits: {tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b"},

                /*
                 * Add Listener here
                 *
                 */
                init: function () {
                    @isset($public_path)
                    // Add existing files into Dropzone
                    @if(isset($maxFiles) && $maxFiles > 1)
                    @foreach ($public_path as $index => $path)
                    let mockFile{{ $index }} = { name: "{{ $file_name[$index] ?? "" }}", size: "{{ $size[$index] ?? "" }}" };
                    this.options.addedfile.call(this, mockFile{{ $index }});
                    this.options.thumbnail.call(this, mockFile{{ $index }}, "{{ $path }}");
                    mockFile{{ $index }}.previewElement.classList.add('dz-success');
                    mockFile{{ $index }}.previewElement.classList.add('dz-complete');
                    @endforeach
                    @else
                    let mockFile = {name: "{{$file_name ?? ""}}", size: "{{$size ?? ""}}"};
                    this.options.addedfile.call(this, mockFile);
                    this.options.thumbnail.call(this, mockFile, "{{$public_path}}");
                    mockFile.previewElement.classList.add('dz-success');
                    mockFile.previewElement.classList.add('dz-complete');
                    @endif
                        @endisset

                        this.on('error', function (file, errorMessage) {
                        let errorDisplay = $('[data-dz-errormessage]');
                        errorDisplay.text(errorMessage.message);
                        $('input[name="{{ $name ?? 'image' }}_name"]').val("");
                        $('input[name="{{ $name ?? 'image' }}_public_path"]').val("");
                        $('input[name="{{ $name ?? 'image' }}_storage_path"]').val("-1");
                    });

                    this.on('removedfile', function (file) {
                        // Update hidden fields or any relevant UI elements
                        let fileNames = $('input[name="{{ $name ?? 'image' }}_name"]').val().split(',');
                        let publicPaths = $('input[name="{{ $name ?? 'image' }}_public_path"]').val().split(',');
                        let storagePaths = $('input[name="{{ $name ?? 'image' }}_storage_path"]').val().split(',');

                        // Find the index of the file to be removed
                        let index = fileNames.indexOf(file.name);

                        if (index !== -1) {
                            // Remove the file from arrays by index
                            fileNames.splice(index, 1);
                            publicPaths.splice(index, 1);
                            storagePaths.splice(index, 1);
                        }

                        // Update the hidden fields
                        $('input[name="{{ $name ?? 'image' }}_name"]').val(fileNames.join(','));
                        $('input[name="{{ $name ?? 'image' }}_public_path"]').val(publicPaths.join(','));
                        $('input[name="{{ $name ?? 'image' }}_storage_path"]').val(storagePaths.join(','));

                        // Handle the case where there are no files left
                        if (fileNames.length === 0) {
                            $('input[name="{{ $name ?? 'image' }}_name"]').val("");
                            $('input[name="{{ $name ?? 'image' }}_public_path"]').val("");
                            $('input[name="{{ $name ?? 'image' }}_storage_path"]').val("-1");
                        }
                    });

                    this.on('sending', function (file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                    });

                    this.on('complete', function (file) {
                    });

                    this.on('success', function (file, response) {
                        // Handle successful upload
                        // You can append to the existing values if you are managing multiple file data
                        file.public_path = response.data.public_path;
                        file.storage_path = response.data.storage_path;

                        let fileNameField = $('input[name="{{ $name ?? 'image' }}_name"]');
                        let publicPathField = $('input[name="{{ $name ?? 'image' }}_public_path"]');
                        let storagePathField = $('input[name="{{ $name ?? 'image' }}_storage_path"]');

                        @if(isset($maxFiles) && $maxFiles > 1)
                        fileNameField.val((fileNameField.val() ? (fileNameField.val() + ",") : '') + response.data.file_name);
                        publicPathField.val((publicPathField.val() ? (publicPathField.val() + ",") : '') + response.data.public_path);
                        storagePathField.val((storagePathField.val() ? (storagePathField.val() + ",") : '') + response.data.storage_path);
                        @else
                        fileNameField.val(response.data.file_name);
                        publicPathField.val(response.data.public_path);
                        storagePathField.val(response.data.storage_path);
                        @endif
                    });
                }
            });


            // dropZone.emit("addedfile", existingFile);
            //myDropzone.emit("thumbnail", existingFiles[i], "/image/url");
            // dropZone.emit("complete", existingFile);

        });
    </script>
{{-- END SCRIPT --}}
