<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'

defineProps({
    participants: {
        type: Array,
        default: () => [],
    },
})

const destroyParticipant = (id) => {
    if (confirm('Are you sure you want to delete this participant?')) {
        router.delete(`/participants/${id}`, {
            preserveScroll: true,
            preserveState: false,
        })
    }
}
</script>

<template>
    <Head title="Participants" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Participants
            </h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Participants</h1>

                        <Link
                            href="/participants/create"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Add Participant
                        </Link>
                    </div>

                    <div v-if="participants.length" class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left border-b">First Name</th>
                                    <th class="px-4 py-3 text-left border-b">Last Name</th>
                                    <th class="px-4 py-3 text-left border-b">Email</th>
                                    <th class="px-4 py-3 text-left border-b">Phone</th>
                                    <th class="px-4 py-3 text-left border-b">Organization</th>
                                    <th class="px-4 py-3 text-left border-b">Position</th>
                                    <th class="px-4 py-3 text-center border-b">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="participant in participants"
                                    :key="participant.id"
                                    class="hover:bg-gray-50"
                                >
                                    <td class="px-4 py-3 border-b">{{ participant.first_name }}</td>
                                    <td class="px-4 py-3 border-b">{{ participant.last_name }}</td>
                                    <td class="px-4 py-3 border-b">{{ participant.email }}</td>
                                    <td class="px-4 py-3 border-b">{{ participant.phone }}</td>
                                    <td class="px-4 py-3 border-b">{{ participant.organization }}</td>
                                    <td class="px-4 py-3 border-b">{{ participant.position }}</td>
                                    <td class="px-4 py-3 border-b text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <Link
                                                :href="`/participants/${participant.id}/edit`"
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                            >
                                                Edit
                                            </Link>

                                            <button
                                                type="button"
                                                @click="destroyParticipant(participant.id)"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-else class="text-center py-10 text-gray-500">
                        No participants found.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
