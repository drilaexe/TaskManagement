<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Cards from "@/Components/Cards.vue";
import { Head } from "@inertiajs/vue3";
import draggable from "vuedraggable";
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import DangerButton from '@/Components/DangerButton.vue';
import {  ref,provide  } from 'vue';
const editingModal = ref(false);

const editModal = () => {
    editingModal.value = true;
    
};
const closeModal = () => {
    editingModal.value = false;

};
provide('showmodal', editModal);
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
            
                <draggable
                :list ="$page['props']['tasks']"
                    @start="drag = true"
                    @end="drag = false"
                    item-key="id"
                    handle=".handle"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap flex-col md:flex-row"
                >
                    <template #item="{ element, index }">
                        <Cards
                            v-bind:priority="index + 1"
                            v-bind:title="element.name"
                            v-bind:description="element.description"
                            v-bind:created_at="element.created_at"
                        ></Cards>
                    </template>
                </draggable>
            </div>
        </div>
       
        <Modal :show="editingModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                

                   
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                  
                </div>
            </div>
        </Modal>
    </MainLayout>
</template>
