<script setup>
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>

    <Head>
        <title>Workshop Registration System</title>
        <meta name="description"
            content="Register participants and manage workshops easily using the Workshop Registration System." />
        <meta name="keywords" content="workshop registration, laravel inertia, event participants, workshop system" />
    </Head>

    <div class="min-h-screen bg-gradient-to-br from-blue-100 to-white flex items-center justify-center px-6">
        <div class="max-w-4xl w-full bg-white shadow-lg rounded-xl p-10">
            <h1 class="text-4xl font-bold text-blue-800 mb-4">Workshop Registration System</h1>
            <p class="text-gray-700 mb-6">
                A simple system to register participants and manage workshops, schedules, and attendance records.
            </p>

            <div class="flex gap-4">
                <Link :href="route('login')" class="bg-blue-600 text-white px-5 py-2 rounded">Login</Link>
                <Link :href="route('register')" class="bg-gray-200 px-5 py-2 rounded">Register</Link>
            </div>
        </div>
    </div>
</template>
