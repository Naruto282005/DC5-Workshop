<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'

defineProps({
    registrations: Array,
})

const page = usePage()

const destroyRegistration = (id) => {
    if (confirm('Are you sure you want to delete this registration?')) {
        router.delete(route('registrations.destroy', id))
    }
}
</script>

<template>

    <Head title="Registrations" />

    <AuthenticatedLayout>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Registrations</h1>
                <Link :href="route('registrations.create')" class="bg-purple-600 text-white px-4 py-2 rounded">Add
                    Registration</Link>
            </div>

            <div v-if="page.props.flash.success" class="mb-4 text-green-600 font-medium">
                {{ page.props.flash.success }}
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Workshop</th>
                            <th class="border px-4 py-2">Participant</th>
                            <th class="border px-4 py-2">Registration Date</th>
                            <th class="border px-4 py-2">Payment Status</th>
                            <th class="border px-4 py-2">Attendance Status</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="registration in registrations" :key="registration.id">
                            <td class="border px-4 py-2">{{ registration.workshop?.title }}</td>
                            <td class="border px-4 py-2">{{ registration.participant?.first_name }} {{
                                registration.participant?.last_name }}</td>
                            <td class="border px-4 py-2">{{ registration.registration_date }}</td>
                            <td class="border px-4 py-2">{{ registration.payment_status }}</td>
                            <td class="border px-4 py-2">{{ registration.attendance_status }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <Link :href="route('registrations.edit', registration.id)" class="text-blue-600">Edit
                                </Link>
                                <button @click="destroyRegistration(registration.id)"
                                    class="text-red-600">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
