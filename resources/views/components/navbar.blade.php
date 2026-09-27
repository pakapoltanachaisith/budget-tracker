<div class="navbar bg-base-100 shadow-sm">
  <div class="flex-none">
    <label for="dashboard-drawer" class="btn btn-square btn-ghost lg:hidden">
      <i class="fa-solid fa-bars"></i>
      <span class="sr-only">open sidebar</span>
    </label>
  </div>
  <div class="flex-1 flex items-center">
    <a href="/" class="text-lg font-extrabold lg:hidden">Budget Tracker</a>
    <div class="ml-auto">
      @auth
        <div class="avatar avatar-placeholder">
          <div class="bg-neutral text-neutral-content w-8 lg:w-10 rounded-full">
            <span>{{ Auth::user()->name[0] }}</span>
          </div>
        </div>
      @endauth
    </div>
  </div>
</div>
