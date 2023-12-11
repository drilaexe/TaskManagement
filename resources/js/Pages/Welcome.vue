<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Cards from "@/Components/Cards.vue";
import { Head, useForm } from "@inertiajs/vue3";
import draggable from "vuedraggable";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { ref, provide,getCurrentInstance  } from "vue";
import { useToast } from "vue-toastification";
const toast = useToast();
const instance = getCurrentInstance();

import axios from "axios";
import DangerButton from "@/Components/DangerButton.vue";
const editingModal = ref(false);
const DelModal = ref(false);
const dragkey = ref(0);

let delId = 0;
const updateform = useForm({
    name: "",
    priority: "",
    description: "",
    id: "",
});
const DelModalShow = (id) => {
    DelModal.value = true;
    delId = id;
};
const editModal = (id) => {
    editingModal.value = true;
    console.log(id);
    axios.get("/taskId/" + id).then(
        (response) => {
            console.log(response);
            console.log('editmodal show');
            updateform.name = response.data[0].name;
            updateform.priority = response.data[0].priority.toString();
            updateform.description = response.data[0].description;
            updateform.id = id.toString();
        },
        (error) => {
            console.log(error);
        }
    );
};
const submit = () => {
    updateform.put(route("EditTasks"), {
        onSuccess: () => (
            (editingModal.value = false),
            toast.success("Task Edited Successfully")
        ),
    });
};
const closeModal = () => {
    editingModal.value = false;
};
const closeModalDel = () => {
    DelModal.value = false;
};
const delform = useForm({'id':''});
const deleteTask = (delId) => {

    delform.id=delId
    delform.delete(route("DelTask"), {
        onSuccess: () => (
            (DelModal.value = false),
            toast.error("Task Deleted Successfully")
        ),
    });
};
provide("showmodal", editModal);
provide("showmodalDel", DelModalShow);
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
                    :list="$page['props']['tasks']"
                    @start="drag = true"
                    @end="drag = false"
                    :key="dragkey"
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
                            v-bind:id="element.id"
                        ></Cards>
                    </template>
                </draggable>
            </div>
        </div>

        <Modal :show="editingModal" @close="closeModal">
            <div class="p-6">
                <form @submit.prevent="submit">
                    <h2 class="text-lg font-medium text-gray-900">Editing</h2>

                    <div
                        class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg pt-4"
                    >
                        <div>
                            <InputLabel for="Name" value="Name" />

                            <TextInput
                                id="Name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="updateform.name"
                                required
                                autofocus
                            />
                            <TextInput
                                id="id"
                                type="hidden"
                                class="mt-1 block w-full"
                                v-model="updateform.id"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="updateform.errors.name"
                            />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="priority" value="Priority" />

                            <TextInput
                                id="priority"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="updateform.priority"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="updateform.errors.priority"
                            />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="priority" value="Description" />

                            <TextArea
                                id="description"
                                class="mt-1 block w-full"
                                v-model="updateform.description"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="updateform.errors.description"
                            />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <SecondaryButton @click="closeModal">
                            Cancel
                        </SecondaryButton>
                        <PrimaryButton
                            class="ms-4"
                            type="button"
                            :class="{ 'opacity-25': updateform.processing }"
                            :disabled="updateform.processing"
                        >
                            Edit
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
        <Modal :show="DelModal" @close="closeModalDel">
            <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Editing</h2>

                    <div
                        class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg pt-4"
                    >
                        <p>Are y</p>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <SecondaryButton @click="closeModalDel">
                            Cancel
                        </SecondaryButton>
                        <DangerButton class="ms-4" @click="deleteTask(delId)">
                            Delete
                        </DangerButton>
                    </div>
            </div>
        </Modal>
    </MainLayout>
</template>
