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
                    <img
                        class="w-20 shadow-md"
                        :src="'../storage/resources/poea_logo.png'"
                    />
                    <div class="text-5xl font-semibold text-gray-800">
                        Voting System
                    </div>
                </div>
            </template>
            <jet-validation-errors class="mb-4" />

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="mb-4 text-lg font-semibold text-center">
                    Login using your...
                </div>

                <div class="py-4" v-if="!form.loginUsing">
                    <button
                        @click="form.loginUsing = 'email'"
                        type="button"
                        class="w-full bg-indigo-100 shadow btn"
                    >
                        Email Address...
                    </button>
                    <div class="my-4 font-semibold text-center">-- OR --</div>
                    <button
                        @click="form.loginUsing = 'number'"
                        type="button"
                        class="w-full bg-green-100 shadow btn"
                    >
                        Mobile number...
                    </button>
                </div>

                <div v-if="form.loginUsing == 'email'" class="pb-2">
                    <jet-label for="email" value="Email" />
                    <jet-input
                        id="email"
                        type="email"
                        class="block w-full mt-1"
                        v-model="form.email"
                        autofocus
                    />
                </div>
                <div v-else-if="form.loginUsing == 'number'" class="pb-2">
                    <jet-label for="phone_number" value="Phone Number" />
                    <jet-input
                        id="phone_number"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.phone_number"
                    />
                </div>
                <div class="my-2" v-if="isOTPSent && form.loginUsing != null">
                    <jet-label for="password" value="One-Time Password (OTP)" />
                    <jet-input
                        id="password"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.password"
                    />
                </div>
                <div v-if="form.loginUsing">
                    <button
                        @click="form.loginUsing = null"
                        type="button"
                        class="w-full mt-4 bg-gray-100 btn"
                    >
                        Choose other method...
                    </button>
                </div>
                <div class="flex items-center justify-between mt-4 space-x-3">
                    <inertia-link
                        v-if="canRegister"
                        :href="route('register')"
                        class="w-1/2 text-center btn btn-text-primary"
                    >
                        Register
                    </inertia-link>
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
        isOTPSent: Boolean,
        credentials: Array,
    },

    data() {
        return {
            form: this.$inertia.form({
                loginUsing: null,
                email: null,
                phone_number: null,
                password: null,
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
                .post(this.route("otp.attempt"), {
                    onFinish: () => {
                        this.form.reset("password");
                    },
                });
        },
    },
};
</script>
