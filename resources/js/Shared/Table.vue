<template>
    <div class="overflow-x-auto" v-if="data.length">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th
                        scope="col"
                        class="px-4 py-3"
                        v-for="item in tableContent"
                        :key="item"
                    >
                        {{ item.heading }}
                    </th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-gray-700"
                    v-for="(item, index) in data"
                    :key="index"
                >
                    <td
                        scope="row"
                        v-for="row in tableContent"
                        :key="row"
                        class="p-4 font-medium"
                        :class="{
                            'text-gray-900 whitespace-nowrap':
                                row.heading === 'ID',
                        }"
                    >
                        <div v-if="row.type === 'text'">
                            {{ item[row.value] }}
                        </div>
                        <div
                            v-if="row.type === 'image'"
                            class="w-20 h-20 bg-cover bg-center rounded-lg"
                            :style="`background-image: url(${item[row.value]})`"
                        ></div>
                        <div v-if="row.type === date">
                            {{ toDate(item[row.value]) }}
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        <button
                            :id="`${index}-dropdown-button`"
                            :data-dropdown-toggle="`${index}-dropdown`"
                            class="p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                            type="button"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                                />
                            </svg>
                        </button>
                        <div
                            :id="`${index}-dropdown`"
                            class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <ul
                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                :aria-labelledby="`${index}-dropdown-button`"
                            >
                                <li
                                    v-for="(actionLink, index) in actionLinks"
                                    :key="index"
                                >
                                    <Link
                                        :href="(actionLink.name ==='Edit') ? `/${actionLink.link}/${item['id']}/edit`:''"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >{{ actionLink.name }}</Link
                                    >
                                </li>
                            </ul>
                            <div class="py-1" v-if="deleteEnable">
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    @click="$emit('deleteItem', item['id'])"
                                    >Delete</a
                                >
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-else class="text-lg px-4 text-gray-500">No Data!</div>
</template>
<script>
export default {
    props: ["data", "tableContent", "deleteEnable", "actionLinks"],
    emits: ["deleteItem"],
    methods: {
        toDate(date) {
            try {
                var d = new Date(date);
                let text = d.toDateString();
                return text;
            } catch (error) {
                return false;
            }
        },
        convertString(string) {
            var newString = string.split("_").join(" ");
            return newString.charAt(0).toUpperCase() + newString.slice(1);
        },
    },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
</script>
