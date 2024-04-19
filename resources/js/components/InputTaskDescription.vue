<template>
  <input
    type="text"
    @input="$emit('update:description', $event.target.value)"
    @change="$emit('update:description', $event.target.value)"
    :value="props.description"
    class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6"
    placeholder="Enter the task description"
    id="taskDescription"
    autocomplete="off"
  />
</template>

<script setup>
defineProps({
  task_id: {
    type: Number,
    required: true,
  },
});
</script>
