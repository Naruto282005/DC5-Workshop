<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    title: '',
    description: '',
    speaker: '',
    venue: '',
    event_date: '',
    start_time: '',
    end_time: '',
    capacity: 30,
    status: 'Open',
})

const submit = () => {
    form.post(route('workshops.store'))
}
</script>

<template>

    <Head title="Create Workshop" />

    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Create Workshop</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <input v-model="form.title" type="text" placeholder="Title" class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.title" class="text-red-600 text-sm">{{ form.errors.title }}</div>

                <textarea v-model="form.description" placeholder="Description"
                    class="w-full border rounded px-3 py-2"></textarea>
                <div v-if="form.errors.description" class="text-red-600 text-sm">{{ form.errors.description }}</div>

                <input v-model="form.speaker" type="text" placeholder="Speaker"
                    class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.speaker" class="text-red-600 text-sm">{{ form.errors.speaker }}</div>

                <input v-model="form.venue" type="text" placeholder="Venue" class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.venue" class="text-red-600 text-sm">{{ form.errors.venue }}</div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Event Date</label>
                        <input v-model="form.event_date" type="date" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.event_date" class="text-red-600 text-sm">{{ form.errors.event_date }}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1">Capacity</label>
                        <input v-model="form.capacity" type="number" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.capacity" class="text-red-600 text-sm">{{ form.errors.capacity }}</div>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Start Time</label>
                        <input v-model="form.start_time" type="time" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.start_time" class="text-red-600 text-sm">{{ form.errors.start_time }}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1">End Time</label>
                        <input v-model="form.end_time" type="time" class="w-full border rounded px-3 py-2" />
                        <div v-if="form.errors.end_time" class="text-red-600 text-sm">{{ form.errors.end_time }}</div>
                    </div>
                </div>

                <select v-model="form.status" class="w-full border rounded px-3 py-2">
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                    <option value="Completed">Completed</option>
                </select>
                <div v-if="form.errors.status" class="text-red-600 text-sm">{{ form.errors.status }}</div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded" :disabled="form.processing">
                        Save
                    </button>
                    <Link :href="route('workshops.index')" class="bg-gray-200 px-4 py-2 rounded">Cancel</Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
