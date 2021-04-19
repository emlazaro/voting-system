<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <div class="py-10">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="flex flex-col flex-wrap items-start justify-between w-full p-4 space-y-3 md:flex-nowrap md:p-0 md:flex-row md:space-x-4 md:space-y-0"
        >
          <div class="w-full p-4 bg-white rounded shadow">
            <div class="mb-2">Voters</div>
            <hr />
            <div class="text-xl font-semibold">{{ Users.length }}</div>
          </div>
          <div class="w-full p-4 bg-white rounded shadow">
            <div class="mb-2">Voted</div>
            <hr />
            <div class="text-xl font-semibold">{{ Votes }}</div>
          </div>
          <div class="w-full p-4 bg-white rounded shadow">
            <div class="mb-2">Categories</div>
            <hr />
            <div class="text-xl font-semibold">{{ Categories.length }}</div>
          </div>
          <div class="w-full p-4 bg-white rounded shadow">
            <div class="mb-2">Nominees</div>
            <hr />
            <div class="text-xl font-semibold">{{ Nominees.length }}</div>
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
    Votes: Array,
    Categories: Array,
    Nominees: Array,
  },
  data() {
    return {
      today: new Date().toLocaleDateString(),
    };
  },
};
</script>
