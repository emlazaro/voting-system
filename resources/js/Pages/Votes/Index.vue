<template>
  <div class="py-10">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex flex-col items-start justify-between w-full space-y-4">
        <div class="flex justify-center w-full">
          <div
            v-if="this.$page.props.user.status != 'voted'"
            class="flex flex-col items-center p-4 md:flex-grow"
          >
            <div class="mt-5 text-4xl font-bold text-center">
              COOP Election Nominees
            </div>
            <div class="mb-5 text-xl font-bold">{{ today }}</div>
            <div
              class="flex flex-col w-full h-full space-y-3 overflow-auto border rounded-md shadow-md"
            >
              <!-- Category -->
              <div
                class="flex flex-col items-center py-10 bg-gray-50"
                v-for="category in Categories"
                :key="`category-${category.id}`"
              >
                <div class="text-2xl font-bold">
                  {{ category.name }}
                </div>
                <div class="my-2">
                  Max Selection : {{ category.max_selection }}
                </div>
                <div
                  class="flex flex-wrap items-center justify-around w-full my-4"
                >
                  <div
                    class="flex items-center justify-center flex-1 px-2 py-2 -space-x-2"
                    v-for="nominee in category.nominees"
                    :key="`c${category.id}n${nominee.id}`"
                  >
                    <img
                      class="z-10 object-cover w-16 h-16 border-2 border-gray-200 rounded-full"
                      :src="nominee.user.profile_photo_url"
                      :alt="nominee.user.name"
                    />
                    <div
                      class="px-4 py-2 truncate bg-gray-200 rounded-r-full hover:bg-gray-300 focus:outline-none"
                    >
                      {{ nominee.user.name }}

                      <input
                        v-if="category.max_selection > 1"
                        type="checkbox"
                        v-model="form.ballot"
                        :value="{
                          voter_id: this.$page.props.user.id,
                          nominee_id: nominee.id,
                        }"
                      />
                      <input
                        v-else
                        type="radio"
                        v-model="form.ballot[category.id - 1]"
                        :value="{
                          voter_id: this.$page.props.user.id,
                          nominee_id: nominee.id,
                        }"
                      />
                    </div>
                  </div>
                  <div
                    class="flex items-center justify-center flex-1 px-2 py-2 -space-x-2"
                  >
                    <img
                      class="z-10 object-contain w-16 h-16 border-2 border-gray-200 rounded-full"
                      src="http://127.0.0.1:8000/storage/profile-photos/abstain-vote.png"
                      alt="Abstain vote"
                    />
                    <div
                      class="px-4 py-2 truncate bg-gray-200 rounded-r-full hover:bg-gray-300 focus:outline-none"
                    >
                      Abstain
                      <input
                        v-if="category.max_selection > 1"
                        type="checkbox"
                        v-model="form.ballot"
                        :value="{
                          voter_id: this.$page.props.user.id,
                          nominee_id: 0,
                        }"
                      />
                      <input
                        v-else
                        type="radio"
                        v-model="form.ballot[category.id - 1]"
                        checked
                        :value="{
                          voter_id: this.$page.props.user.id,
                          nominee_id: 0,
                        }"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-center w-full space-x-2">
          <inertia-link class="btn btn-text-error" :href="route('dashboard')"
            >Back</inertia-link
          >
          <button
            :class="
              this.$page.props.user.status == 'voted' ? '' : 'btn btn-success'
            "
            @click="handleSubmitVote"
            :disabled="this.$page.props.user.status == 'voted'"
          >
            <span v-if="this.$page.props.user.status != 'voted'">
              Submit Vote
            </span>
            <span v-else> Vote has been Submitted </span>
          </button>
        </div>
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
        user_id: this.$page.props.user.id,
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