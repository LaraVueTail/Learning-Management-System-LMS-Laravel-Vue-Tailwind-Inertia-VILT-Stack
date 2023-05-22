<template>
  <button
    id="dropdownRadioBgHoverButton"
    data-dropdown-toggle="dropdownRadioBgHover"
    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
    type="button"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-4 w-4 mr-2 text-gray-400"
      viewbox="0 0 20 20"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"
      />
    </svg>

    Sort
    <svg
      class="w-4 h-4 ml-2"
      aria-hidden="true"
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M19 9l-7 7-7-7"
      ></path>
    </svg>
  </button>

  <!-- Dropdown menu -->
  <div
    id="dropdownRadioBgHover"
    class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
  >
    <ul
      class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
      aria-labelledby="dropdownRadioBgHoverButton"
    >
      <li v-if="sortByFilters.dateSort ?? false">
        <div
          class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
        >
          <input
            id="default-radio-4"
            type="radio"
            value="date-dsc"
            @change="$emit('update:modelValue', $event.target.value)"
            :checked="modelValue === 'date-dsc'"
            name="default-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
          />
          <label
            for="default-radio-4"
            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
            >Date - New first</label
          >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3"
            />
          </svg>
        </div>
      </li>

      <li v-if="sortByFilters.dateSort ?? false">
        <div
          class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
        >
          <input
            id="default-radio-4"
            type="radio"
            value="date-asc"
            @change="$emit('update:modelValue', $event.target.value)"
            :checked="modelValue === 'date-asc'"
            name="default-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
          />
          <label
            for="default-radio-4"
            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
            >Date - Old first</label
          >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18"
            />
          </svg>
        </div>
      </li>

      <li v-if="sortByFilters.priceSort ?? false">
        <div
          class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
        >
          <input
            id="default-radio-4"
            type="radio"
            value="price-dsc"
            @change="$emit('update:modelValue', $event.target.value)"
            :checked="modelValue === 'price-dsc'"
            name="default-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
          />
          <label
            for="default-radio-4"
            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
            >Price Highest first</label
          >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3"
            />
          </svg>
        </div>
      </li>

      <li v-if="sortByFilters.priceSort ?? false">
        <div
          class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
        >
          <input
            id="default-radio-4"
            type="radio"
            value="price-asc"
            @change="$emit('update:modelValue', $event.target.value)"
            :checked="modelValue === 'price-asc'"
            name="default-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
          />
          <label
            for="default-radio-4"
            class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
            >Price Lowest first</label
          >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18"
            />
          </svg>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: ["modelValue", "sortByFilters"],
  emits: ["update:modelValue"],
};
</script>
