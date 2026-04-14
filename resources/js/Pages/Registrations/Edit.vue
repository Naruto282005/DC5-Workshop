<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    registration: Object,
    workshops: Array,
    participants: Array,
})

const form = useForm({
    workshop_id: props.registration.workshop_id,
    participant_id: props.registration.participant_id,
    registration_date: props.registration.registration_date,
    payment_status: props.registration.payment_status,
    attendance_status: props.registration.attendance_status,
    notes: props.registration.notes ?? '',
})

const submit = () => {
    form.put(route('registrations.update', props.registration.id))
}
</script>

<template>

    <Head title="Edit Registration" />

    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Edit Registration</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block mb-1">Workshop</label>
                    <select v-model="form.workshop_id" class="w-full border rounded px-3 py-2">
                        <option value="">Select Workshop</option>
                        <option v-for="workshop in workshops" :key="workshop.id" :value="workshop.id">
                            {{ workshop.title }}
                        </option>
                    </select>
                    <div v-if="form.errors.workshop_id" class="text-red-600 text-sm">{{ form.errors.workshop_id }}</div>
                </div>

                <div>
                    <label class="block mb-1">Participant</label>
                    <select v-model="form.participant_id" class="w-full border rounded px-3 py-2">
                        <option value="">Select Participant</option>
                        <option v-for="participant in participants" :key="participant.id" :value="participant.id">
                            {{ participant.first_name }} {{ participant.last_name }}
                        </option>
                    </select>
                    <div v-if="form.errors.participant_id" class="text-red-600 text-sm">{{ form.errors.participant_id }}
                    </div>
                </div>

                <div>
                    <label class="block mb-1">Registration Date</label>
                    <input v-model="form.registration_date" type="date" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.registration_date" class="text-red-600 text-sm">{{
                        form.errors.registration_date }}</div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Payment Status</label>
                        <select v-model="form.payment_status" class="w-full border rounded px-3 py-2">
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1">Attendance Status</label>
                        <select v-model="form.attendance_status" class="w-full border rounded px-3 py-2">
                            <option value="Registered">Registered</option>
                            <option value="Attended">Attended</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </div>
                </div>

                <textarea v-model="form.notes" placeholder="Notes" class="w-full border rounded px-3 py-2"></textarea>

                <div class="flex gap-3">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded"
                        :disabled="form.processing">Update</button>
                    <Link :href="route('registrations.index')" class="bg-gray-200 px-4 py-2 rounded">Cancel</Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
