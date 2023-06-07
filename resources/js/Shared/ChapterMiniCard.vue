<template>
    <div class="bg-blue-50 dark:bg-gray-700/50 p-2 md:p-3 rounded-lg shadow-lg">
        <div
            class="h-48 grid items-center bg-cover bg-center rounded-md"
            style="
                background-image: url('https://images.pexels.com/photos/1771338/pexels-photo-1771338.jpeg');
            "
        >
            <div
                class="border-s-2 border-yellow-400 pl-2 backdrop-blur-sm bg-black/10"
            >
                <p
                    class="text-xs leading-tight tracking-tight text-gray-100 md:text-sm dark:text-gray-400"
                >
                    Chapter Name
                </p>
                <h3 class="text-white">{{ chapter.name }}</h3>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-3 my-3 break-words">
            <div>
                <p
                    class="text-xs leading-tight tracking-tight text-gray-600 md:text-xs dark:text-gray-400"
                >
                    Description:
                </p>
                <p
                    class="text-sm leading-tight tracking-tight text-gray-600 md:text-sm dark:text-gray-200"
                >
                    {{ chapter.description }}
                </p>
            </div>
            <div>
                <p
                    class="text-xs leading-tight tracking-tight text-gray-600 md:text-xs dark:text-gray-400"
                >
                    Video:
                </p>
                <p
                    class="text-sm leading-tight tracking-tight text-gray-600 md:text-sm dark:text-gray-200"
                >
                    {{ chapter.video }}
                </p>
            </div>
            <div>
                <p
                    class="text-xs leading-tight tracking-tight text-gray-600 md:text-xs dark:text-gray-400"
                >
                    Link:
                </p>
                <p
                    class="text-sm leading-tight tracking-tight text-gray-600 md:text-sm dark:text-gray-200"
                >
                    {{ chapter.link }}
                </p>
            </div>
            <div>
                <p
                    class="text-xs leading-tight tracking-tight text-gray-600 md:text-xs dark:text-gray-400"
                >
                    Created at:
                </p>
                <p
                    class="text-sm leading-tight tracking-tight text-gray-600 md:text-sm dark:text-gray-200"
                >
                    {{ toDate(chapter.created_at) }}
                </p>
            </div>
        </div>
        <Link :href="`/admin-dashboard/chapters/${chapter.id}/edit`">
            <button
                class="rounded-md font-medium bg-blue-600 hover:bg-blue-700 py-2 px-3 text-sm text-white"
            >
                Edit Chapter
            </button>
        </Link>
    </div>
</template>
<script>
export default {
    props: ["chapter"],
    methods:{
        toDate(date) {
      try {
        var d = new Date(date);
        let text = d.toDateString();
        return text;
      } catch (error) {
        return false;
      }
    },
    }
};
</script>
