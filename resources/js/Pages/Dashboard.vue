<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from "@inertiajs/vue3";

const props = usePage().props;

const changeWorkspace = () => {
    router.post(route("workspaces.switch", {'id':props.auth.workspace.id}));
    // router.reload();
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!

                        <div>
                            Current Workspace: {{ props.auth.workspace.name }}
                        </div>

                        <button
                            @click="changeWorkspace"
                            class="px-4 py-2 mt-4 text-white bg-blue-500 rounded-md"
                        >
                            Change Workspace
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <pre class="dark:text-white">
            {{ props }}
        </pre>
    </AuthenticatedLayout>
</template>
