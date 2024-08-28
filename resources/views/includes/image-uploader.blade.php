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
        text-align: center;
    }

    .file-input-wrapper .file-name {
        margin-left: 10px;
    }
</style>

<div class="file-input-wrapper">
    <button class="btn-upload @error("image") border-danger @enderror">Upload File</button>
    <span class="file-name"></span>
    <input type="file" name="image" id="image" class="file-input">

    @error("image")
    <small id="image-error-message" class="text-danger mt-1">
        {{ $message }}
    </small>
    @enderror
</div>


@push("scripts")
    <script>
        const fileInput = document.getElementById('image');
        const fileNameDisplay = document.querySelector('.file-name');

        fileInput.addEventListener('change', function() {
            fileNameDisplay.textContent = this.value.split('\\').pop();
            $("#image").removeClass("border-danger");
            $("#image-error-message").remove();
        });
    </script>
@endpush
