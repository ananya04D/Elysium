<!-- Main container with a lighter background color for contrast -->
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto" style="background-color: #e2e8f0;"> 
  <!-- Background color changed to #e2e8f0 for better contrast with the dark theme -->

  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">
      @foreach ($categories as $category)
      
      <!-- Category tile -->
      <a class="group flex flex-col bg-white border border-gray-300 shadow-sm rounded-xl hover:shadow-lg transition 
         dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
         href="/products?selected_categories[0]={{ $category->id}}" 
         wire:key="{{ $category->id }}">
         <!-- Tile background set to white in light theme and #gray-800 in dark theme -->
         <!-- Hover background changed to #gray-600 in dark theme, and shadow effect enhanced on hover -->
        
        <div class="p-4 md:p-5">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <!-- Category image -->
              <img class="h-[5rem] w-[5rem]" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
              
              <div class="ms-3">
                <!-- Category name with improved text colors -->
                <h3 class="group-hover:text-blue-500 text-2xl font-semibold text-gray-900 
                  dark:group-hover:text-yellow-400 dark:text-gray-100">
                  {{$category->name}}
                </h3>
                <!-- Text color in light mode set to #gray-900, and in dark mode set to #gray-100. Hover effect color is blue in light mode and yellow in dark mode -->
              </div>
            </div>
            <div class="ps-3">
              <!-- SVG icon with modified color -->
              <svg class="flex-shrink-0 w-5 h-5 text-gray-500 dark:text-gray-300 group-hover:text-blue-500 dark:group-hover:text-yellow-400" 
                   xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
              <!-- SVG icon color in light mode: #gray-500, hover color: #blue-500; in dark mode: #gray-300, hover color: #yellow-400 -->
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
