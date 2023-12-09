<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Cards from "@/Components/Cards.vue";
import { Head } from "@inertiajs/vue3";
import draggable from "vuedraggable";
</script>

<template>
    <Head title="Tasks" />

    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap flex-col md:flex-row"
                >
                    <draggable
                        v-model="$page['props']['tasks']"
                        group="people"
                        @start="drag = true"
                        @end="drag = false"
                        item-key="id"
                    >
                        <template #item="{ element }">
                            <Cards
                                v-bind:priority="element.priority"
                                v-bind:title="element.name"
                                v-bind:description="element.description"
                                v-bind:created_at="element.created_at"
                            ></Cards>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
