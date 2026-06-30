<x-app-layout>
    
    <main>
    <!-- Found Cars -->
    <section>
      <div class="container">
        <div class="sm:flex items-center justify-between mb-medium">
          <div class="flex items-center">
            <button class="show-filters-button flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" style="width: 20px">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
              </svg>
              Filters
            </button>
            <h2>Define your search criteria</h2>
          </div>

          <select class="sort-dropdown">
            <option value="">Order By</option>
            <option value="price_asc">Price Asc</option>
            <option value="price_desc">Price Desc</option>
            <option value="year_desc">Year Newest</option>
            <option value="year_asc">Year Oldest</option>
          </select>
        </div>
        <div class="search-car-results-wrapper">
          <div class="search-cars-sidebar">
            <div class="card card-found-cars">
              <p class="m-0">Found <strong>{{ $cars->total() }}</strong> cars</p>

              <button class="close-filters-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px">
                  <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <!-- Find a car form -->
            <x-search-form />
            <!--/ Find a car form -->
          </div>

          <div class="search-cars-results">
            <div class="car-items-listing">
              @foreach($cars as $car)
                <x-car-item :$car />
              @endforeach
            </div>
            {{ $cars->onEachSide(1)->links('pagination') }}
            
          </div>
        </div>
      </div>
    </section>
    <!--/ Found Cars -->
    </main>

</x-app-layout>
