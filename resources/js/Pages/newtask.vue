<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";



const form = useForm({
    name: "",
    priority: "",
    description: "",
});
 // Get toast interface
 const toast = useToast();


const submit = () => {
    form.post(route("AddTasks"), {
        onSuccess: () => (form.reset("name","priority","description"),toast.success("Task Added Successfully"))
    });
};
</script>

<template>
    <Head title="New Task" />

    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Task
            </h2>
        </template>

        <div class="py-2">
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg pt-4"
            >
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="Name" value="Name" />

                        <TextInput
                            id="Name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="priority" value="Priority" />

                        <TextInput
                            id="priority"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.priority"
                            required
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.priority"
                        />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="priority" value="Description" />

                        <TextArea
                            id="description"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                           Add
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </MainLayout>
</template>
