<template>
    <li>
        <Link
            :href="navbarItem.link"
            :method="navbarItem.method"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem"
            >{{ navbarItem.name }}
        </Link
        >
    </li>
</template>
<script>
export default {
    props: ["navbarItem"],
};
</script>
