@extends('dashboard')

@section('content')

<div>
  <label id="listbox-label" class="block text-sm/6 font-medium text-gray-900">Languages</label>
  <div class="relative mt-2" x-data="selectMenu" @click="open = !open" @click.away="open = false" @keydown.esc.prevent="open=false" @keydown.up.prevent="arrowUp" @keydown.down.prevent="arrowDown">
    <button type="button" class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pr-2 pl-3 text-left text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
      <span class="col-start-1 row-start-1 flex items-center gap-3 pr-6">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
        </svg>

        <span class="block truncate">Select a Language</span>
      </span>
      <svg class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
        <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
      </svg>
    </button>

    <!--
      Select popover, show/hide based on select state.

      Entering: ""
        From: ""
        To: ""
      Leaving: "transition ease-in duration-100"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base ring-1 shadow-lg ring-black/5 focus:outline-hidden sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3" x-show="open">
      <!--
        Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

        Highlighted: "bg-indigo-600 text-white outline-hidden", Not Highlighted: "text-gray-900"
      -->
      @foreach($languages as $code => $language)
      <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none" id="listbox-option-0" role="option" @mouseenter="mouseEnter($el)" x-bind:class="{'bg-indigo-600 text-white outline-hidden': elementSelected === $el}">
        <div class="flex items-center">
          <img src="{{ $language['flag'] }}" alt="" class="size-5 shrink-0 rounded-full">
          <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
          <span class="ml-3 block truncate font-normal">{{ $language['name'] }}</span>
        </div>

        <!--
          Checkmark, only display for selected option.

          Highlighted: "text-white", Not Highlighted: "text-indigo-600"
        -->
        @if(auth()->user()->language === $code)
        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600" :class="{'text-white':elementSelected.children?.length > 1}">
          <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
          </svg>
        </span>
        @endif
      </li>
      @endforeach

      <!-- More items... -->
    </ul>
  </div>
</div>

<script>
  function selectMenu(){
    return {
      open:false,
      elementSelected:'',
      mouseEnter(el){
        this.elementSelected = el;
      },
      arrowUp(){
        console.log('up');
      },
      arrowDown(){
        console.log('down');
      }
    }
  }
</script>

@endsection