<template>
    <div class="flex flex-col max-w-5xl min-h-screen mx-auto sm:px-6 lg:px-8">
        <div class="p-5">
            <div id="header-result" class="flex items-center space-x-3">
                <img
                    class="object-cover w-16 h-16 bg-gray-300 rounded-full"
                    src="/storage/resources/pempco_logo.jfif"
                />
                <div class="flex flex-col -space-y-1">
                    <span class="italic font-bold">POEA</span>
                    <span class="italic font-bold">Employees</span>
                    <span class="italic font-bold">Multi-purpose</span>
                    <span class="italic font-bold">Cooperative, Inc.</span>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mt-10 text-3xl font-bold text-red-500">
                    PEMCO ELECTION OF OFFICES 2021
                </div>
                <div class="text-lg font-bold text-red-500">
                    Official Result
                </div>
                <div class="w-full px-10 mt-8">
                    <ul>
                        <li
                            class="my-4"
                            v-for="(category, index) in Categories"
                            :key="`cat-${index}`"
                        >
                            <div
                                class="text-xl font-bold tracking-wide underline"
                            >
                                {{ category.name }}
                            </div>
                            <ul class="mt-2 ml-5">
                                <li
                                    class="flex justify-between"
                                    v-for="(
                                        nominee, index
                                    ) in category.nominees"
                                    :key="`nom-${index}`"
                                >
                                    <span
                                        :class="
                                            nominee.votes.length > 0
                                                ? `font-bold text-lg`
                                                : ``
                                        "
                                        >{{ nominee.user.name }}</span
                                    >
                                    <span
                                        :class="
                                            nominee.votes.length > 0
                                                ? `font-bold text-lg`
                                                : ``
                                        "
                                        >{{ nominee.votes.length }}</span
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col w-full px-5 mt-10 space-y-8">
                    <div class="font-bold uppercase">
                        PEMPCO ELECTION COMMITTEE
                    </div>
                    <div class="flex justify-between">
                        <div
                            v-for="(member, index) in committee"
                            :key="`mc-${index}`"
                        >
                            <div class="font-semibold uppercase text-md">
                                {{ member.name }}
                            </div>
                            <div class="">{{ member.position }}</div>
                        </div>
                    </div>
                </div>
                <div
                    id="print-only"
                    class="fixed grid grid-cols-2 text-xs divide-x-2 divide-gray-500 mt-28 bottom-10"
                >
                    <div class="flex flex-col text-right">
                        <div class="italic font-bold uppercase">
                            Services Offered:
                        </div>
                        <div class="italic font-semibold">
                            Canteen, Catering
                        </div>
                        <div class="italic font-semibold">
                            Credit, Photocopying
                        </div>
                        <div class="italic font-semibold">
                            e-loading and Other
                        </div>
                        <div class="italic font-semibold">services</div>
                    </div>
                    <div class="flex flex-col ml-2 text-left">
                        <div class="italic font-bold uppercase">
                            Lower Ground Floor
                        </div>
                        <div class="italic font-semibold">
                            POEA Bldg., Ortigas Ave.
                        </div>
                        <div class="italic font-semibold">
                            cor. EDSA, Mandaluyong City
                        </div>
                        <div class="italic font-semibold">
                            Telephone: 724-3635
                        </div>
                        <div class="italic font-semibold">
                            Telefax: 725-3841 / 725-0210
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        Categories: Array,
    },
    data() {
        return {
            committee: [
                {
                    id: 1,
                    name: "Ricardo C. Capin",
                    position: "Chairman",
                },
                {
                    id: 2,
                    name: "Maihler D. Consulta",
                    position: "Member",
                },
                {
                    id: 3,
                    name: "Ruth R. Reyes",
                    position: "Member",
                },
            ],
        };
    },
};
</script>
