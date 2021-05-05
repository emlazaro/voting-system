<template>
  <select
    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    ref="input"
  >
    <option value="0" selected disabled>Select {{ placeholder }}...</option>
    <option v-for="item in items" :key="`select-${item.id}`" :value="item.id">
      {{ item.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: ["modelValue", "items", "placeholder"],

  emits: ["update:modelValue"],

  methods: {
    change() {
      this.$refs.input.change();
    },
  },
};
</script>

