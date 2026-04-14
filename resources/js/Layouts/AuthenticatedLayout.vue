<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth?.user)
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-6">
                        <Link :href="route('dashboard')" class="font-bold text-lg text-blue-700">
                            Workshop Registration System
                        </Link>

                        <div class="flex gap-4 text-sm">
                            <Link :href="route('workshops.index')">Workshops</Link>
                            <Link :href="route('participants.index')">Participants</Link>
                            <Link :href="route('registrations.index')">Registrations</Link>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 text-sm">
                        <span v-if="user">{{ user.name }}</span>
                        <Link :href="route('profile.edit')">Profile</Link>
                        <Link :href="route('logout')" method="post" as="button">Logout</Link>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            <slot />
        </main>
    </div>
</template>
