<template>
    <div>
        <label
            for=""
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >{{ label }}</label
        >
        <input
            class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            :class="{
                'border-2 border-rose-500': error || errorSize,
            }"
            :id="name"
            type="file"
            ref="fileInputSingle"
            accept="image/png, image/jpeg"
            @input="fileAdded($event.target.files)"
        />
        <div v-if="error">
            <div v-text="error" class="text-red-500 text-xs my-1"></div>
        </div>

        <div v-if="errorSize" class="text-red-500 text-xs my-1">
            Upload file less than 2MB
        </div>

        <div
            class="relative text-white cursor-pointer mt-3 mb-10 mx-auto"
            :class="rounded ? 'w-48 h-48' : 'h-48 w-full'"
        >
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
            >
            <div class="flex gap-2">
              <div class="flex text-white hover:text-black gap-1 items-center py-1 px-4 bg-blue-600 hover:bg-white rounded-full shadow-lg" @click="$refs.fileInputSingle.click()">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-4 h-4"
                    >
                        <path
                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z"
                        />
                        <path
                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z"
                        />
                    </svg>
                    <p
                        v-text="
                            addedFile || oldImage ? 'Edit' : 'Add'
                        "
                        class="text-sm"
                    ></p>
                </div>
                <!-- <div class="flex text-gray-50 hover:text-red-500 gap-1 items-center" @click="fileRemoved()" v-if="addedFile || oldImage">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                        />
                    </svg>

                    <p
                        v-text="
                            'Delete'
                        "
                        class="text-sm"
                    ></p>
                </div> -->
            </div>

            </div>
            <div
                class="bg-contain bg-center bg-no-repeat w-full h-full border-dashed border-2 border-gray-200 bg-gray-100"
                :class="{ 'rounded-full': rounded, 'rounded-lg': !rounded, 'saturate-50 bg-blend-overlay bg-gray-900/75 shadow-2xl' : (addedFile || oldImage)}"
                :style="`background-image: url(${uploadedFile()})`"
            ></div>
        </div>
    </div>
</template>

<script>
import { FlagIcon } from "@heroicons/vue/20/solid";
export default {
    props: ["label", "error", "name", "oldImageLink", "rounded"],
    data() {
        return {
            addedFile: null,
            errorSize: false,
            oldImage: this.oldImageLink,
        };
    },
    emits: ["fileChange"],
    methods: {
        fileAdded(files) {
            this.errorSize = false;
            if (files[0].size > 2500000) {
                this.errorSize = true;
            }
            if (!this.errorSize) {
                this.addedFile = files;
                console.log(this.addedFile);
                this.$emit("fileChange", this.addedFile);
            }
        },
        fileRemoved() {
            this.errorSize = false;
            this.addedFile = null;
            this.oldImage = null;
            this.$refs.fileInput.value = "";
        },
        uploadedFile() {
            if (this.addedFile) {
                return URL.createObjectURL(this.addedFile[0]);
            } else if (this.oldImage) {
                console.log(this.oldImage);
                return this.oldImage;
            } else {
                return "";
            }
        },
    },
};
</script>
