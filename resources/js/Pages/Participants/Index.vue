<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'

defineProps({
    participants: Array,
})

const page = usePage()

const destroyParticipant = (id) => {
    if (confirm('Are you sure you want to delete this participant?')) {
        router.delete(route('participants.destroy', id))
    }
}
</script>

<template>

    <Head title="Participants" />

    <AuthenticatedLayout>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Participants</h1>
                <Link :href="route('participants.create')" class="bg-green-600 text-white px-4 py-2 rounded">Add
                    Participant</Link>
            </div>

            <div v-if="page.props.flash.success" class="mb-4 text-green-600 font-medium">
                {{ page.props.flash.success }}
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Phone</th>
                            <th class="border px-4 py-2">Organization</th>
                            <th class="border px-4 py-2">Position</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="participant in participants" :key="participant.id">
                            <td class="border px-4 py-2">{{ participant.full_name }}</td>
                            <td class="border px-4 py-2">{{ participant.email }}</td>
                            <td class="border px-4 py-2">{{ participant.phone }}</td>
                            <td class="border px-4 py-2">{{ participant.organization }}</td>
                            <td class="border px-4 py-2">{{ participant.position }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <Link :href="route('participants.edit', participant.id)" class="text-blue-600">Edit
                                </Link>
                                <button @click="destroyParticipant(participant.id)" class="text-red-600">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
