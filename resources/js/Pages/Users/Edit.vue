<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <inertia-link class="text-indigo-800" :href="route('users')"
          >Users</inertia-link
        >
        / {{ editUser.name }} / Edit
      </h2>
    </template>

    <div>
      <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
          <jet-form-section @submitted="handleUpdate">
            <template #title> User Information </template>

            <template #description>
              This is where you update a user information...
            </template>

            <template #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Full Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.name"
                  autocomplete="user.name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>
              <!-- Role -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="role" value="Role" />
                <jet-select
                  id="role"
                  class="block w-full mt-1"
                  v-model="form.role"
                  autocomplete="role"
                  :items="roles"
                />
                <jet-input-error :message="form.errors.role" class="mt-2" />
              </div>
            </template>

            <template #actions>
              <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
              </jet-action-message> -->
              <jet-button
                class="btn btn-success"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Update User
              </jet-button>
            </template>
          </jet-form-section>
          <jet-section-border />
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSelect from "@/Jetstream/Select";

export default {
  components: {
    AppLayout,
    JetSectionBorder,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSelect,
  },
  props: {
    editUser: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: this.editUser.id,
        name: this.editUser.name,
        role: this.editUser.role,
      }),
      roles: [
        { id: "admin", name: "admin" },
        { id: "user", name: "user" },
      ],
    };
  },
  methods: {
    handleUpdate() {
      this.form.put(route("users.update", this.editUser));
    },
  },
};
</script>