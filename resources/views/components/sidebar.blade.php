<div class="drawer-side">
  <label
    for="dashboard-drawer"
    class="drawer-overlay"
    aria-label="close sidebar"
  ></label>
  <aside class="h-full bg-white w-70 border-r border-base-300 flex flex-col">
    <div class="navbar border-b border-base-300">
      <a href="/" class="text-lg font-extrabold">Budget Tracker</a>
    </div>
    <div class="flex-1 py-4">
      <ul class="menu lg:menu-lg bg-base-100 w-full">
        <li>
          <a href="/" @class(['menu-active' => request()->is('/')])>
            <i class="fa-regular fa-house"></i>
            Home
          </a>
        </li>
      </ul>
    </div>
    <div class="px-4 py-3">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-error btn-outline btn-sm w-full">Logout</button>
      </form>
    </div>
  </aside>
</div>
