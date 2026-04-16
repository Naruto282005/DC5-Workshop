<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'

defineProps({
    workshops: Array,
})

const destroyWorkshop = (id) => {
    if (confirm('Are you sure you want to delete this workshop?')) {
        router.delete(route('workshops.destroy', id))
    }
}
</script>

<template>
    <Head title="Workshops" />

    <AuthenticatedLayout>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Workshops</h1>

                <Link :href="route('workshops.create')" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Add Workshop
                </Link>
            </div>

            <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 text-green-600 font-medium">
                {{ $page.props.flash.success }}
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Title</th>
                            <th class="border px-4 py-2">Speaker</th>
                            <th class="border px-4 py-2">Venue</th>
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Capacity</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="workshop in workshops" :key="workshop.id">
                            <td class="border px-4 py-2">{{ workshop.title }}</td>
                            <td class="border px-4 py-2">{{ workshop.speaker }}</td>
                            <td class="border px-4 py-2">{{ workshop.venue }}</td>
                            <td class="border px-4 py-2">{{ workshop.event_date }}</td>
                            <td class="border px-4 py-2">{{ workshop.capacity }}</td>
                            <td class="border px-4 py-2">{{ workshop.status }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <Link :href="route('workshops.edit', workshop.id)" class="text-blue-600">
                                    Edit
                                </Link>

                                <button
                                    type="button"
                                    @click="destroyWorkshop(workshop.id)"
                                    class="text-red-600"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
