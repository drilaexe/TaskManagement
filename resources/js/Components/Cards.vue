<script setup>
defineProps(["title", "description", "priority", "created_at", "id"]);
import {
    PencilSquareIcon,
    ArrowsPointingOutIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
import { inject } from "vue";
const showmod = inject("showmodal");
const showmoddel = inject("showmodalDel");
</script>

<template>
    <div class="w-full lg:w-1/3 p-3 grid grid-cols-12 gap-1">
        <div
            class="flex flex-col rounded overflow-hidden h-auto lg:h-32 border shadow shadow-lg col-span-11"
        >
            <div
                class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-1 flex flex-col leading-normal"
            >
                <div
                    class="text-black font-bold text-xl mb-2 leading-tight flex justify-between"
                >
                    <p>{{ title }}</p>
                    <p>#{{ priority }}</p>
                </div>
                <p class="text-grey-darker text-base">
                    {{ description }}
                </p>
            </div>
            <p class="text-right text-end text-sm mt-auto pe-2">
                {{ created_at }}
            </p>
        </div>
        <div class="col-span-1">
            <button>
                <ArrowsPointingOutIcon class="h-6 w-6 text-dark-500 handle" />
            </button>
            <button @click="showmod(id)">
                <PencilSquareIcon class="h-6 w-6 text-blue-500" />
            </button>
            <button @click="showmoddel(id)"><XMarkIcon class="h-6 w-6 text-red-500" /></button>
        </div>
    </div>
</template>
