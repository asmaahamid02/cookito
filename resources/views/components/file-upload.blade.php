@props(['name', 'accept' => '.jpeg, .png, .jpg, .svg', 'rules' => 'JPG, JPEG, PNG, SVG (MAX. 2MB)', 'containerClass', 'labelClass', 'id' => 'recipe-image'])

<div class="flex items-center justify-center {{ $containerClass ?? '' }}">
    <label for="{{$id}}" id="{{$id}}-label" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed relative cursor-pointer bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 {{ $labelClass ?? '' }}">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <x-heroicon-o-cloud-arrow-up class="w-6 h-6 mb-4 text-gray-500 dark:text-gray-400" />
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG, PNG, SVG (MAX. 2MB)</p>
        </div>
        <input id="{{$id}}" type="file" class="hidden" name="image" accept=".jpeg, .png, .jpg, .svg" />
        <img id="{{$id}}-preview" class="hidden absolute inset-0 object-contain w-full h-full rounded-md bg-inherit" />
    </label>
</div>
<p id="{{$id}}-data" class="hidden mt-2 text-xs text-gray-500 dark:text-gray-400"></p>

<script>
    const id = @json($id);

    //handle file upload
    $(`#${id}`).on('change', function() {
        const file = $(this)[0].files[0]
        handleFileLoad(file)
    })

    //handle file drag and drop
    $(`#${id}-label`).on('dragover', function(e) {
        e.preventDefault()
        $(this).addClass('border-amber-400 dark:border-amber-500')
    })

    $(`#${id}-label`).on('dragleave', function(e) {
        e.preventDefault()
        $(this).removeClass('border-amber-400 dark:border-amber-500')
    })

    $(`#${id}-label`).on('drop', function(e) {
        e.preventDefault()
        $(this).removeClass('border-amber-400 dark:border-amber-500')

        $(`#${id}`).prop('files', e.originalEvent.dataTransfer.files)

        const file = e.originalEvent.dataTransfer.files[0]

        handleFileLoad(file)
    })

    function handleFileLoad(file) {
        if (file) {
            const data = `${file.name} | ${(file.size / 1024 / 1024).toFixed(2)} MB`
            $(`#${id}-data`).removeClass('hidden').text(data)

            const reader = new FileReader()
            reader.onload = function(e) {
                $(`#${id}-preview`).attr('src', e.target.result)
                $(`#${id}-preview`).removeClass('hidden')
            }
            reader.readAsDataURL(file)
        } else {
            $('#${id}-preview').attr('src', '').addClass('hidden')
            $(`#${id}-data`).addClass('hidden').text('')
        }
    }
</script>