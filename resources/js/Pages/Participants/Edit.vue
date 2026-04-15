<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    participant: Object,
})

const form = useForm({
    first_name: props.participant.first_name ?? '',
    last_name: props.participant.last_name ?? '',
    email: props.participant.email ?? '',
    phone: props.participant.phone ?? '',
    organization: props.participant.organization ?? '',
    position: props.participant.position ?? '',
})

const submit = () => {
    form.transform((data) => ({
        ...data,
        _method: 'put',
    })).post(`/participants/${props.participant.id}`)
}
</script>

<template>
    <Head title="Edit Participant" />

    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Edit Participant</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">First Name</label>
                        <input v-model="form.first_name" type="text" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.first_name" class="text-red-500 text-sm">{{ form.errors.first_name }}</div>
                    </div>

                    <div>
                        <label class="block mb-1">Last Name</label>
                        <input v-model="form.last_name" type="text" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.last_name" class="text-red-500 text-sm">{{ form.errors.last_name }}</div>
                    </div>
                </div>

                <div>
                    <label class="block mb-1">Email</label>
                    <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
                </div>

                <div>
                    <label class="block mb-1">Phone</label>
                    <input v-model="form.phone" type="text" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</div>
                </div>

                <div>
                    <label class="block mb-1">Organization</label>
                    <input v-model="form.organization" type="text" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.organization" class="text-red-500 text-sm">{{ form.errors.organization }}</div>
                </div>

                <div>
                    <label class="block mb-1">Position</label>
                    <input v-model="form.position" type="text" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.position" class="text-red-500 text-sm">{{ form.errors.position }}</div>
                </div>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                        Update Participant
                    </button>

                    <Link
                        href="/participants"
                        class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
