<template>
    <div id="login-box">
        <jet-authentication-card
            class="flex flex-col items-center justify-center min-h-screen p-4 bg-gray-50 bg-opacity-60"
        >
            <template #logo>
                <!-- <jet-authentication-card-logo /> -->
                <div class="flex items-center space-x-4">
                    <!-- <jet-authentication-card-logo class="text-gray-800" /> -->
                    <img
                        class="w-20 drop-shadow-md"
                        src="/storage/resources/logo.png"
                    />
                    <div class="text-5xl font-semibold text-gray-800">
                        Register
                    </div>
                </div>
            </template>

            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" value="Name" />
                    <jet-input
                        id="name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.name"
                        required
                        autocomplete="name"
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="Email" />
                    <jet-input
                        id="email"
                        type="email"
                        class="block w-full mt-1"
                        v-model="form.email"
                        required
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="phone_number" value="Mobile Number" />
                    <jet-input
                        id="phone_number"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.phone_number"
                        required
                    />
                </div>

                <!-- <div class="mt-4">
          <jet-label for="password" value="Password" />
          <jet-input
            id="password"
            type="password"
            class="block w-full mt-1"
            v-model="form.password"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="mt-4">
          <jet-label for="password_confirmation" value="Confirm Password" />
          <jet-input
            id="password_confirmation"
            type="password"
            class="block w-full mt-1"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />
        </div> -->

                <div
                    class="mt-4"
                    v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                >
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox
                                name="terms"
                                id="terms"
                                v-model:checked="form.terms"
                            />

                            <div class="ml-2">
                                I agree to the
                                <a
                                    target="_blank"
                                    :href="route('terms.show')"
                                    class="text-sm text-gray-600 underline hover:text-gray-900"
                                    >Terms of Service</a
                                >
                                and
                                <a
                                    target="_blank"
                                    :href="route('policy.show')"
                                    class="text-sm text-gray-600 underline hover:text-gray-900"
                                    >Privacy Policy</a
                                >
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <inertia-link
                        :href="route('login')"
                        class="text-sm text-gray-600 underline hover:text-gray-900"
                    >
                        Already registered?
                    </inertia-link>

                    <jet-button
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </jet-button>
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

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                phone_number: null,
                password: "",
                password_confirmation: "",
                terms: true,
            }),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("register"), {
                onFinish: () =>
                    this.form.reset("password", "password_confirmation"),
            });
        },
        test() {
            console.log(this.form);
        },
    },
};
</script>
