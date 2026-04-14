<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    organization: '',
    position: '',
})

const submit = () => {
    form.post(route('participants.store'))
}
</script>

<template>

    <Head title="Create Participant" />

    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Create Participant</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <input v-model="form.first_name" type="text" placeholder="First Name"
                            class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.first_name" class="text-red-600 text-sm">{{ form.errors.first_name }}
                        </div>
                    </div>

                    <div>
                        <input v-model="form.last_name" type="text" placeholder="Last Name"
                            class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.last_name" class="text-red-600 text-sm">{{ form.errors.last_name }}</div>
                    </div>
                </div>

                <input v-model="form.email" type="email" placeholder="Email" class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.email" class="text-red-600 text-sm">{{ form.errors.email }}</div>

                <input v-model="form.phone" type="text" placeholder="Phone" class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.phone" class="text-red-600 text-sm">{{ form.errors.phone }}</div>

                <input v-model="form.organization" type="text" placeholder="Organization"
                    class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.organization" class="text-red-600 text-sm">{{ form.errors.organization }}</div>

                <input v-model="form.position" type="text" placeholder="Position"
                    class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.position" class="text-red-600 text-sm">{{ form.errors.position }}</div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded"
                        :disabled="form.processing">Save</button>
                    <Link :href="route('participants.index')" class="bg-gray-200 px-4 py-2 rounded">Cancel</Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
