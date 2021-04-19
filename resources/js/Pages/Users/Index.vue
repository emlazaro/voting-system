<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Users</h2>
        <inertia-link
          class="-my-2 btn btn-success"
          :href="route('users.create')"
        >
          Create User
        </inertia-link>
      </div>
    </template>

    <div class="py-10">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
                    Name
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-xs font-semibold tracking-wider text-center text-gray-500 uppercase"
                  >
                    Status
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                  >
                    Role
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
                  v-for="user in Users"
                  :key="`tr-user-${user.id}`"
                  class="hover:bg-gray-50"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ user.id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <img
                        class="object-contain w-12 h-12 border-2 rounded-full"
                        :src="user.profile_photo_url"
                        :alt="user.name"
                      />
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ user.name }}
                        </div>
                        <div class="text-sm text-gray-500">
                          {{ user.email }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td
                    class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap"
                  >
                    {{ user.status }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                    {{ user.role }}
                  </td>
                  <td class="text-sm text-center">
                    <inertia-link
                      as="button"
                      class="mx-1 text-blue-500 focus:outline-none"
                      :href="route('users.edit', user.id)"
                    >
                      <icon name="edit" class="w-6 h-6" />
                    </inertia-link>
                    <button
                      type="button"
                      class="mx-1 text-red-400 focus:outline-none"
                      @click="handleDelete(user)"
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
    Users: Array,
  },
  data() {
    return {};
  },
  methods: {
    handleDelete(user) {
      if (confirm("Are you sure you want to delete this user?")) {
        this.$inertia.delete(route("users.destroy", user));
      }
    },
  },
};
</script>