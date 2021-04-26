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
          <inertia-link
            v-if="canRegister"
            :href="route('register')"
            class="ml-4 text-sm text-gray-700 underline"
          >
            Register
          </inertia-link>
        </template>
      </div>
      <template #logo>
        <div class="flex items-center space-x-4">
          <jet-authentication-card-logo class="text-gray-800" />

          <div class="text-5xl text-gray-800">Voting System</div>
        </div>
      </template>
      <jet-validation-errors class="mb-4" />

      <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="email"
            class="block w-full mt-1"
            v-model="form.email"
            required
            autofocus
          />
        </div>

        <div class="mt-4">
          <jet-label for="password" value="Password" />
          <jet-input
            id="password"
            type="password"
            class="block w-full mt-1"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>

        <div class="flex justify-between mt-4">
          <label class="flex items-center">
            <jet-checkbox name="remember" v-model:checked="form.remember" />
            <span class="ml-2 text-sm text-gray-600">Remember me</span>
          </label>
          <inertia-link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="text-sm text-gray-600 underline hover:text-gray-900"
          >
            Forgot your password?
          </inertia-link>
        </div>

        <div class="flex justify-between mt-4 space-x-3">
          <button
            class="w-1/2 btn btn-primary"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Log in
          </button>
          <!-- <jet-button
          class="ml-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </jet-button> -->

          <inertia-link
            as="button"
            v-if="canRegister"
            :href="route('register')"
            class="w-1/2 text-sm text-center text-gray-700 btn btn-outline-success"
          >
            Register
          </inertia-link>
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
    canRegister: Boolean,
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>
