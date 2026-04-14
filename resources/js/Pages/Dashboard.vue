<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'

const props = defineProps({
    stats: Object,
})

const apiWorkshops = ref([])

onMounted(async () => {
    try {
        const response = await axios.get('/api/workshops')
        apiWorkshops.value = response.data.data
    } catch (error) {
        console.error('API error:', error)
    }
})
</script>

<template>

    <Head>
        <title>Dashboard</title>
        <meta name="description" content="Dashboard of Workshop Registration System" />
    </Head>

    <AuthenticatedLayout>
        <div class="space-y-8">
            <div>
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <p class="text-gray-600">Manage your workshops, participants, and registrations here.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Workshops</h2>
                    <p class="text-3xl font-bold mt-2">{{ props.stats.workshops }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Participants</h2>
                    <p class="text-3xl font-bold mt-2">{{ props.stats.participants }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold">Registrations</h2>
                    <p class="text-3xl font-bold mt-2">{{ props.stats.registrations }}</p>
                </div>
            </div>

            <div class="flex gap-4 flex-wrap">
                <Link :href="route('workshops.index')" class="bg-blue-600 text-white px-4 py-2 rounded">Manage Workshops
                </Link>
                <Link :href="route('participants.index')" class="bg-green-600 text-white px-4 py-2 rounded">Manage
                    Participants</Link>
                <Link :href="route('registrations.index')" class="bg-purple-600 text-white px-4 py-2 rounded">Manage
                    Registrations</Link>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Workshop List from Public API (Axios)</h2>
                <ul class="space-y-2">
                    <li v-for="workshop in apiWorkshops" :key="workshop.id" class="border-b pb-2">
                        <strong>{{ workshop.title }}</strong> - {{ workshop.speaker }} - {{ workshop.event_date }}
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
