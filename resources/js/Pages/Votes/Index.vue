<template>
  <div class="h-screen p-4">
    <div
      class="mx-auto max-w-7xl sm:px-6 lg:px-8 py-14"
      v-if="this.$page.props.user.status != 'voted'"
    >
      <div class="flex flex-col items-start justify-between w-full space-y-4">
        <div class="flex justify-center w-full">
          <div class="flex flex-col items-center p-4 md:flex-grow">
            <div
              class="flex items-center justify-center w-full h-10 font-bold text-center text-white bg-red-500 rounded-md"
              v-if="form.errors.ballot"
            >
              {{ form.errors.ballot }}
            </div>
            <div class="mt-5 text-4xl font-bold text-center">
              COOP Election Nominees
            </div>
            <div class="mb-5 text-xl font-bold">{{ today }}</div>
            <div
              class="flex flex-col w-full h-full px-1 overflow-auto border rounded-md shadow-md"
            >
              <!-- Category -->
              <div
                v-for="(category, index) in Categories"
                :key="`category-${category.id}`"
              >
                <div
                  class="flex flex-col items-center py-10 my-1 border bg-gray-50"
                >
                  <div class="text-2xl font-bold">
                    {{ category.name }}
                  </div>
                  <div class="my-2">
                    Max Selection : {{ category.max_selection }}
                  </div>
                  <div
                    v-if="category.max_selection <= 1"
                    class="flex flex-wrap items-center justify-around w-full my-4"
                  >
                    <!-- RADIO BUTTON NOMINEES -->

                    <div
                      class="flex items-center justify-center flex-1"
                      v-for="nominee in category.nominees"
                      :key="`c${category.id}n${nominee.id}`"
                    >
                      <div
                        class="flex items-center justify-center px-1 py-1 pr-4 space-x-3 bg-blue-200 rounded-full hover:shadow"
                      >
                        <img
                          class="z-10 object-cover w-16 h-16 rounded-full"
                          :src="nominee.user.profile_photo_url"
                          :alt="nominee.user.name"
                        />

                        <label
                          :for="`rb-${nominee.id}`"
                          class="font-bold tracking-wide cursor-pointer"
                        >
                          {{ nominee.user.name }}
                        </label>
                        <input
                          :id="`rb-${nominee.id}`"
                          type="radio"
                          v-model="form.ballot[index]"
                          :value="{
                            nominee_id: nominee.id,
                            voter_id: this.$page.props.user.id,
                          }"
                        />
                      </div>
                    </div>

                    <!-- ABTAIN RADIO BUTTONS -->
                    <div class="flex items-center justify-center flex-1">
                      <div
                        class="flex items-center justify-center px-1 py-1 pr-4 space-x-3 bg-blue-100 rounded-full hover:shadow"
                      >
                        <img
                          class="z-10 object-cover w-16 h-16 rounded-full"
                          src="/storage/profile-photos/abstain-vote.png"
                          alt="Abstain vote"
                        />

                        <label
                          :for="`abstain-${category.id}`"
                          class="font-bold tracking-wide cursor-pointer"
                        >
                          Abstain
                        </label>
                        <input
                          :id="`abstain-${category.id}`"
                          type="radio"
                          v-model="form.ballot[index]"
                          :value="{
                            nominee_id: 0,
                            voter_id: this.$page.props.user.id,
                          }"
                        />
                      </div>
                    </div>
                  </div>
                  <div
                    v-else
                    class="flex flex-wrap items-center justify-around w-full my-4"
                  >
                    <!-- CHECKBOX NOMINEES -->
                    <div
                      class="flex items-center justify-center flex-1"
                      v-for="nominee in category.nominees"
                      :key="`c${category.id}n${nominee.id}`"
                    >
                      <div
                        class="flex items-center justify-center px-1 py-1 pr-4 space-x-3 bg-blue-200 rounded-full hover:shadow"
                      >
                        <img
                          class="z-10 object-cover w-16 h-16 rounded-full"
                          :src="nominee.user.profile_photo_url"
                          :alt="nominee.user.name"
                        />

                        <label
                          :for="`cb-${nominee.id}`"
                          class="font-bold tracking-wide cursor-pointer"
                        >
                          {{ nominee.user.name }}
                        </label>
                        <input
                          :id="`cb-${nominee.id}`"
                          type="checkbox"
                          v-model="form.ballot"
                          :value="{
                            nominee_id: nominee.id,
                            voter_id: this.$page.props.user.id,
                          }"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-center w-full space-x-2">
          <inertia-link class="btn btn-text-error" :href="route('dashboard')"
            >Back
          </inertia-link>
          <button
            :class="
              form.length != form.ballot.length
                ? 'btn bg-gray-100 cursor-not-allowed'
                : 'btn btn-success cursor-pointer'
            "
            @click="handleSubmitVote"
            :disabled="form.length != form.ballot.length"
          >
            <span> Submit Vote </span>
          </button>
        </div>
      </div>
    </div>
    <!-- VOTE SUBMITTED MESSAGE -->
    <div v-else class="flex flex-col items-center w-full h-full space-y-3">
      <div
        class="flex flex-col items-center justify-center flex-grow w-full px-10 space-y-5 text-center md:w-1/2"
      >
        <p class="text-4xl md:text-5xl">
          Thank You
          <br />for participating <br />the <br />
          Online Election 2021!!!
        </p>
        <p class="text-2xl leading-loose md:text-2xl">
          Results will be available on your dashboard after the election...
        </p>
        <inertia-link
          class="flex items-center space-x-2 btn btn-text-error"
          :href="route('dashboard')"
        >
          <icon name="back" class="w-6 h-6 mt-1" />
          <span>Back To Dashboard</span>
        </inertia-link>
      </div>
    </div>
  </div>
</template>
<script>
import Icon from "@/Shared/Icon";

export default {
  components: {
    Icon,
  },
  props: {
    Categories: Array,
  },
  data() {
    return {
      today: new Date().toLocaleDateString(),
      form: this.$inertia.form({
        voter_id: this.$page.props.user.id,
        length: this.Categories.length,
        ballot: [],
      }),
    };
  },
  methods: {
    handleDelete(user) {
      if (confirm("Are you sure you want to delete this user?")) {
        this.$inertia.delete(route("users.destroy", user));
      }
    },
    handleSubmitVote() {
      console.log(this.form.ballot);
      this.form.post("/votes");
      // this.$inertia.visit("/votes", {
      //   data: this.ballot,
      //   method: "post",
      // });
    },
  },
};
</script>