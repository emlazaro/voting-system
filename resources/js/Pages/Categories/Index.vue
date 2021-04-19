<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Category
        </h2>
        <inertia-link
          class="-my-2 btn btn-success"
          :href="route('categories.create')"
        >
          Create Category
        </inertia-link>
      </div>
    </template>

    <div class="py-10">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col items-start justify-between w-full space-y-4">
          <div
            class="flex flex-col items-start justify-between w-full p-4 space-y-4 md:p-0"
          >
            <!-- TABLE -->
            <div class="w-full mt-4 overflow-y-auto rounded-md shadow">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Id
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Title
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Nominees
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-center text-gray-500 uppercase"
                    >
                      Max Selection
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-center text-gray-500 uppercase"
                    >
                      Total Votes
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Created At
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-center text-gray-500 uppercase"
                    >
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr
                    v-for="category in Categories"
                    :key="`tr-catergory-${category.id}`"
                    class="hover:bg-gray-50"
                  >
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ category.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ category.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <ul>
                        <li
                          v-for="nominee in category.nominees"
                          :key="`c${category.id}-n${nominee.id}`"
                        >
                          {{ nominee.name }}
                        </li>
                      </ul>
                    </td>
                    <td class="px-6 py-4 text-center">
                      {{ category.max_selection }}
                    </td>
                    <td class="px-6 py-4 text-center">
                      {{ category.votes.length }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ category.created_at }}
                    </td>
                    <td class="text-sm text-center">
                      <inertia-link
                        as="button"
                        class="mx-1 text-blue-500 focus:outline-none"
                        :href="route('categories.edit', category.id)"
                      >
                        <icon name="edit" class="w-6 h-6" />
                      </inertia-link>
                      <button
                        type="button"
                        class="mx-1 text-red-400 focus:outline-none"
                        @click="handleDelete(category)"
                      >
                        <icon name="delete" class="w-6 h-6" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";
export default {
  components: {
    AppLayout,
    Icon,
  },
  props: {
    Categories: Array,
  },
  data() {
    return {};
  },
  methods: {
    handleDelete(category) {
      if (confirm("Are you sure you want to delete this category?")) {
        this.$inertia.delete(route("categories.destroy", category));
      }
    },
  },
};
</script>