<template>
  <div id="login-box">
    <jet-authentication-card
      class="flex flex-col items-center justify-center min-h-screen p-4 bg-gray-50 bg-opacity-60"
    >
      <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
        <inertia-link
          v-if="$page.props.user"
          href="/dashboard"
          class="text-sm text-gray-700 underline"
        >
          Dashboard
        </inertia-link>

        <template v-else>
          <!-- <inertia-link
            v-if="canRegister"
            :href="route('register')"
            class="ml-4 text-sm text-gray-700 underline"
          >
            Register
          </inertia-link> -->
        </template>
      </div>
      <template #logo>
        <div class="flex items-center space-x-4">
          <!-- <jet-authentication-card-logo class="text-gray-800" /> -->
          <img class="w-20 shadow-md" src="/storage/resources/poea_logo.png" />
          <div class="text-5xl font-semibold text-gray-800">Verify Login</div>
        </div>
      </template>
      <jet-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="handleSubmit">
        <div>
          <jet-label for="otp" value="One-Time Password" />
          <jet-input
            id="otp"
            type="text"
            class="block w-full mt-1"
            v-model="form.password"
            required
            autofocus
          />
        </div>

        <div class="flex items-center justify-between mt-4 space-x-3">
          <button
            class="w-full btn btn-primary"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Verify OTP
          </button>
          <button
            class="w-full bg-gray-100 btn hover:bg-gray-200"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            type="button"
            @click="handleResend"
          >
            Resend OTP
          </button>
          <!-- <jet-button
          class="ml-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </jet-button> -->
        </div>
      </form>
    </jet-authentication-card>
  </div>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Swal from "sweetalert2";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
  },

  props: {
    credentials: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: this.$page.props.credentials,
        password: null,
      }),
    };
  },

  methods: {
    handleSubmit() {
      this.form.post(route("login.auth"), {
        onSuccess: () => {
          Swal.fire({
            title: "Welcome!",
            text: "Welcome to POEA - COOP Voting System!!!!",
            icon: "success",
            confirmButtonText: "Thanks!",
          });
        },
      });
    },
    handleResend() {
      this.form.post(route("login.resend"));
    },
  },
};
</script>
