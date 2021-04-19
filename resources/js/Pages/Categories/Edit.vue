<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        <inertia-link class="text-indigo-800" :href="route('categories')"
          >Category</inertia-link
        >
        / {{ editCategory.name }} / Edit
      </h2>
    </template>

    <div>
      <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
          <jet-form-section @submitted="handleUpdate">
            <template #title> Category Information </template>

            <template #description>
              This is where you update a category...
            </template>

            <template #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Category Name" />
                <jet-input
                  id="name"
                  type="text"
                  class="block w-full mt-1"
                  v-model="form.name"
                  autocomplete="category.name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>
              <!-- Max Selection -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="max_selection" value="Max Selection" />
                <jet-select
                  id="max_selection"
                  class="block w-full mt-1"
                  v-model="form.max_selection"
                  autocomplete="max_selection"
                  :items="Max_Selection"
                />
                <jet-input-error
                  :message="form.errors.max_selection"
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
                Update Category
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
    editCategory: Object,
  },
  data() {
    return {
      Max_Selection: [
        { id: 1, name: "1" },
        { id: 2, name: "2" },
        { id: 3, name: "3" },
        { id: 4, name: "4" },
      ],
      form: this.$inertia.form({
        id: this.editCategory.id,
        name: this.editCategory.name,
        max_selection: this.editCategory.max_selection,
      }),
    };
  },
  methods: {
    handleUpdate() {
      this.form.put(route("categories.update", this.form));
    },
  },
};
</script>