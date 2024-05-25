<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
 
<template>
    <input
        type="file" 
        class="block w-full bg-#f1f2f3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4  file:border-0 file:text-sm file:font-semibold file:text-#4361ee file:bg-button-file-blue hover:file:bg-blue-300"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.files[0])"
        ref="input"
    />
</template>
