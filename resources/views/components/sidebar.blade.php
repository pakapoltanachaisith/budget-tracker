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
      <ul class="menu rounded-box w-full space-y-1">
        <x-sidebar-link
          href="/"
          label="Home"
          icon="ti ti-home-2"
          :active="request()->is('/')"
        />
        <li>
          <a href="{{ route('expenses.index') }}" @class(['menu-active' => request()->routeIs('expenses.index')])>
            <i class="ti ti-credit-card"></i>
            Expenses
          </a>
          <ul>
            <x-sidebar-link
              href="{{ route('expenses.create') }}"
              label="Add expense"
              icon="ti ti-circle-plus"
              :active="request()->routeIs('expenses.create')"
            />

          </ul>
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
