<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
    stats: Object,
})

const workshopsFromApi = ref([])
const loading = ref(true)
const error = ref('')

onMounted(async () => {
    try {
        const response = await axios.get('/api/workshops')
        workshopsFromApi.value = response.data
    } catch (err) {
        console.error('API error:', err)
        error.value = 'Failed to load workshops from API.'
    } finally {
        loading.value = false
    }
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="p-6 bg-gray-100 min-h-screen">
            <h1 class="text-4xl font-bold text-black">Dashboard</h1>
            <p class="text-gray-700 mt-2 mb-8">
                Manage your workshops, participants, and registrations here.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-2xl font-semibold mb-2">Workshops</h2>
                    <p class="text-4xl font-bold">{{ props.stats.workshops }}</p>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-2xl font-semibold mb-2">Participants</h2>
                    <p class="text-4xl font-bold">{{ props.stats.participants }}</p>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-2xl font-semibold mb-2">Registrations</h2>
                    <p class="text-4xl font-bold">{{ props.stats.registrations }}</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-4 mb-8">
                <Link href="/workshops"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                    Manage Workshops
                </Link>

                <Link href="/participants"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold">
                    Manage Participants
                </Link>

                <Link href="/registrations"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold">
                    Manage Registrations
                </Link>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-3xl font-bold mb-4">Workshop List</h2>

                <div v-if="loading" class="text-gray-500">
                    Loading workshops...
                </div>

                <div v-else-if="error" class="text-red-600 font-semibold">
                    {{ error }}
                </div>

                <div v-else-if="workshopsFromApi.length === 0" class="text-gray-500">
                    No workshops found.
                </div>

                <div v-else class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border text-left">Title</th>
                                <th class="px-4 py-2 border text-left">Speaker</th>
                                <th class="px-4 py-2 border text-left">Venue</th>
                                <th class="px-4 py-2 border text-left">Date</th>
                                <th class="px-4 py-2 border text-left">Start Time</th>
                                <th class="px-4 py-2 border text-left">End Time</th>
                                <th class="px-4 py-2 border text-left">Capacity</th>
                                <th class="px-4 py-2 border text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="workshop in workshopsFromApi" :key="workshop.id" class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ workshop.title }}</td>
                                <td class="px-4 py-2 border">{{ workshop.speaker }}</td>
                                <td class="px-4 py-2 border">{{ workshop.venue }}</td>
                                <td class="px-4 py-2 border">{{ workshop.date }}</td>
                                <td class="px-4 py-2 border">{{ workshop.start_time }}</td>
                                <td class="px-4 py-2 border">{{ workshop.end_time }}</td>
                                <td class="px-4 py-2 border">{{ workshop.capacity }}</td>
                                <td class="px-4 py-2 border">{{ workshop.status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
