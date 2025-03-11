<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <x-navbar.navbar />
  <x-modal.modal />
  <div class="flex" x-data="{
    sidebar: false,
    init(){
      this.sidebar = localStorage.getItem('sidebar') ? true : false;
    },
    showSidebar() {
      this.sidebar = true;
      localStorage.setItem('sidebar', true);
    },
    hideSidebar() {
      this.sidebar = false;
      localStorage.removeItem('sidebar');
    }
   }">
    <x-sidebar.sidebar />
    <div class="mt-3 w-full px-4">
      <template x-if="!sidebar">
        <svg class="w-5 cursor-pointer hover:bg-gray-200 hover:rounded-2xl hover:p-0.5" @click="showSidebar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </template>
      @yield('content')
    </div>
  </div>
</body>
</html>