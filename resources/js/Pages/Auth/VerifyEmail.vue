<template>
  <div id="login-box">
    <jet-authentication-card
      class="flex flex-col items-center justify-center min-h-screen p-4 bg-gray-50 bg-opacity-60"
    >
      <template #logo>
        <!-- <jet-authentication-card-logo /> -->
        <div class="flex items-center space-x-4">
          <!-- <jet-authentication-card-logo class="text-gray-800" /> -->
          <img class="w-20 shadow-md" src="/storage/resources/poea_logo.png" />
          <div class="text-5xl font-semibold text-gray-800">Voting System</div>
        </div>
      </template>

      <div class="mb-4 text-sm text-gray-600">
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another.
      </div>

      <div
        class="mb-4 text-sm font-medium text-green-600"
        v-if="verificationLinkSent"
      >
        A new verification link has been sent to the email address you provided
        during registration.
      </div>

      <form @submit.prevent="submit">
        <div class="flex items-center justify-between mt-4">
          <jet-button
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Resend Verification Email
          </jet-button>

          <inertia-link
            :href="route('logout')"
            method="post"
            as="button"
            class="text-sm text-gray-600 underline hover:text-gray-900"
            >Log Out</inertia-link
          >
        </div>
      </form>
    </jet-authentication-card>
  </div>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("verification.send"));
    },
  },

  computed: {
    verificationLinkSent() {
      return this.status === "verification-link-sent";
    },
  },
};
</script>
