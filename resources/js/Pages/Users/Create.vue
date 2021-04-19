<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          <inertia-link class="text-indigo-800" :href="route('users')"
            >Users</inertia-link
          >
          / Create
        </h2>
      </div>
    </template>

    <div>
      <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
          <jet-form-section @submitted="handleSave">
            <template #title> User Information </template>

            <template #description> Create users as Admin Account... </template>

            <template #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.name"
                  autocomplete="name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>

              <!-- Email -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input
                  id="email"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.email"
                  autocomplete="email"
                />
                <jet-input-error :message="form.errors.email" class="mt-2" />
              </div>

              <!-- Password -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="password" value="Password" />
                <jet-input
                  id="password"
                  type="password"
                  class="block w-full mt-1"
                  v-model="form.password"
                  autocomplete="password"
                />
                <jet-input-error :message="form.errors.password" class="mt-2" />
              </div>
              <!-- Password -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label
                  for="password_confirmation"
                  value="Confirm Password"
                />
                <jet-input
                  id="password_confirmation"
                  type="password"
                  class="block w-full mt-1"
                  v-model="form.password_confirmation"
                  autocomplete="password_confirmation"
                />
                <jet-input-error
                  :message="form.errors.password_confirmation"
                  class="mt-2"
                />
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
                Save User
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
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        role: null,
      }),
    };
  },
  methods: {
    handleSave() {
      this.form.post(route("users.store"));
    },
  },
};
</script>