<script setup>
import { ref, watch, onMounted } from 'vue'

const props = defineProps({
    type: { type: String, default: 'success' }, // success | danger | info | warning
    message: { type: String, required: true },
    timeoutMs: { type: Number, default: 5000 }, // auto fechar
})

const open = ref(true)

watch(() => props.message, () => {
    open.value = true
    if (props.timeoutMs > 0) {
        setTimeout(() => (open.value = false), props.timeoutMs)
    }
})

onMounted(() => {
    if (props.timeoutMs > 0) {
        setTimeout(() => (open.value = false), props.timeoutMs)
    }
})

const styles = {
    success: 'bg-teal-500 text-white',
    danger:  'bg-red-500 text-white',
    info:    'bg-blue-500 text-white',
    warning: 'bg-yellow-500 text-black',
}
</script>

<template>
    <transition name="fade" appear>
        <div
            v-if="open && message"
            class="rounded-lg p-4 text-sm shadow mb-3 flex items-start gap-3"
            :class="styles[type] ?? styles.success"
            role="alert"
            tabindex="-1"
        >
            <strong class="font-bold">
                {{ type === 'success' ? 'Sucesso' : type === 'danger' ? 'Erro' : '' }}!
            </strong>
            <span class="flex-1">{{ message }}</span>
            <button
                class="opacity-80 hover:opacity-100"
                aria-label="Fechar"
                @click="open = false"
            >✕</button>
        </div>
    </transition>
</template>

<style>
.fade-enter-active, .fade-leave-active { transition: opacity .2s }
.fade-enter-from, .fade-leave-to { opacity: 0 }
</style>
