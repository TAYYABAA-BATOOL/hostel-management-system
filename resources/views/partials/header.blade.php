<div class="bg-gradient-to-r from-indigo-600 to-indigo-800 shadow-lg p-4 flex flex-wrap justify-between items-center text-center sm:text-left gap-3">
  <h1 class="text-2xl sm:text-3xl text-white font-extrabold tracking-wide flex items-center gap-2">
    <i class="fas fa-hotel text-xl sm:text-2xl"></i>
    <span>Traveller's Hub Hostel</span>
  </h1>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow-md transition">
      Logout
    </button>
  </form>
</div>
