<div x-data="{ open: false }" class="z-50">
    <!-- Mobile Toggle Header -->
    <div class="md:hidden flex justify-between items-center py-1 px-4 bg-indigo-800 text-white">
        <h2 class="text-xl font-bold">{{ ucfirst(Auth::user()->role) }} Panel</h2>
        <button @click="open = !open" class="text-white text-2xl focus:outline-none">
            <i :class="open ? 'fas fa-times' : 'fas fa-bars'"></i>
        </button>
    </div>

    <!-- Mobile Overlay -->
    <div
        x-show="open"
        x-transition
        @click.outside="open = false"
        class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"
    ></div>

    <!-- Sidebar Drawer -->
    <aside
        :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="   fixed md:relative md:translate-x-0 transform top-0 left-0 w-64 h-full bg-indigo-900 text-white z-50 transition-transform duration-300 ease-in-out"
    >
        <nav class="px-4 py-6 space-y-2">
            <h2 class="px-4 text-2xl font-bold mb-6 hidden md:block">{{ ucfirst(Auth::user()->role) }} Panel</h2>

            <!-- Links -->
            {{-- Your role-based sidebar links here --}}

                <!-- <nav class="px-4 py-6 space-y-2"> -->
            <!-- <h2 class="text-2xl font-bold mb-6 hidden md:block">{{ ucfirst(Auth::user()->role) }} Panel</h2> -->

            <!-- Admin Links -->
            @if(Auth::user()->role == 'admin')
                <x-sidebar.link route="admin.dashboard" icon="fas fa-tachometer-alt" label="Dashboard" />
                <x-sidebar.link route="admin.users.index" icon="fas fa-users-cog" label="Manage Users" />
                <x-sidebar.link route="admin.students.index" icon="fas fa-user-graduate" label="Manage Students" />
                <x-sidebar.link route="admin.rooms.index" icon="fas fa-door-open" label="Manage Rooms" />
                <x-sidebar.link route="admin.payments.index" icon="fas fa-money-check-alt" label="Payments" />
                <x-sidebar.link route="admin.reports.index" icon="fas fa-chart-line" label="Reports" />
                <x-sidebar.link route="admin.notices.index" icon="fas fa-bullhorn" label="Notices" />
                <x-sidebar.link route="admin.settings.index" icon="fas fa-cogs" label="Settings" />
            @endif

            <!-- Staff Links -->
            @if(Auth::user()->role == 'staff')
            <x-sidebar.link route="staff.dashboard" icon="fas fa-tachometer-alt" label="Dashboard" />
                <x-sidebar.link route="staff.rooms.index" icon="fas fa-door-open" label="Manage Rooms" />
                <x-sidebar.link route="staff.students.index" icon="fas fa-user-graduate" label="Manage Students" />
                <x-sidebar.link route="staff.payments.index" icon="fas fa-money-check-alt" label="Payments" />
                <x-sidebar.link route="staff.complaints.index" icon="fas fa-exclamation-triangle" label="Complaints" />
                <x-sidebar.link route="staff.notices.index" icon="fas fa-bullhorn" label="Notices" />
            @endif

            <!-- Student Links -->
            @if(Auth::user()->role == 'student')
            <x-sidebar.link route="student.dashboard" icon="fas fa-tachometer-alt" label="Dashboard" />
                <x-sidebar.link route="student.room" icon="fas fa-bed" label="My Room" />
                <x-sidebar.link route="student.payments.index" icon="fas fa-money-check-alt" label="Payments" />
                <x-sidebar.link route="student.complaints.index" icon="fas fa-exclamation-triangle" label="Complaints" />
                <x-sidebar.link route="student.notices.index" icon="fas fa-bullhorn" label="Notices" />
            @endif
        </nav>
        <!-- </nav> -->
    </aside>
</div>

    
  