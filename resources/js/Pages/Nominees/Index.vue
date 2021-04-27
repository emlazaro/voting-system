<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Nominees
        </h2>
        <inertia-link
          class="-my-2 btn btn-success"
          :href="route('nominees.create')"
        >
          Create Nominee
        </inertia-link>
      </div>
    </template>

    <div class="py-5">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- FLASH ALERT -->
        <div
          v-if="this.$page.props.success || this.$page.props.error"
          :class="this.$page.props.success ? `bg-green-500` : `bg-red-500`"
          class="flex items-center justify-between px-4 py-2 mb-5 font-semibold text-white rounded-md"
        >
          {{ this.$page.props.success }}
          <button
            class="focus:outline-none hover:text-gray-500"
            type="button"
            @click="this.$page.props.success = null"
          >
            <icon name="close" />
          </button>
        </div>
        <div class="flex flex-col items-start justify-between w-full space-y-4">
          <div
            class="flex flex-col items-start justify-between w-full p-4 space-y-4 md:p-0"
          >
            <!-- TABLE -->
            <div class="w-full overflow-y-auto rounded-md shadow">
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
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Category
                    </th>
                    <th
                      v-if="this.$page.props.user.role === 'admin'"
                      scope="col"
                      class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase"
                    >
                      Votes
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
                    v-for="nominee in Nominees"
                    :key="`tr-nominee-${nominee.id}`"
                    class="hover:bg-gray-50"
                  >
                    <td class="px-6 py-4 whitespace-nowrap">
                      {{ nominee.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <img
                          class="object-contain w-12 h-12 border-2 rounded-full"
                          :src="nominee.user.profile_photo_url"
                          :alt="nominee.user.name"
                        />
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ nominee.user.name }}
                          </div>
                          <div class="text-sm text-gray-500">
                            {{ nominee.user.email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                      >
                        {{ nominee.category.name }}
                      </span>
                    </td>
                    <td
                      v-if="this.$page.props.user.role === 'admin'"
                      class="px-6 py-4 whitespace-nowrap"
                    >
                      <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800"
                      >
                        {{ nominee.votes.length }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800"
                      >
                        {{ nominee.created_at }}
                      </span>
                    </td>
                    <td class="text-sm text-center">
                      <!-- <inertia-link
                        as="button"
                        class="mx-1 text-blue-500 focus:outline-none"
                        :href="route('nominees.edit', nominee.id)"
                      >
                        <icon name="edit" class="w-6 h-6" />
                      </inertia-link> -->
                      <button
                        type="button"
                        class="mx-1 text-red-400 focus:outline-none"
                        @click="handleDelete(nominee)"
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
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
    Icon,
    Swal,
  },
  props: {
    Nominees: Array,
  },
  data() {
    return {};
  },
  methods: {
    handleDelete(nominee) {
      Swal.fire({
        title: "Are you sure you want to delete this nominee??",
        text: "You cannot change undo this action...",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete nominee",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.delete(route("nominees.destroy", nominee));
        }
      });
    },
  },
};
</script>