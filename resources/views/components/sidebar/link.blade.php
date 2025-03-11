@props(['route','class' => 'flex items-center text-xs hover:bg-blue-600 hover:text-white rounded p-1 mt-1'])
<a href="{{ route($route) }}">
  <li {{ $attributes->merge(['class' => Route::currentRouteName() === $route ? $class. ' bg-blue-600 text-white' : $class]) }}>
   {{ $slot }}

    <div class="ml-1">{{ ucfirst($route) }}</div>
  </li>
</a>