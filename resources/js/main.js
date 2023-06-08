import { router } from "@inertiajs/vue3";

// Function to slugify
function slugify(str) {
    console.log(str);
    return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
}
// // Function to create slug from name
// function changeNameToSlug(name) {
//     return this.slugify(name);
// }
// Function to create slug
function changeToSlug(name = "", slug = "") {
    if (slug !== "") {
        return slugify(slug);
    } else {
        return slugify(name);
    }
}
function createRequest({
    url,
    data,
    state_preservation = true,
    scroll_preservation = true,
    only_list,
} = {}) {
    router.post(url, data, {
        preserveState: state_preservation,
        preserveScroll: scroll_preservation,
        only: only_list,
    });
}

function editRequest({
    url,
    data,
    dataId,
    state_preservation = true,
    scroll_preservation = true,
    only_list,
} = {}) {
    data['_method'] = "put";
    router.post(url + (dataId ?? ''), data, {
        preserveState: state_preservation,
        preserveScroll: scroll_preservation,
        only: only_list,
    });
}

export { changeToSlug, createRequest, editRequest };
