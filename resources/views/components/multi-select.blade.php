@props(['containerClass' => '', 'items' => [], 'selectedItems' => [], 'name' => 'categories[]', 'placeholder' => 'Select category'])

@php


$selectedItemsFull = [];
foreach($items as $item) {
if(in_array($item->id, $selectedItems)) {
$selectedItemsFull[] = $item;
}
}

@endphp
<div class="relative {{ $containerClass }}">
  <div class="multi-select-wrapper border py-2 pl-2 pr-6 relative min-h-12 flex flex-wrap border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm cursor-text">
    <span class="chips-container cursor-default">
      @if(count($selectedItemsFull) > 0)
      @foreach($selectedItemsFull as $item)
      <span class="chip-item inline-flex items-center rounded bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 me-1 mb-1 gap-1" data-value="{{ $item->id }}">
        <span class="chip-content truncate text-sm">{{ $item->name }}</span>
        <button class="chip-remove ms-2 p-1 inline-flex items-center rounded-sm text-sm text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300" aria-label="Remove">
          <x-heroicon-o-x-mark class="w-4 h-4" />
          <span class="sr-only">Remove badge</span>
        </button>
      </span>
      @endforeach
      @endif
    </span>
    <span class="multi-select-input-box w-auto">
      <input size="18" type="text" tabindex="1" autocomplete="off" role="combobox" aria-controls="categories" aria-disabled="false" aria-expanded="false" class="multi-select-input h-10 p-2 text-sm text-gray-800 focus:outline-none focus:outline-offset-0 focus:ring-0 bg-white dark:bg-gray-900 indent-0 dark:text-gray-300 placeholder:text-xs border-none" placeholder="{{ $placeholder }}">
    </span>
    <button class="clear-selection absolute right-1 bottom-2 font-medium hidden p-1 items-center rounded-sm text-lg text-gray-400 bg-transparent hover:text-gray-900 dark:hover:text-gray-300" aria-label="Clear">
      <x-heroicon-o-x-mark class="w-6 h-6" />
      <span class="sr-only">Clear Selection</span>
    </button>
    <select class="multi-select-selections hidden" multiple tabindex="-1" aria-hidden="true" name="{{$name}}">
      @foreach($selectedItemsFull as $item)
      <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="multi-select-list-wrapper bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md pr-2 absolute z-10 mt-1 left-0 right-0 hidden">
    <ul id="categories" class="multi-select-list flex flex-col max-h-48 overflow-y-auto text-gray-700 dark:text-gray-300">
      @foreach($items as $item)
      <li class="multi-select-item py-2 pl-3 pr-2 mr-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800
      {{ in_array($item->id, $selectedItems) ? 'bg-gray-100 dark:bg-gray-800' : '' }}" data-value="{{ $item->id }}">
        {{ $item->name}}
      </li>
      @endforeach
    </ul>
  </div>
</div>

<script>
  $(document).ready(function() {

    checkEmptySelection()

    //Show/Hide the dropdown list
    $('.multi-select-wrapper').on('click', function(e) {
      if (
        $(e.target).closest('.chips-container').length ||
        $(e.target).closest('.clear-selection').length
      )
        return

      $('.multi-select-input').focus()
    })

    $('.multi-select-input').on('focus', function() {
      $('.multi-select-list-wrapper').show()
    })

    $('.multi-select-input').on('blur', function() {
      setTimeout(function() {
        $('.multi-select-list-wrapper').hide()
      }, 200)
    })

    //Select item
    $('.multi-select-item').on('click', function() {
      if ($(this).hasClass('not-found')) return

      const value = $(this).data('value')
      const text = $(this).text()
      const foundChip = $('.chips-container').find(
        `[data-value='${value}']`
      )
      const foundSelection = $('.multi-select-selections').find(
        `[value='${value}']`
      )

      //add if not found
      if (foundChip.length <= 0) {
        const chip = `
                        <span class="chip-item inline-flex items-center rounded bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 px-2 py-1 me-1 mb-1 gap-1" data-value="${value}">
                            <span class="chip-content truncate text-sm">${text}</span>
                            <button class="chip-remove ms-2 p-1 inline-flex items-center rounded-sm text-sm text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300" aria-label="Remove">                        
                                <x-heroicon-o-x-mark class="w-4 h-4" />
                                <span class="sr-only">Remove badge</span>
                            </button>
                        </span>
                        `

        $('.chips-container').append(chip)
        $(this).addClass('bg-gray-100 dark:bg-gray-800')

        //append to select
        const select = $('.multi-select-selections')
        const option = `<option value="${value}" selected>${text}</option>`
        select.append(option)
      } else {
        //remove selection if found
        $(this).removeClass('bg-gray-100 dark:bg-gray-800')
        foundSelection.remove()
        foundChip.remove()
      }

      $('.multi-select-input').val('')
      $('.multi-select-item').removeClass('hidden')
      $('.multi-select-list-wrapper').hide()

      //check if there are selected items
      checkEmptySelection()
    })

    //Search items
    $('.multi-select-input').on('keyup', function(e) {
      if (
        e.key === 'Backspace' &&
        $(this).val() == '' &&
        $('.chips-container').children().length > 0
      ) {
        handleBackSpaceKey(e)
        return
      }

      const value = $(this).val().toLowerCase()
      //check if there are items
      $('.multi-select-item').each(function() {
        const text = $(this).text().toLowerCase()
        if (text.indexOf(value) > -1) {
          $(this).removeClass('hidden')
        } else {
          $(this).addClass('hidden')
        }
      })

      //check if there are no items
      if ($('.multi-select-item:not(.hidden)').length <= 0) {
        $('.not-found').removeClass('hidden')
      } else {
        $('.not-found').addClass('hidden')
      }
    })

    //Clear selection
    $(document).on('click', '.clear-selection', function(e) {
      e.preventDefault()
      $('.chips-container').html('')
      $('.multi-select-input')
        .val('')
        .attr('placeholder', 'Select category')
        .attr('size', '18')
      $('.multi-select-selections').html('')
      $('.multi-select-item').removeClass(
        'bg-gray-100 dark:bg-gray-800 hidden'
      )
      $(this).hide()
    })

    //Remove chip
    $(document).on('click', '.chip-remove', function(e) {
      e.preventDefault()
      const value = $(this).parent().data('value')
      $('.multi-select-item').each(function() {
        if ($(this).data('value') == value) {
          $(this).removeClass('bg-gray-100 dark:bg-gray-800')
        }
      })
      $('.multi-select-selections').find(`[value='${value}']`).remove()
      $(this).parent().remove()

      checkEmptySelection()
    })

    //Check if there are selected items to handle input and clear button states
    function checkEmptySelection() {
      if ($('.chips-container').children().length > 0) {
        $('.clear-selection').removeClass('hidden').addClass('inline-flex')
        $('.multi-select-input').attr('placeholder', '').attr('size', '4')
      } else {
        $('.clear-selection').addClass('hidden').removeClass('inline-flex')
        $('.multi-select-input')
          .attr('placeholder', 'Select category')
          .attr('size', '18')
      }
    }

    function handleBackSpaceKey(e) {
      const lastChip = $('.chips-container').children().last()
      const value = lastChip.data('value')
      $('.multi-select-item').each(function() {
        if ($(this).data('value') == value) {
          $(this).removeClass('bg-gray-100 dark:bg-gray-800')
        }
      })
      $('.multi-select-selections').find(`[value='${value}']`).remove()
      lastChip.remove()
      checkEmptySelection()
    }
  })
</script>