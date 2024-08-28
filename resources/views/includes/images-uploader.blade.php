<style>
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-input-wrapper input[type="file"] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .file-input-wrapper .btn-upload {
        border: 2px dashed #ccc;
        color: #333;
        background-color: #fff;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 18px;
        font-weight: bold;
        display: inline-block;
        cursor: pointer;
        text-align: left;
    }

    .file-input-wrapper .file-name {
        margin-left: 10px;
    }
</style>

<div class="file-input-wrapper">
    <button class="text-left btn-upload @error("images[]") border-danger @enderror">Upload Files<br><span class="text-muted">[You can add multi files]</span></button>
    <span class="file-name"></span>
    <input multiple type="file" name="images[]" id="images" class="file-input">

    @error("images[]")
    <small id="image-error-message" class="text-danger mt-1">
        {{ $message }}
    </small>
    @enderror
</div>


@push("scripts")
    <script>
        const fileInput = document.getElementById('images');
        const fileNameDisplay = document.querySelector('.file-name');

        fileInput.addEventListener('change', function() {
            let fileNames = "";
            for ( let i = 0; i < this.files.length; i++) {
                fileNames += this.files[i].name.split('\\').pop();
                fileNames += " | "
            }
            fileNameDisplay.textContent = fileNames;
            $("#images").removeClass("border-danger");
            $("#image-error-message").remove();
        });
    </script>
@endpush
