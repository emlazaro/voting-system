<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <inertia-link class="text-indigo-800" :href="route('nominees')"
          >Nominees</inertia-link
        >
        / Create
      </h2>
    </template>

    <div>
      <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
          <jet-form-section @submitted="handleSave" class="flex flex-col px-4">
            <template #title> Nominee Information </template>

            <template #description>
              Nominate existing user account to a Category...
            </template>

            <template #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="user_id" value="Name" />
                <jet-select
                  id="user_id"
                  class="block w-full mt-1"
                  v-model="form.user_id"
                  autocomplete="user_id"
                  :items="Users"
                />
                <jet-input-error :message="form.errors.user_id" class="mt-2" />
              </div>

              <!-- Category -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="category_id" value="Category" />
                <jet-select
                  id="category_id"
                  class="block w-full mt-1"
                  v-model="form.category_id"
                  autocomplete="category_id"
                  :items="Categories"
                />
                <jet-input-error
                  :message="form.errors.category_id"
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
    Users: Array,
    Categories: Array,
  },
  data() {
    return {
      form: this.$inertia.form({
        user_id: null,
        category_id: null,
      }),
    };
  },
  methods: {
    handleSave() {
      this.form.post(route("nominees.store"));
    },
  },
};
</script>