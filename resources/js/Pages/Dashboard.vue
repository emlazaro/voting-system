<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <div class="py-5">
            <div
                class="flex flex-col mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8"
            >
                <div class="text-3xl font-semibold text-center">
                    Welcome to POEA - COOP ELECTION 2021!
                </div>
                <!-- MAIN CONTENT -->
                <div
                    class="flex flex-col flex-wrap items-start justify-between w-full p-4 space-y-3 md:flex-nowrap md:p-0 md:flex-row md:space-x-4 md:space-y-0"
                >
                    <div class="w-full p-4 bg-white rounded shadow">
                        <div class="mb-2">Registered Voters</div>
                        <hr />
                        <div class="text-2xl font-semibold">
                            {{ Users.length }}
                        </div>
                    </div>
                    <div class="w-full p-4 bg-white rounded shadow">
                        <div class="mb-2">Voted</div>
                        <hr />
                        <div class="text-2xl font-semibold">{{ Votes }}</div>
                    </div>
                    <div class="w-full p-4 bg-white rounded shadow">
                        <div class="mb-2">Categories</div>
                        <hr />
                        <div class="text-2xl font-semibold">
                            {{ Categories.length }}
                        </div>
                    </div>
                    <div class="w-full p-4 bg-white rounded shadow">
                        <div class="mb-2">Nominees</div>
                        <hr />
                        <div class="text-2xl font-semibold">
                            {{ Nominees.length }}
                        </div>
                    </div>
                </div>
                <!-- RESULTS OVERVIEW -->
                <div
                    v-if="this.$page.props.user.role === 'admin'"
                    class="flex flex-col items-center justify-center w-full p-4 space-y-6 md:p-0"
                >
                    <div class="flex items-center justify-between w-full">
                        <div class="text-2xl font-semibold">
                            Election Update
                            <span class="text-xs">
                                as of {{ today }} today...</span
                            >
                        </div>
                        <div>
                            <inertia-link
                                class="text-sm shadow btn btn-outline-primary"
                                as="button"
                                :href="route('results')"
                            >
                                Download Results
                            </inertia-link>
                        </div>
                    </div>
                    <!-- <div class="w-full p-4 bg-white rounded shadow-md">Table</div> -->
                    <!-- TABLE -->
                    <div class="w-full mt-4 overflow-y-auto rounded-md shadow">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                                    >
                                        Category
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                                    >
                                        Candidates
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-xs font-semibold tracking-wider text-center text-gray-500 uppercase"
                                    >
                                        Votes
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="category in Categories"
                                    :key="`result-${category.id}`"
                                    class="hover:bg-gray-50"
                                >
                                    <td
                                        class="px-6 py-4 text-sm text-left text-gray-500 whitespace-nowrap"
                                    >
                                        {{ category.name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-left text-gray-500 whitespace-nowrap"
                                    >
                                        <ul>
                                            <li
                                                v-for="nominee in category.nominees"
                                                :key="`nominee-${nominee.id}`"
                                            >
                                                {{ nominee.user.name }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap"
                                    >
                                        <ul>
                                            <li
                                                v-for="nominee in category.nominees"
                                                :key="`votes-${nominee.id}`"
                                            >
                                                {{ nominee.votes.length }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import Icon from "../Shared/Icon.vue";

export default {
    components: {
        AppLayout,
        Welcome,
        Icon,
    },
    props: {
        Users: Array,
        Votes: Number,
        Categories: Array,
        Nominees: Array,
    },
    data() {
        return {
            today: new Date().toLocaleString("en-US", {
                hour: "numeric",
                minute: "numeric",
                hour12: true,
            }),
        };
    },
};
</script>
<style scoped>
.btn {
    @apply px-4 py-2 font-semibold tracking-wide rounded focus:outline-none focus:ring-4;
}

.btn-outline-primary {
    @apply text-blue-500 border border-blue-500 hover:bg-blue-500 hover:text-white focus:ring-blue-300;
}
</style>
